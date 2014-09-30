<?php namespace Koterle\Roleable;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     *  Many to Many relationship
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
    {
        return $this->belongsToMany('Koterle\\Roleable\\Role')->withTimestamps();
    }
}
