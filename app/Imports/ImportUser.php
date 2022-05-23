<?php

namespace App\Imports;

use App\Models\UsersList;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportUser implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UsersList([
            'fio' => $row[0],
            'email' => $row[1],
            'phone' => $row[2],
        ]);
    }
}
