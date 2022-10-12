<?php

use Skynet\Robot;

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

it('get answer', function () use ($robot) {
    expect($robot->reply('I Wanna BUY CofFEE, WHERE I CAN DO IT?'))->toEqual('You can buy coffee in our shop: st. Lenina 420');
});

it('get null answer', function () use ($robot) {
    expect($robot->reply('qweqwe qewqwew qeqw'))->toBeNull();
});

it('with debug', function () use ($robot) {
    expect($robot->reply('I Wanna BUY CofFEE, WHERE I CAN DO IT?', true))->toBeArray();
});

it('with null debug', function () use ($robot) {
    expect($robot->reply('qweqweqw eqeq', true))->toBeNull();
});