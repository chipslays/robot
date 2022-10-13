# Robot 🦾

A very simple and indispensable helper that helps you automate the answers to simple questions in your application.

Supports all languages from [wamania/php-stemmer](https://github.com/wamania/php-stemmer#languages).

## Installation

```bash
composer require chipslays/robot
```

## Getting Started

```php
require __DIR__ . '/vendor/autoload.php';

$robot = new Skynet\Robot('english');

$robot->train([
    [
        'question' => 'buy coffee get some where can',
        'answer' => 'You can buy coffee in our shop: st. Lenina 420',
    ],
    [
        'question' => 'how much coffee costs price',
        'answer' => 'Coffee costs $5',
    ],
]);

$robot->ask('Where I can buy coffee?'); // You can buy coffee in our shop: st. Lenina 420
```

## Methods

#### `train(array $data): self`

Train robot brain.

```php
$robot->train([
    [
        // a set of keywords, sentences, (duplicate words will be removed)
        'question' => '...',

        // answer for this question
        'answer' => '...',
    ],
]);
```

#### `ask(string $text, callable $callback = 1): string|array|null`

Get answer for message.

```php
$answer = $robot->ask('Where I can buy coffee?'); // returns answer string
```

With callback.

```php
// returns value from callback
$answer = $robot->ask('Where I can buy coffee?', function (array|null $item): mixed {
    // $item - it raw value from traind data with question,
    // answer and the values you passed, or null if answer not found.

    if (!$item) return null;

    return $item['answer'];
});

dump($answer); // You can buy coffee in our shop: st. Lenina 420
```

#### `matches(int $count = 1): self`

How many matches we need to cut off unnecessary results.

```php
$robot->matches(1)->ask(...);
```

#### `debug(bool $enable = false): self`

Get more details by `ask()` method (matches count, words, etc).

> NOTE
> Not working if callback passed.

```php
$answer = $robot->debug(true)->ask('Where I can buy coffee?'); // returns array of all matches detail

// ^ array:2 [
//   0 => array:3 [
//     "matches" => 4
//     "words" => array:4 [
//       0 => "buy"
//       1 => "coffe"
//       2 => "where"
//       3 => "can"
//     ]
//     "answer" => "You can buy coffee in our shop: st. Lenina 420"
//   ]
//   1 => array:3 [
//     "matches" => 1
//     "words" => array:1 [
//       0 => "coffe"
//     ]
//     "answer" => "Coffee costs $5"
//   ]
// ]
```

## License

MIT
