# Laravel Trust Services

Update composer.json

    "require": [
        "podvysotsky/laravel-trust": "master"
    ],
    "repositories": [
        {
            "url": "https://github.com/Serhii-Podvysotskyi/laravel-trust.git",
            "type": "git"
        }
    ]

Install composer package

    composer install


Publish Service Provider

    php artisan vendor:publish --tag=trust

Make Migrations

    php artisan migrate

Update to User Model

    use Trustable;
