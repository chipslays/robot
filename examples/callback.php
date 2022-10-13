<?php

use Skynet\Robot;

require __DIR__ . '/../vendor/autoload.php';

$robot = new Robot('english');

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

// Returns value from callback
$answer = $robot->ask('Where I can buy coffee?', function (array|null $item, array $result) {
    // $item - it raw value from traind data with question,
    // answer and the values you passed, or null if answer not found.

    // $result - contain sorted matches, if not found returns empty array

    if (!$item) return;

    return $item['answer'];
});

dump($answer); // You can buy coffee in our shop: st. Lenina 420
