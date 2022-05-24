<?php

namespace App\Http\Controllers\Api;

use App\Exports\ExportUser;
use App\Imports\ImportUser;
use App\Services\ListService;
use App\Http\Requests\ListRequest;
use App\Http\Resources\ListResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\XlsxFileRequest;
use App\Http\Resources\ListsCollection;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ListApiController extends Controller
{
    private ListService $listService;

    public function __construct(ListService $listService)
    {
        $this->listService = $listService;
    }

    public function storeUser(ListRequest $request): ListResource
    {
        $user = $this->listService->addUserToDb($request->validated());

        Redis::set('users_list.' . $user->id, $user);

        return new ListResource($user);
    }

    public function getUsersListFromCache(): ListsCollection
    {
        $users_keys = Redis::keys('users_list.*');

        if (empty($users_keys)) {
            $users = $this->listService->getAllUsers();

            foreach ($users as $user) {
                Redis::set('users_list.' . $user->id, $user);
            }

            return new ListsCollection($users);
        }

        $users = [];

        foreach ($users_keys as $key) {
            $users[] = json_decode(Redis::get($key));
        }

        return new ListsCollection($users);
    }

    public function getUsersListFromDb(): ListsCollection
    {
        $users = $this->listService->getAllUsers();

        return new ListsCollection($users);
    }

    //todo можно добавить сохранение файла в Storage
    public function importUsersFromXlsxFile(XlsxFileRequest $request): ListsCollection
    {
        $users = $this->listService->importUsersFromXlsxFile(new ImportUser, $request->file('file'));

        return new ListsCollection($users);
    }

    public function exportUsersFromXlsxFile(): BinaryFileResponse
    {
        return $this->listService->exportUsersFromXlsxFile(new ExportUser, 'users-list.xlsx');
    }
}
