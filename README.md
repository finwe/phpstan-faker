# Faker extensions for PHPStan

## Deprecation Notice

The problem this project used to solve is no longer present with the latest
versions of PHPStan and Faker. It is recommended to update those and remove
this project from your dependencies.

```
composer update
composer remove finwe/phpstan-faker
```

[![Build Status](https://travis-ci.org/finwe/phpstan-faker.svg)](https://travis-ci.org/finwe/phpstan-faker)
[![Latest Stable Version](https://poser.pugx.org/finwe/phpstan-faker/v/stable)](https://packagist.org/packages/finwe/phpstan-faker)
[![License](https://poser.pugx.org/finwe/phpstan-faker/license)](https://packagist.org/packages/finwe/phpstan-faker)

* [PHPStan](https://github.com/phpstan/phpstan)
* [Faker](https://github.com/fzaninotto/Faker)

This extension provides following features:

* Provides definitions for magic `Faker\Generator` methods and properties

## Usage

To use this extension, require it in [Composer](https://getcomposer.org/):

```
composer require --dev finwe/phpstan-faker
```

And include extension.neon in your project's PHPStan config:

```
includes:
	- vendor/finwe/phpstan-faker/extension.neon
```
