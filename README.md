Evaluator
==============

[Symfony Expression Language](http://symfony.com/doc/current/components/expression_language/index.html) module for Laravel.

## Installation

Simply update the ```composer.json``` file and run ```composer install```.

```json
"require": {
	"periloso/evaluator": "1.0.*"
}
```

## Quick Installation

```composer require "periloso/evaluator=1.0.*"```


## How To Use

### Evaluating an expression

```php
$test = [
    'foo' => 10,
    'bar' => 5
];

echo Evaluator::evaluate('foo > bar', $test); //this will return true
```

You can also save the expression rule.

```php
$test = [
    'foo' => 10,
    'bar' => 5
];

Evaluator::expression()->add('test', 'foo > bar');

echo Evaluator::evaluateRule('test', $test); //this will return true
```

For supported expressions, visit the [Symfony Expression Language Component](http://symfony.com/doc/current/components/expression_language/index.html).

### Condition

Let say we want to implement 10% tax to our collection.

```php
$item = [
    'price' => 100
];

$condition = [
    'target' => 'price',
    'action' => '10%',
    'rule' => 'price > 50'
];

Evaluator::expression()->add('tax', $condition);

$calculated = Evaluator::condition('tax', $item);
```

Item with multiplier.

```php
$item = [
	'price' => 50,
	'quantity' => 2
];

$condition = [
    'target' => 'price',
    'action' => '10%',
    'rule' => 'price > 50',
    'multiplier' => 'quantity'
];

Evaluator::expression()->add('tax', $condition);

$calculated = Evaluator::condition('tax', $item);
```
