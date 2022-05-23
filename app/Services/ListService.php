<?php

namespace App\Services;

use App\Models\UsersList;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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

    public function importUsersFromXlsxFile(ImportUser $importUser, UploadedFile $xlsxFile): LengthAwarePaginator
    {
        Excel::import($importUser, $xlsxFile);

        return UsersList::orderBy('id')->paginate();
    }

    public function exportUsersFromXlsxFile(ExportUser $exportUser, string $fileName): BinaryFileResponse
    {
        return Excel::download($exportUser, $fileName);
    }
}
