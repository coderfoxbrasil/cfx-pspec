<?php

declare(strict_types=1);

namespace Cfx\PSpec;

use Closure;
use Pest\Expectation;
use Pest\PendingCalls\BeforeEachCall;
use Pest\PendingCalls\DescribeCall;
use Pest\Support\Backtrace;
use Pest\TestSuite;

function subject(Closure $subject): BeforeEachCall
{
    $filename = Backtrace::testFile();

    return new BeforeEachCall(
        TestSuite::getInstance(),
        $filename,
        fn () => new SubjectTester($subject),
    );
}

function let(string $key, Closure $resolver): BeforeEachCall
{
    $filename = Backtrace::testFile();

    return new BeforeEachCall(
        TestSuite::getInstance(),
        $filename,
        fn () => SubjectTester::getInstance()->let($key, $resolver),
    );
}

function get(string $key): mixed
{
    return SubjectTester::getInstance()->get($key);
}

function context(string $description, Closure $tests): DescribeCall
{
    return describe($description, function () use ($tests) {
        return $tests();
    });
}

function getSubject(): mixed
{
    $tester = SubjectTester::getInstance();

    return $tester->resolveSubject();
}

function expectSubject(): Expectation
{
    return expect(getSubject());
}
