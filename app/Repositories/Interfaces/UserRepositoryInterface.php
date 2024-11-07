<?php
namespace App\Repositories\Interfaces;

Interface UserRepositoryInterface {

    public function allUsers();
    public function storeUser($data);
    public function getUserDetails($id);
    public function updateUser($data, $id);
    public function destroyUser($id);
    public function filterUser($data);
}
