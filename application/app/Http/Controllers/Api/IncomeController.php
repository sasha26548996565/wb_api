<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Contracts\WildberriesApiClientContract;
use App\Filters\IncomeFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\IncomeRequest;
use App\Http\Requests\IncomeStoreRequest;
use App\Http\Resources\IncomesCollection;
use App\Services\IncomeService;
use Illuminate\Http\JsonResponse;

class IncomeController extends Controller
{
    public function __construct(
        private readonly WildberriesApiClientContract $apiClient,
        private readonly IncomeService $incomeService,
    ) {}

    public function list(IncomeRequest $request): IncomesCollection
    {
        return new IncomesCollection(
            IncomeFilter::searchByRequest($request)
                ->paginate($request->limit ?? 500)
        );
    }

    public function store(IncomeStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = $this->apiClient->fetchIncomes(
            $validated['dateFrom'],
            $validated['dateTo'],
            (int) ($validated['limit'] ?? 100),
        );

        $stored = $this->incomeService->store($data);

        return response()->json(['stored' => $stored]);
    }
}
