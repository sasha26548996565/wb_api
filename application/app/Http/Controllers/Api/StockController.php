<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Contracts\WildberriesApiClientContract;
use App\Filters\StockFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StockRequest;
use App\Http\Requests\StockStoreRequest;
use App\Http\Resources\StocksCollection;
use App\Services\StockService;
use Illuminate\Http\JsonResponse;

class StockController extends Controller
{
    public function __construct(
        private readonly WildberriesApiClientContract $apiClient,
        private readonly StockService $stockService,
    ) {}

    public function list(StockRequest $request): StocksCollection
    {
        return new StocksCollection(
            StockFilter::searchByRequest($request)
                ->paginate($request->limit ?? 500)
        );
    }

    public function store(StockStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = $this->apiClient->fetchStocks(
            $validated['dateFrom'],
            $validated['dateTo'],
            (int) ($validated['limit'] ?? 100),
        );

        $stored = $this->stockService->store($data);

        return response()->json(['stored' => $stored]);
    }
}
