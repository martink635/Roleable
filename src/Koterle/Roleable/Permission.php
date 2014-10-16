<?php namespace Koterle\Roleable;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
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
        $this->table = \Config::get('roleable::tables.permissions');

        parent::__construct($attributes);
    }

    /**
     *  Many to Many relationship
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
    {
        return $this->belongsToMany('Koterle\\Roleable\\Role', \Config::get('roleable::tables.permission_role'))
            ->withTimestamps();
    }
}
