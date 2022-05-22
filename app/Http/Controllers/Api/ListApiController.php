<?php

namespace App\Http\Controllers\Api;

use App\Services\ListService;
use App\Http\Requests\ListRequest;
use App\Http\Resources\ListResource;
use App\Http\Controllers\Controller;

class ListApiController extends Controller
{
    private ListService $listService;

    public function __construct(ListService $listService)
    {
        $this->listService = $listService;
    }

    public function storeUserToDb(ListRequest $request): ListResource
    {
        $user = $this->listService->addUserToDb($request->validated());

        return new ListResource($user);
    }
}
