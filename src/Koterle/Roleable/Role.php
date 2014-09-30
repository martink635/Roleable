<?php namespace Koterle\Roleable;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     *  Many to Many relationship
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsToMany(Config::get('roleable.user_model', 'App\\User'))
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
        return $this->belongsToMany('Koterle\\Roleable\\Permission')->withTimestamps();
    }
}
