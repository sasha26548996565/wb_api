<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Contracts\WildberriesApiClientContract;
use App\Filters\SaleFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Http\Requests\SaleStoreRequest;
use App\Http\Resources\SalesCollection;
use App\Services\SaleService;
use Illuminate\Http\JsonResponse;

class SaleController extends Controller
{
    public function __construct(
        private readonly WildberriesApiClientContract $apiClient,
        private readonly SaleService $saleService,
    ) {}

    public function list(SaleRequest $request): SalesCollection
    {
        return new SalesCollection(
            SaleFilter::searchByRequest($request)
                ->paginate($request->limit ?? 500)
        );
    }

    public function store(SaleStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = $this->apiClient->fetchSales(
            $validated['dateFrom'],
            $validated['dateTo'],
            (int) ($validated['limit'] ?? 100),
        );

        $stored = $this->saleService->store($data);

        return response()->json(['stored' => $stored]);
    }
}
