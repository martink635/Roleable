<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Users Model
    |--------------------------------------------------------------------------
    |
    | We need to know which model are you using to authenticate your users,
    | so we can run the autorization rules on them. It is set to whatever
    | setting you have in your auth config file.
    |
    */

    'user_model' => Config::get('auth.model'),

    /*
    |--------------------------------------------------------------------------
    | Users ID Type
    |--------------------------------------------------------------------------
    |
    | Here you can select if you are using a UUID string or an incremenenting
    | integer (Laravel default). The possible options are
    |
    | - "uuid": sets the foreign key to string('user_id' '36')
    | - everything else: sets the foreign key to integer('user_id')->unsigned()
    |
    */

    'user_id_type' => 'id',

    /*
    |--------------------------------------------------------------------------
    | Database tables
    |--------------------------------------------------------------------------
    |
    | Here you can rename the 4 table names that are used in the migrations, if 
    | you do not like the defaults or you are using them for something else.
    |
    | You also need to specify the 'users' table name, since it is used in one
    | of the models to define the relationship. It is set to whatever
    | setting you have in your auth config file.
    |
    */

    'tables' => [
        'roles' => 'roles',
        'permissions' => 'permissions',
        'permission_role' => 'permission_role',
        'role_user' => 'role_user',

        'users' => Config::get('auth.table'),
    ],
];
