<?php

namespace App\Http\ApiV1\Modules\Users\Controllers;

use App\Domain\Users\Actions\CreateUserAction;
use App\Domain\Users\Actions\GetUserAction;
use App\Domain\Users\Actions\SearchUsersAction;
use App\Domain\Users\Actions\UpdateUserAction;
use App\Http\ApiV1\Modules\Users\Requests\CreateUserRequest;
use App\Http\ApiV1\Modules\Users\Requests\UpdateUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class UsersController
{
    /**
     * @throws Throwable
     */
    public function create(CreateUserRequest $request, CreateUserAction $action): JsonResponse
    {
        $action->execute($request->validated());

        return response()->json('', Response::HTTP_CREATED);
    }

    public function search(SearchUsersAction $action): JsonResponse
    {
        return response()->json($action->execute());
    }

    public function get(int $id, GetUserAction $action): JsonResponse
    {
        return response()->json($action->execute($id));
    }

    /**
     * @throws Throwable
     */
    public function update(int $id, UpdateUserRequest $request, UpdateUserAction $action): JsonResponse
    {
        $action->execute($request->validated(), $id);

        return response()->json();
    }
}
