<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\SaleDTO;
use App\Models\Sale;

class SaleService
{
    public function store(array $dtos): int
    {
        if (empty($dtos)) {
            return 0;
        }

        $rows = array_map(fn(SaleDTO $dto) => $dto->toArray(), $dtos);
        $updateColumns = array_keys($rows[0]);

        foreach (array_chunk($rows, 500) as $chunk) {
            Sale::upsert(
                $chunk,
                uniqueBy: ['sale_id'],
                update: $updateColumns
            );
        }

        return count($rows);
    }
}
