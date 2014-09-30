<?php namespace Koterle\Roleable;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = Config::get('roleable::tables.permissions');

    /**
     *  Many to Many relationship
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
    {
        return $this->belongsToMany('Koterle\\Roleable\\Role', Config::get('roleable::tables.permission_role'))
            ->withTimestamps();
    }
}
