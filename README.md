#Aist Alice Fixtures

A Zend Framework Module integrating [nelmio/alice](https://github.com/nelmio/alice)
and [fzaninotto/Faker](https://github.com/fzaninotto/Faker).
Aist Alice Fixtures allows you to create fixtures/fake data for use while developing or testing projects.
It provides you a few essential tools to make it very easy to generate complex data with constraints in a readable
and easy to edit way.

[![Build Status](https://travis-ci.org/ma-si/aist-alice-fixtures.svg?branch=master)](https://travis-ci.org/ma-si/aist-alice-fixtures)
[![Total Downloads](https://poser.pugx.org/aist/aist-alice-fixtures/downloads)](https://packagist.org/packages/aist/aist-alice-fixtures)
[![Reference Status](https://www.versioneye.com/php/aist:aist-alice-fixtures/reference_badge.svg?style=flat)](https://www.versioneye.com/php/aist:aist-alice-fixtures/references)
[![Dependency Status](https://www.versioneye.com/user/projects/55d8ac808d9c4b0021000016/badge.svg?style=flat)](https://www.versioneye.com/user/projects/55d8ac808d9c4b0021000016)
[![Packagist](https://img.shields.io/packagist/v/aist/aist-alice-fixtures.svg)]()
[![Code Climate](https://codeclimate.com/github/ma-si/aist-alice-fixtures/badges/gpa.svg)](https://codeclimate.com/github/ma-si/aist-alice-fixtures)
[![License](https://poser.pugx.org/aist/aist-alice-fixtures/license)](https://packagist.org/packages/aist/aist-alice-fixtures)


## Installation
Installation of this module uses composer.
For composer documentation, please refer to [getcomposer.org](http://getcomposer.org/).

1. Install the module via composer by running:

    ```sh
    composer require --dev aist/aist-alice-fixtures
    ```

2. Add the `Aist\AliceFixtures` module to the module section of your `config/application.config.php`

## Formatters
This module provides additional formatters extending faker. Here is a list of the bundled formatters.

### `Aist\AliceFixtures\Faker\Provider\Internet` extends `Faker\Provider\Internet`
```
slug      // 'aut-repellat-commodi-vel-itaque-nihil-id-saepe-nostrum'
uniDecode // 'Zazolc gesla jazn'
```

`<slugify('some text')>` allows to pass parameter into slugifier


## Example fixture

```yaml
AistUser\Entity\AistUser:
    AistUser_{1..10}:
        username: <username()>
        fullname: <firstName()> <lastName()>
        slug: <slugify(@self->fullname)>
        birthDate: <date()>
        email: <email()>
```


## Loading fixtures
```
bin/doctrine-module orm:fixtures:load --force
```
It will append fixtures to existing DB.


## Checklist
- [ ] Add truncate data & --append option
- [ ] Add tests
