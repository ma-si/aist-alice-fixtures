Aist Alice Fixtures
===================
A Zend Framework 2 Module to help load Doctrine Fixtures with [nelmio/alice](https://github.com/nelmio/alice) and [fzaninotto/Faker](https://github.com/fzaninotto/Faker).


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
