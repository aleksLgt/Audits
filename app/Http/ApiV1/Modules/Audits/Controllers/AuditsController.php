<?php

namespace App\Http\ApiV1\Modules\Audits\Controllers;

use App\Domain\Audits\Actions\CreateAuditAction;
use App\Domain\Audits\Actions\DeleteAuditAction;
use App\Domain\Audits\Actions\GetAuditAction;
use App\Domain\Audits\Actions\SearchAuditsAction;
use App\Domain\Audits\Actions\UpdateAuditAction;
use App\Http\ApiV1\Modules\Audits\Requests\CreateAuditRequest;
use App\Http\ApiV1\Modules\Audits\Requests\UpdateAuditRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuditsController
{
    /**
     * @throws AuthorizationException
     */
    public function create(CreateAuditRequest $request, CreateAuditAction $action): JsonResponse
    {
        Gate::authorize('can-create-audit');

        return response()->json($action->execute($request->validated()), Response::HTTP_CREATED);
    }

    public function get(int $id, GetAuditAction $action): JsonResponse
    {
        return response()->json($action->execute($id));
    }

    public function search(SearchAuditsAction $action): JsonResponse
    {
        return response()->json($action->execute());
    }

    /**
     * @throws AuthorizationException
     */
    public function update(int $id, UpdateAuditRequest $request, UpdateAuditAction $action): JsonResponse
    {
        Gate::authorize('can-update-audit', $id);

        return response()->json($action->execute($id, $request->validated()));
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(int $id, DeleteAuditAction $action): JsonResponse
    {
        Gate::authorize('can-delete-audit', $id);
        $action->execute($id);

        return response()->json();
    }
}
