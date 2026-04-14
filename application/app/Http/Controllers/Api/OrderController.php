<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Contracts\WildberriesApiClientContract;
use App\Filters\OrderFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\OrdersCollection;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function __construct(
        private readonly WildberriesApiClientContract $apiClient,
        private readonly OrderService $orderService,
    ) {}

    public function list(OrderRequest $request): OrdersCollection
    {
        return new OrdersCollection(
            OrderFilter::searchByRequest($request)
                ->paginate($request->limit ?? 500)
        );
    }

    public function store(OrderStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = $this->apiClient->fetchOrders(
            $validated['dateFrom'],
            $validated['dateTo'],
            (int) ($validated['limit'] ?? 100),
        );

        $stored = $this->orderService->store($data);

        return response()->json(['stored' => $stored]);
    }
}
