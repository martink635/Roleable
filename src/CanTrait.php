<?php

namespace Koterle\Roleable;

use Koterle\Roleable\Role;

trait CanTrait
{
    /**
     *  Many to Many relationship
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
    {
        return $this->belongsToMany('Koterle\\Roleable\\Role', \Config::get('roleable::tables.role_user'))
            ->withPivot('roleable_id', 'roleable_type')
            ->withTimestamps();
    }

    /**
     * Checks if the user has the permission on the
     * given model type and id.
     *
     * @access public
     * @param string $name
     * @param string $modelType
     * @param integer $modelId
     * @return boolean
     */
    public function can($permissionName, $modelType, $modelId)
    {
        $roles = $this->fetchRoles($modelType, $modelId);

        return $this->hasPermission($roles, $permissionName);
    }

    /**
     * Inverse of can.
     *
     * @access public
     * @param string $name
     * @param string $modelType
     * @param integer $modelId
     * @return boolean
     */
    public function cannot($name, $modelType, $modelId)
    {
        return ! $this->can($name, $modelType, $modelId);
    }

    /**
     * Checks if the user is assigned to the role
     * for the given model type and model id.
     *
     * @access public
     * @param string $name
     * @param string $modelType
     * @param integer $modelId
     * @return boolean
     */
    public function is($name, $modelType, $modelId)
    {
        return $this->fetchRole($name, $modelType, $modelId) ? true : false;
    }

    /**
     * Attach a role to the user.
     *
     * @access public
     * @param string $name
     * @param string $modelType
     * @param integer $modelId
     * @return void
     */
    public function attachRole($name, $modelType, $modelId)
    {
        $role = Role::whereName($name)->first();
        $this->roles()->attach($role, array('roleable_id' => $modelId, 'roleable_type' => $modelType));
    }

    /**
     * Detach a role to the user.
     *
     * @access public
     * @param string $name
     * @param string $modelType
     * @param integer $modelId
     * @return void
     */
    public function detachRole($name, $modelType, $modelId)
    {
        $role = Role::whereName($name)->first();
        $this->roles()->detach($role, array('roleable_id' => $modelId, 'roleable_type' => $modelType));
    }

    /**
     * Fetch all user roles by model id and type.
     *
     * @access protected
     * @param string $modelType
     * @param integer $modelId
     * @return Illuminate\Database\Eloquent\Collection
     */
    protected function fetchRoles($modelType, $modelId)
    {
        return $this->roles()->with('permissions')->whereUserId($this->id)
                             ->whereRoleableType($modelType)
                             ->whereRoleableId($modelId)
                             ->get();
    }

    /**
     * Check if one of the roles has the given permission.
     *
     * @access protected
     * @param Illuminate\Database\Eloquent\Collection $roles
     * @param string $permissionName
     * @return boolean
     */
    protected function hasPermission($roles, $permissionName)
    {
        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission->name === $permissionName) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Fetches a single user role for the given model and id.
     *
     * @access protected
     * @param string $name
     * @param string $modelType
     * @param string $modelId
     * @return type
     */
    protected function fetchRole($roleName, $modelType, $modelId)
    {
        return $this->roles()->whereName($roleName)
                             ->whereRoleableType($modelType)
                             ->whereRoleableId($modelId)
                             ->first();
    }
}
