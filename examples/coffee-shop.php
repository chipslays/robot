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

$robot->callback(function ($item) {
    // array item from train data ['question' => ..., 'answer' => ..., ...] and additional values if u passed before
    // or null if answer not found
    dump($item);
});

$answer = $robot->debug(true)->ask('Where I can buy coffee?');

dump($answer);

// ^ array:2 [
//     0 => array:3 [
//       "matches" => 4
//       "words" => array:4 [
//         0 => "buy"
//         1 => "coffe"
//         2 => "where"
//         3 => "can"
//       ]
//       "answer" => "You can buy coffee in our shop: st. Lenina 420"
//     ]
//     1 => array:3 [
//       "matches" => 1
//       "words" => array:1 [
//         0 => "coffe"
//       ]
//       "answer" => "Coffee costs $5"
//     ]
//   ]