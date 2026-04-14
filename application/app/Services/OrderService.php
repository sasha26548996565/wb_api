<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\OrderDTO;
use App\Models\Order;

class OrderService
{
    public function store(array $dtos): int
    {
        if (empty($dtos)) {
            return 0;
        }

        $rows = array_map(fn(OrderDTO $dto) => $dto->toArray(), $dtos);
        $updateColumns = array_keys($rows[0]);

        foreach (array_chunk($rows, 500) as $chunk) {
            Order::upsert(
                $chunk,
                uniqueBy: ['g_number', 'barcode', 'date'],
                update: $updateColumns
            );
        }

        return count($rows);
    }
}
