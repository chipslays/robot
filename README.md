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

$robot->reply('I Wanna BUY CofFEE, WHERE I CAN do IT?'); // You can buy coffee in our shop: st. Lenina 420
```

## Methods

#### `train(array $data): self`

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

#### `reply(string $text, bool $debug = false): string|array|null`

```php
$answer = $robot->reply('I Wanna BUY CofFEE, WHERE I CAN DO IT?'); // returns string

$answer = $robot->reply('I Wanna BUY CofFEE, WHERE I CAN DO IT?', debug: true); // returns array with details

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
