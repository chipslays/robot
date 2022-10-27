<?php

namespace Skynet;

use Wamania\Snowball\Stemmer\Stemmer;
use Wamania\Snowball\StemmerFactory;

class Robot
{
    protected Stemmer $stemmer;

    protected array $brain = [];

    protected int $minMatches = 1;

    protected bool $debug = false;

    public function __construct(string $language = 'russian')
    {
        $this->stemmer = StemmerFactory::create($language);
    }

    public function train(array $data): self
    {
        $this->brain = [];

        foreach ($data as $item) {
            $item['words'] = $this->textToWords($item['question']);
            $this->brain[] = $item;
        }

        return $this;
    }

    public function ask(string $text, callable $callback = null): mixed
    {
        $result = $this->brainstorm($text, $this->minMatches);

        if ($callback) {
            return call_user_func_array($callback, [count($result) > 0 ? $this->brain[$result[0]['index']] : null, $result]);
        }

        if ($this->debug) {
            return count($result) > 0 ? $result : null;
        }

        return count($result) > 0 ? $result[0]['answer'] : null;
    }

    protected function brainstorm(string $text): array
    {
        $words = $this->textToWords($text);

        $result = [];

        foreach ($this->brain as $key => $item) {
            $diff = array_diff($item['words'], $words);
            $result[$key] = [
                'answer' => $item['answer'],
                'matches' => count($item['words']) - count($diff),
                'words' => array_values(array_diff($item['words'], $diff)),
                'index' => $key,
            ];
        }

        $result = array_filter($result, fn ($item) => $item['matches'] >= $this->minMatches);

        usort($result, fn ($a, $b) => $b['matches'] <=> $a['matches']);

        return $result;
    }

    public function matches(int $count): self
    {
        $this->minMatches = $count;

        return $this;
    }

    public function debug(bool $enable): self
    {
        $this->debug = $enable;

        return $this;
    }

    protected function textToWords(string $text): array
    {
        // omG O_O
        $words = array_unique(array_filter(array_map('trim', explode(' ', preg_replace('/[^a-zа-я0-9\s]/u', '', preg_replace('/\s/', ' ', trim(str_replace('ё', 'е', mb_strtolower($text)))))))));

        foreach ($words as $key => $word) {
            $words[$key] = $this->stemmer->stem($word);
        }

        return array_unique($words);
    }
}
