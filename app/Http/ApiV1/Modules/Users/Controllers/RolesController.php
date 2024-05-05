<?php

namespace App\Http\ApiV1\Modules\Users\Controllers;

use App\Domain\Users\Actions\AddPermissionsAction;
use App\Domain\Users\Actions\SearchRolesAction;
use App\Http\ApiV1\Modules\Users\Requests\AddPermissionsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class RolesController
{
    public function search(SearchRolesAction $action): JsonResponse
    {
        return response()->json($action->execute());
    }

    /**
     * @throws Throwable
     */
    public function addPermissions(int $id, AddPermissionsRequest $request, AddPermissionsAction $action): JsonResponse
    {
        $action->execute($request->validated(), $id);

        return response()->json('', Response::HTTP_CREATED);
    }
}
