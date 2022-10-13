<?php

use Skynet\Robot;

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

it('get answer', function () use ($robot) {
    expect($robot->ask('Where I can buy coffee?'))->toEqual('You can buy coffee in our shop: st. Lenina 420');
});

it('get answer with min matches count', function () use ($robot) {
    expect($robot->matches(999)->ask('Where I can buy coffee?'))->toBeNull();
    $robot->matches(1); // reset
});

it('get null answer', function () use ($robot) {
    expect($robot->ask('qweqwe qewqwew qeqw'))->toBeNull();
});

it('with debug', function () use ($robot) {
    expect($robot->debug(true)->ask('Where I can buy coffee?'))->toBeArray();
});

it('with null debug', function () use ($robot) {
    expect($robot->debug(true)->ask('qweqweqw eqeq'))->toBeNull();
});

it('callback returns', function () use ($robot) {
    $answer = $robot->ask('Where I can buy coffee?', function ($item, $result) {
        return 'string';
    });

    expect($answer)->toEqual('string');
});

it('callback item is array', function () use ($robot) {
    $robot->ask('Where I can buy coffee?', function ($item, $result) {
        expect($item)->toBeArray();
    });
});

it('callback item is null', function () use ($robot) {
    $robot->ask('zxcz czx z', function ($item, $result) {
        expect($item)->toBeNull();
    });
});

it('callback result is array', function () use ($robot) {
    $robot->ask('zxcz czx z', function ($item, $result) {
        expect($result)->toBeArray();
    });
});

it('callback result is empty', function () use ($robot) {
    $robot->ask('zxcz czx z', function ($item, $result) {
        expect($result)->toEqual([]);
    });
});