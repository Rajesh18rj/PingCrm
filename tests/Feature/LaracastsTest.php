<?php

use App\Rules\IsValidEmailAddress;
use InvalidArgumentException;

it('can validate an email', function() {
    $rule = new IsValidEmailAddress();

    expect($rule->passes('email', 'me@you.com'))->toBe(True);

    })->group('laracasts');


it('throws an exception if the value is not string', function(){

    $rule = new IsValidEmailAddress();

    $rule->passes('email', 1);

    })
    ->skip(getenv('SKIP_TESTS') ?? false, 'We no longer want to test the exception')
    ->throws(InvalidArgumentException::class, 'The value must be a string');


it('has better regex support and can catch more email addresses');
