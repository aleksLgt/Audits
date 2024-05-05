<?php

namespace App\Http\ApiV1\Modules\AuditBlocks\Controllers;

use App\Domain\AuditBlocks\Actions\CreateAuditBlockAction;
use App\Domain\AuditBlocks\Actions\DeleteAuditBlockAction;
use App\Domain\AuditBlocks\Actions\GetAuditBlockAction;
use App\Domain\AuditBlocks\Actions\SearchAuditBlocksAction;
use App\Domain\AuditBlocks\Actions\UpdateAuditBlockAction;
use App\Http\ApiV1\Modules\AuditBlocks\Requests\CreateAuditBlockRequest;
use App\Http\ApiV1\Modules\AuditBlocks\Requests\UpdateAuditBlockRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuditBlocksController
{
    public function create(CreateAuditBlockRequest $request, CreateAuditBlockAction $action): JsonResponse
    {
        return response()->json($action->execute($request->validated()),Response::HTTP_CREATED);
    }

    public function get(int $id, GetAuditBlockAction $action): JsonResponse
    {
        return response()->json($action->execute($id));
    }

    public function search(SearchAuditBlocksAction $action): JsonResponse
    {
        return response()->json($action->execute());
    }

    public function update(int $id, UpdateAuditBlockRequest $request, UpdateAuditBlockAction $action): JsonResponse
    {
        return response()->json($action->execute($id, $request->validated()));
    }

    public function delete(int $id, DeleteAuditBlockAction $action): JsonResponse
    {
        $action->execute($id);

        return response()->json();
    }
}
