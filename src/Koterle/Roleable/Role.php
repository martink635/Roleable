<?php namespace Koterle\Roleable;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Mass assignment protection
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Sets the table value from the config.
     *
     * @return void
     */
    public function __construct(array $attributes = array())
    {
        $this->table = \Config::get('roleable::tables.roles');

        parent::__construct($attributes);
    }

    /**
     *  Many to Many relationship
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsToMany(\Config::get('roleable::user_model'), \Config::get('roleable::tables.role_user'))
            ->withPivot('roleable_id', 'roleable_type')
            ->withTimestamps();
    }

    /**
     *  Many to Many relationship
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->belongsToMany('Koterle\\Roleable\\Permission', \Config::get('roleable::tables.permission_role'))
            ->withTimestamps();
    }
}
