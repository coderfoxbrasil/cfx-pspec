<?php

use function Cfx\PSpec\get;
use function Cfx\PSpec\getSubject;
use function Cfx\PSpec\let;
use function Cfx\PSpec\subject;

describe('class_name', function () {
    subject(fn () => get('variable'));

    let('variable', fn () => 'from root');

    it('gets the variable from root variable')
        ->expect(getSubject(...))
        ->toEqual('from root');

    describe('.method_name', function () {
        it('gets the variable from root variable')
            ->expect(getSubject(...))
            ->toEqual('from root');

        describe('can override', function () {
            let('variable', fn () => 'overrided');

            it('gets the variable from local scope')
                ->expect(getSubject(...))
                ->toEqual('overrided');

            describe('sub nested block', function () {
                it('gets variable from parent block')
                    ->expect(getSubject(...))
                    ->toEqual('overrided');
            });
        });
    });
});

describe('no direct tests block', function () {
    subject(fn () => get('variable2'));

    let('variable2', fn () => 'from root');

    describe('nested block', function () {
        it('gets the variable from root variable')
            ->expect(getSubject(...))
            ->toEqual('from root');
    });
});
