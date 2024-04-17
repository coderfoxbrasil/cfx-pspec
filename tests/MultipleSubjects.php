<?php

use function Cfx\PSpec\getSubject;
use function Cfx\PSpec\subject;

describe('subject 1', function () {
    subject(fn () => 1);

    it('gets subject 1')
        ->expect(getSubject(...))
        ->toEqual(1);

    describe('nested block', function () {
        it('gets subject 1')
            ->expect(getSubject(...))
            ->toEqual(1);
    });
});

describe('subject 2', function () {
    subject(fn () => 2);

    it('gets subject 2')
        ->expect(getSubject(...))
        ->toEqual(2);

    describe('nested block', function () {
        it('gets subject 2')
            ->expect(getSubject(...))
            ->toEqual(2);
    });
});
