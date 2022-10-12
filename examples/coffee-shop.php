<?php

use Skynet\Robot;

require __DIR__ . '/../vendor/autoload.php';

$robot = new Robot('english');

$robot->train([
    [
        'question' => 'I want to buy coffee I would like to get some coffee. where can i buy your coffee where could I buy coffee. could i buy some coffee how to buy coffee? How to get coffee? to buy coffee get some coffee',
        'answer' => 'You can buy coffee in our shop: st. Lenina 420',
    ],
    [
        'question' => 'How much is coffee I would like to know how much coffee costs. hear how much coffee costs where to see the price of coffee find out the price of coffee How can I find out the price of coffee? Where are your prices for coffee?',
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