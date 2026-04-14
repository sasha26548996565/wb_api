<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\StockDTO;
use App\Models\Stock;

class StockService
{
    public function store(array $dtos): int
    {
        if (empty($dtos)) {
            return 0;
        }

        $rows = array_map(fn(StockDTO $dto) => $dto->toArray(), $dtos);
        $updateColumns = array_keys($rows[0]);

        foreach (array_chunk($rows, 500) as $chunk) {
            Stock::upsert(
                $chunk,
                uniqueBy: ['barcode', 'date', 'warehouse_name'],
                update: $updateColumns
            );
        }

        return count($rows);
    }
}
