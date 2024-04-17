# PSpec

> PSpec is a Pest plugin for composing multi scenarios tests with a simple API, based on RSpec let.

### Install
```shell
composer require cfx/pspec --dev
```

### Simple usage
```php
use function Cfx\PSpec\context;
use function Cfx\PSpec\expectSubject;
use function Cfx\PSpec\get;
use function Cfx\PSpec\let;
use function Cfx\PSpec\subject;

subject(fn () => User::factory()->create(['is_admin' => get('is_admin')]));

context('when is admin', function () {
  let('is_admin', fn() => true);

  it('returns true', function () {
    expectSubject()->is_admin->toBeTrue();
  });
}); 

context('when is not admin', function () {
  let('is_admin', fn() => false);

  it('returns false', function () {
    expectSubject()->is_admin->toBeFalse();
  });
});
```

### Higher order testing

```php
use function Cfx\PSpec\context;
use function Cfx\PSpec\getSubject;
use function Cfx\PSpec\let;

context('when using high order testing', function () {
  let('param2', fn () => 2);

  it('can use high order testing')
    ->expect(getSubject(...))
    ->toEqual(2);
});
```

[more examples](https://github.com/coderfoxbrasil/cfx-pspec/blob/master/tests/Example.php)


