<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\WildberriesApiClientContract;
use App\DTO\IncomeDTO;
use App\DTO\OrderDTO;
use App\DTO\SaleDTO;
use App\DTO\StockDTO;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

class WildberriesApiClient implements WildberriesApiClientContract
{
    public function __construct(
        private readonly Client $httpClient,
        private readonly string $apiUrl,
        private readonly string $apiKey,
    ) {}

    public function fetchStocks(string $dateFrom, string $dateTo, int $limit = 100): array
    {
        return $this->fetchAll(
            'stocks',
            ['dateFrom' => $dateFrom, 'dateTo' => $dateTo],
            $limit,
            fn(array $item) => StockDTO::fromArray($item)
        );
    }

    public function fetchIncomes(string $dateFrom, string $dateTo, int $limit = 100): array
    {
        return $this->fetchAll(
            'incomes',
            ['dateFrom' => $dateFrom, 'dateTo' => $dateTo],
            $limit,
            fn(array $item) => IncomeDTO::fromArray($item)
        );
    }

    public function fetchSales(string $dateFrom, string $dateTo, int $limit = 100): array
    {
        return $this->fetchAll(
            'sales',
            ['dateFrom' => $dateFrom, 'dateTo' => $dateTo],
            $limit,
            fn(array $item) => SaleDTO::fromArray($item)
        );
    }

    public function fetchOrders(string $dateFrom, string $dateTo, int $limit = 100): array
    {
        return $this->fetchAll(
            'orders',
            ['dateFrom' => $dateFrom, 'dateTo' => $dateTo],
            $limit,
            fn(array $item) => OrderDTO::fromArray($item)
        );
    }

    private function fetchAll(string $endpoint, array $params, int $limit, callable $factory): array
    {
        $page = 1;
        $result = [];

        do {
            $items = $this->fetchPage($endpoint, array_merge($params, [
                'page' => $page,
                'limit' => $limit,
                'key' => $this->apiKey,
            ]), $factory);

            $result = array_merge($result, $items);
            $page++;
        } while (count($items) === $limit);

        return $result;
    }

    private function fetchPage(string $endpoint, array $query, callable $factory): array
    {
        try {
            $response = $this->httpClient->get("{$this->apiUrl}/api/{$endpoint}", [
                'query' => $query,
            ]);

            $body = json_decode(
                (string) $response->getBody(),
                true,
                512,
                JSON_THROW_ON_ERROR
            );

            return array_map($factory, $body['data'] ?? []);
        } catch (GuzzleException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }
}
