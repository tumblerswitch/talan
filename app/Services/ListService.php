<?php

namespace App\Services;

use App\Models\UsersList;
use Illuminate\Pagination\LengthAwarePaginator;

class ListService
{
    public function addUserToDb(array $data): UsersList
    {
        $newList = UsersList::create(
            [
                'fio' => $data['fio'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]
        );
        $newList->save();

        return $newList;
    }

    public function getAllUsers(): LengthAwarePaginator
    {
        return UsersList::orderBy('id')->paginate();
    }
}
