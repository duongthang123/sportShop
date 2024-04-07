<?php

namespace App\Http\Services\Admin;

use App\Http\Repository\Admin\RoleRepository;
use App\Http\Services\Admin;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $repository)
    {
        $this->roleRepository = $repository;
    }

    public function getAllRoles()
    {
        return $this->roleRepository->getAllRoles();
    }
    public function createRole($request)
    {
        $data = $request->all();
        $data['guard_name'] = 'web';
        if ($request->has('permissions_id')) {
            $role = $this->roleRepository->create($data);
            $role->permissions()->attach($data['permissions_id']);
        } else {
            $this->roleRepository->create($data);
        }
    }

    public function update($id, $request)
    {
        $role = $this->roleRepository->findRoleById($id);
        $dataUpdate = $request->all();
        $role->update($dataUpdate);
        $role->permissions()->sync($dataUpdate['permissions_id'] ?? []);
    }

    public function destroy($id)
    {
        $role = $this->roleRepository->getRoleById($id);
        if($role) {
            return $this->roleRepository->deleteRoleById($id);
        }
        return false;
    }
}
