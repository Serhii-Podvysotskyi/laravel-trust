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

    composer update


Make Migrations

    php artisan migrate

Update User Model

    use Trustable;
