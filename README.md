# Roleable

Simple role management for Laravel by Model class and ID for Laravel 5.1

For Laravel 5.0 use the 1.0 branch.
For laravel 4 use the 0.9 branch.

## Install

Via Composer

``` json
{
    "require": {
        "koterle/roleable": "1.1.*"
    }
}
```

Update Composer:

    composer update --dev

Once it completes, add the service provideer in your `config/app.php`.

    Koterle\Roleable\RoleableServiceProvider::class


## Usage

Publish the config file and the migrations. Make sure you set your User model and User ID type
correctly.

```php
php artisan vendor:publish
```

Run the migrations.

```php
php artisan migrate
```

Add the CanTrait to the User model:
```php
use CanTrait;
```

Fill up the database with the desired roles and permissions.

Now you can use (role name/permission, class, id):
```php
if (Auth::user()->is('administrator', 'Company', 1)) { ... }
if (Auth::user()->can('manage_users', 'Company', 1)) { ... }
if (Auth::user()->cannot('delete_posts', 'Blog', 1)) { ... }

Auth::user()->attachRole('administrator', 'Company', 1);
Auth::user()->detachRole('administrator', 'Company', 1);
```


## License

The MIT License (MIT)
