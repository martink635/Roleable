# Roleable

Simple role management for Laravel by Model class and ID.


## Install

Via Composer

``` json
{
    "require": {
        "koterle/roleable": "1.0.*"
    }
}
```


## Usage

Publish the config file, and make sure you set your User model and User ID type
correctly.

``` php
php artisan config:publish koterle/roleable
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