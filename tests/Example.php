<?php

use function Cfx\PSpec\context;
use function Cfx\PSpec\expectSubject;
use function Cfx\PSpec\get;
use function Cfx\PSpec\getSubject;
use function Cfx\PSpec\let;
use function Cfx\PSpec\subject;

function testMe($param)
{
    return $param;
}

subject(fn () => testMe(get('param2')));
let('param1', fn () => 1);

it('can get param1 from root let', function () {
    expect(get('param1'))->toEqual(1);
});

it('cannot get non defined variables', function () {
    get('non-existent-param');
})->throws('Attempt to read non-existent-param, when was not set');

context('when param2 is 3', function () {
    let('param2', fn () => 3);

    it('returns param3 value', function () {
        expectSubject()->toEqual(3);
    });

    it('returns param3 value multiple times in same scope', function () {
        expectSubject()->toEqual(3);
    });
});

context('when param2 is 4', function () {
    let('param2', fn () => 4);

    it('can work', function () {
        expectSubject()->toEqual(4);
    });
});

context('when using high order testing', function () {
    let('param2', fn () => 2);

    it('can use high order testing')
        ->expect(getSubject(...))
        ->toEqual(2);
});
