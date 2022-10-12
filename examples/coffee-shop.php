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

$answer = $robot->reply('I Wanna BUY CofFEE, WHERE I CAN DO IT?', debug: true);

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