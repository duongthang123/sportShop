<?php

namespace App\Http\Repository\Admin;

use App\Http\Repository\Admin;

class RoleRepository
{
    protected $role;

    public function __construct(\Spatie\Permission\Models\Role $role)
    {
        $this->role = $role;
    }

    public function getAllRoles()
    {
        return $this->role::all()->groupBy('group');
    }
    public function getRoleById($id)
    {
        return $this->role::where('id', $id)->first();
    }

    public function findRoleById($id)
    {
        return $this->role::findOrFail($id);
    }

    public function create($data)
    {
        return $this->role::create($data);
    }

    public function deleteRoleById($id)
    {
        return $this->role::where('id', $id)->delete();
    }
}
