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
    {//todo тут можно сделать валидацию каждой строки прежде чем вносить https://docs.laravel-excel.com/3.1/imports/validation.html
        return new UsersList([
            'fio' => $row[0],
            'email' => $row[1],
            'phone' => $row[2],
        ]);
    }
}
