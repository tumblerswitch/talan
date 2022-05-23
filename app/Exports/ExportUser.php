<?php

namespace App\Exports;

use App\Models\UsersList;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportUser implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UsersList::all();
    }
}
