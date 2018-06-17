<h1 align="center">
    <a href="https://azerdict.com" target="_blank">
        <img src="https://azerdict.com/img/logo.jpg" />
    </a>
</h1>

[azerdict.com](https://azerdict.com) is an open-source free dictionary service.
This is the repository of azerdict API that powers the website and mobile apps. It is built on top of [Symfony](https://symfony.com).


Installation
------------

#### Requirements
* PHP 7.1
* MySQL 5.6+
* [Composer](https://getcomposer.org/)

First, clone the repository and install dependencies via composer:

```
git clone git@github.com:azerdict/api.git
cd api/
composer install
```

To create local database and populate it with dummy data run the following commands:

```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console doctrine:fixtures:load --no-interaction
```

Run server:

```
php bin/console server:run
```

Now you are ready to test it with your favorite browser or API development client (ex: Postman, Insomnia, etc.) by navigating [localhost:8000](http://localhost:8000)


Endpoints
---------

* GET `/dictionary/english` with `term` query param.


Testing
-------

Testing is done with [PHPUnit](https://phpunit.de/). To test the code simply run `php bin/phpunit`


License
-------

azerdict is free and released under [Mozilla Public License 2.0](https://www.mozilla.org/en-US/MPL/2.0/)
