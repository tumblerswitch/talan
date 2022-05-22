<?php

namespace App\Services;

use App\Models\UsersList;

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
}
