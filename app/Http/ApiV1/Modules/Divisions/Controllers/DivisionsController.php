<?php

namespace App\Http\ApiV1\Modules\Divisions\Controllers;

use App\Domain\Divisions\Actions\CreateDivisionAction;
use App\Domain\Divisions\Actions\DeleteDivisionAction;
use App\Domain\Divisions\Actions\GetDivisionAction;
use App\Domain\Divisions\Actions\GetReportByDivisionsAction;
use App\Domain\Divisions\Actions\SearchDivisionsAction;
use App\Domain\Divisions\Actions\UpdateDivisionAction;
use App\Http\ApiV1\Modules\Divisions\Requests\CreateDivisionRequest;
use App\Http\ApiV1\Modules\Divisions\Requests\UpdateDivisionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DivisionsController
{
    public function create(CreateDivisionRequest $request, CreateDivisionAction $action): JsonResponse
    {
        return response()->json($action->execute($request->validated()), Response::HTTP_CREATED);
    }

    public function search(SearchDivisionsAction $action): JsonResponse
    {
        return response()->json($action->execute());
    }

    public function get(int $id, GetDivisionAction $action): JsonResponse
    {
        return response()->json($action->execute($id));
    }

    public function update(int $id, UpdateDivisionRequest $request, UpdateDivisionAction $action): JsonResponse
    {
        return response()->json($action->execute($request->validated(), $id));
    }

    public function delete(int $id, DeleteDivisionAction $action): JsonResponse
    {
        $action->execute($id);

        return response()->json();
    }

    public function report(GetReportByDivisionsAction $action): JsonResponse
    {
        return response()->json($action->execute());
    }
}
