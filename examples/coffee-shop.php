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

$answer = $robot->reply('I Wanna BUY CofFEE, WHERE I CAN DO IT?', debug: false);

dump($answer);

// ^ array:2 [
//     0 => array:3 [
//       "matches" => 5
//       "words" => array:5 [
//         0 => "i"
//         1 => "buy"
//         2 => "coffee"
//         3 => "where"
//         4 => "can"
//       ]
//       "answer" => "You can buy coffe in our shop: st. Lenina 420"
//     ]
//     1 => array:3 [
//       "matches" => 4
//       "words" => array:4 [
//         0 => "coffee"
//         1 => "i"
//         2 => "where"
//         3 => "can"
//       ]
//       "answer" => "Coffee costs $5"
//     ]
//   ]