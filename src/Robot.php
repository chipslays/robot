<?php

namespace Skynet;

use Wamania\Snowball\Stemmer\Stemmer;
use Wamania\Snowball\StemmerFactory;

class Robot
{
    protected Stemmer $stemmer;

    protected array $brain;

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

    public function reply(string $text, bool $debug = false): string|array|null
    {
        $words = $this->textToWords($text);

        $result = [];

        foreach ($this->brain as $key => $item) {
            $diff = array_diff($item['words'], $words);
            $result[$key] = [
                'matches' => count($item['words']) - count($diff),
                'words' => array_values(array_diff($item['words'], $diff)),
                'answer' => $item['answer'],
            ];
        }

        usort($result, fn ($a, $b) => $b['matches'] <=> $a['matches']);

        if ($debug) {
            return $result;
        }

        return $result[0]['matches'] > 0 ? $result[0]['answer'] : null;
    }

    protected function textToWords(string $text): array
    {
        // omG O_O
        $words = array_unique(array_filter(array_map('trim', explode(' ', preg_replace('/[^a-zA-Zа-яА-ЯёЁ0-9\s]/u', '', preg_replace('/\s/', ' ', mb_strtolower($text)))))));

        foreach ($words as $key => $word) {
            $words[$key] = $this->stemmer->stem($word);
        }

        return array_unique($words);
    }
}
