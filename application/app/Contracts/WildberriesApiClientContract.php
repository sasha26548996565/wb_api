<?php

declare(strict_types=1);

namespace App\Contracts;

interface WildberriesApiClientContract
{
    public function fetchStocks(string $dateFrom, string $dateTo, int $limit = 100): array;

    public function fetchIncomes(string $dateFrom, string $dateTo, int $limit = 100): array;

    public function fetchSales(string $dateFrom, string $dateTo, int $limit = 100): array;

    public function fetchOrders(string $dateFrom, string $dateTo, int $limit = 100): array;
}
