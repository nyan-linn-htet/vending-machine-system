<?php
namespace App\Repositories\Interfaces;

Interface RoleRepositoryInterface{

    public function allRoles();
    public function allRolesWithPaginate($paginate);
    public function storeRole($data);
    public function getRoleDetails($id);
    public function updateRole($data, $id);
    public function destroyRole($id);
}
