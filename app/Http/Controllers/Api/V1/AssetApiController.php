<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Http\Resources\AssetResource;
use App\Models\Asset;
use App\Models\Employee;
use App\Repositories\Contracts\AssetRepositoryInterface;
use App\Services\AssetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AssetApiController extends Controller
{
    public function __construct(
        protected AssetRepositoryInterface $assets,
        protected AssetService $assetService,
    ) {}

    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $this->authorize('viewAny', Asset::class);
        $filters = $request->only(['category_id', 'status', 'room_id', 'assigned', 'search']);
        $paginated = $this->assets->paginateWithFilters($filters, min(50, (int) $request->get('per_page', 20)));

        return AssetResource::collection($paginated);
    }

    public function store(StoreAssetRequest $request): AssetResource
    {
        $asset = $this->assetService->createAsset(
            $request->safe()->except('dynamic_fields'),
            $request->input('dynamic_fields', []),
            $request->user()
        );

        return new AssetResource($asset->load(['category', 'room', 'assignedEmployee', 'fields.field']));
    }

    public function show(Asset $asset): AssetResource
    {
        $this->authorize('view', $asset);
        $asset->load(['category', 'room', 'assignedEmployee', 'fields.field']);

        return new AssetResource($asset);
    }

    public function update(UpdateAssetRequest $request, Asset $asset): AssetResource
    {
        $asset = $this->assetService->updateAsset(
            $asset,
            $request->safe()->except('dynamic_fields'),
            $request->input('dynamic_fields', []),
            $request->user()
        );

        return new AssetResource($asset->load(['category', 'room', 'assignedEmployee', 'fields.field']));
    }

    public function destroy(Asset $asset): JsonResponse
    {
        $this->authorize('delete', $asset);
        $this->assets->delete($asset);

        return response()->json(null, 204);
    }

    public function assign(Request $request, Asset $asset): AssetResource
    {
        $this->authorize('update', $asset);
        $request->validate(['employee_id' => 'required|exists:employees,id', 'notes' => 'nullable|string']);
        $employee = Employee::findOrFail($request->employee_id);
        $this->assetService->checkOut($asset, $employee, $request->user(), $request->notes);

        return new AssetResource($asset->fresh(['category', 'room', 'assignedEmployee']));
    }

    public function unassign(Request $request, Asset $asset): AssetResource
    {
        $this->authorize('update', $asset);
        $request->validate(['notes' => 'nullable|string']);
        $this->assetService->checkIn($asset, $request->user(), $request->notes);

        return new AssetResource($asset->fresh(['category', 'room', 'assignedEmployee']));
    }
}
