Aist Alice Fixtures [![SensioLabsInsight](https://insight.sensiolabs.com/projects/c344bb5d-9d66-4f63-b006-b4d758643904/small.png)](https://insight.sensiolabs.com/projects/c344bb5d-9d66-4f63-b006-b4d758643904)
===================
A Zend Framework 2 Module to help load Doctrine Fixtures with [nelmio/alice](https://github.com/nelmio/alice) and [fzaninotto/Faker](https://github.com/fzaninotto/Faker).

[![Build Status](https://travis-ci.org/ma-si/aist-alice-fixtures.svg?branch=master)](https://travis-ci.org/ma-si/aist-alice-fixtures)
[![Total Downloads](https://poser.pugx.org/aist/aist-alice-fixtures/downloads)](https://packagist.org/packages/aist/aist-alice-fixtures)
[![Reference Status](https://www.versioneye.com/php/aist:aist-alice-fixtures/reference_badge.svg?style=flat)](https://www.versioneye.com/php/aist:aist-alice-fixtures/references)
[![Dependency Status](https://www.versioneye.com/user/projects/55d8ac808d9c4b0021000016/badge.svg?style=flat)](https://www.versioneye.com/user/projects/55d8ac808d9c4b0021000016)
[![Packagist](https://img.shields.io/packagist/v/aist/aist-alice-fixtures.svg)]()
[![Code Climate](https://codeclimate.com/github/ma-si/aist-alice-fixtures/badges/gpa.svg)](https://codeclimate.com/github/ma-si/aist-alice-fixtures)
[![License](https://poser.pugx.org/aist/aist-alice-fixtures/license)](https://packagist.org/packages/aist/aist-alice-fixtures)


## Introduction
Add fixtures to your modules.


## Installation
Installation of this module uses composer.
For composer documentation, please refer to [getcomposer.org](http://getcomposer.org/).

1. Install the module via composer by running:

    ```sh
    php composer.phar require aist/aist-alice-fixtures
    ```

   or download it directly from github and place it in your application's `module/` directory.
2. Add the `AistAliceFixtures` module to the module section of your `config/application.config.php`

## Formatters
This module provides few useful formatters extending faker. Here is a list of the bundled formatters.


### `AistAliceFixtures\Faker\Provider\Internet` extends `Faker\Provider\Internet`
    slug                    // 'aut-repellat-commodi-vel-itaque-nihil-id-saepe-nostrum'
    uniDecode               // 'Zazolc gesla jazn'

`<slugify('some text')>` allows to pass parameter into slugifier


## Example
Here is a complete example of entity declaration:

```yaml
AistUser\Entity\AistUser:
    AistUser_{1..10}:
        username: <username()>
        fullname: <firstName()> <lastName()>
        slug: <slugify(@self->fullname)>
        birthDate: <date()>
        email: <email()>
```


## Check list
- [ ] create checklist
