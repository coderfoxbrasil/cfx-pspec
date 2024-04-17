<?php

use function Cfx\PSpec\get;
use function Cfx\PSpec\getSubject;
use function Cfx\PSpec\let;
use function Cfx\PSpec\subject;

describe('no direct tests block', function () {
    subject(fn () => get('variable2'));

    let('variable2', fn () => 'from root');

    describe('nested block', function () {
        it('gets the variable from root variable')
            ->expect(getSubject(...))
            ->toEqual('from root');
    });
});
