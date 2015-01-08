# Roleable

Simple role management for Laravel 4 by Model class and ID.


## Install

Via Composer

``` json
{
    "require": {
        "koterle/roleable": "0.9.*"
    }
}
```

Update Composer:

    composer update --dev

Once it completes, add the service provideer in your `config/app.php`.

    'Koterle\Roleable\RoleableServiceProvider'


## Usage

Publish the config file, and make sure you set your User model and User ID type
correctly.

``` php
php artisan publish:config koterle/roleable
```

Run the migrations.

``` php
php artisan migrate --package="koterle/roleable"
```

Add the CanTrait to the User model:
``` php
use CanTrait;
```

Fill up the database with the desired roles and permissions.

Now you can use (role name/permission, class, id):
``` php
if (Auth::user()->is('administrator', 'Company', 1)) { ... }
if (Auth::user()->can('manage_users', 'Company', 1)) { ... }
if (Auth::user()->cannot('delete_posts', 'Blog', 1)) { ... }

Auth::user()->attachRole('administrator', 'Company', 1);
Auth::user()->detachRole('administrator', 'Company', 1);
```


## License

The MIT License (MIT)