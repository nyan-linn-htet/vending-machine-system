<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;


class RoleRepository implements RoleRepositoryInterface
{

    public function allRoles()
    {
        return Role::pluck('id', 'name');
    }

    public function allRolesWithPaginate($paginate)
    {
        return Role::paginate($paginate);
    }

    public function storeRole($data)
    {
        DB::beginTransaction();

        try{
            $role = Role::create([
                'name'  =>  $data->name,
                'guard_name' => 'web'
            ]);

            $role->permissions()->sync($data->permissions);
            DB::commit();

            return true;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }

    }

    public function getRoleDetails($id)
    {
        return Role::where('id',$id)->first();
    }

    public function updateRole($data, $id)
    {
        DB::beginTransaction();

        try{

            $role = Role::where('id', $id)->first();
            $role->update([
                'name'  =>  $data->name,
            ]);

            $role->permissions()->sync($data->permissions);

            DB::commit();

            return true;
        }catch (Exception $e){
            DB::rollback();
            dd($e);
            return false;
        }
    }

    public function destroyRole($id)
    {
        $role = Role::where('id', $id)->first();
        if(isset($role)){
            $status = $role->delete();
        }else{
            $status = false;
        }

        return $status;
    }
}
