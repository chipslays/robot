<?php

use Skynet\Robot;

$robot = new Robot('english');

$robot->train([
    [
        'question' => 'buy coffee get some where can',
        'answer' => 'You can buy coffee in our shop: st. Lenina 420',
    ],
    [
        'question' => 'how much coffee costs price coffee',
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