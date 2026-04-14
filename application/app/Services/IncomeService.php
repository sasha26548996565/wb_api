<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\IncomeDTO;
use App\Models\Income;

class IncomeService
{
    public function store(array $dtos): int
    {
        if (empty($dtos)) {
            return 0;
        }

        $rows = array_map(fn(IncomeDTO $dto) => $dto->toArray(), $dtos);
        $updateColumns = array_keys($rows[0]);

        foreach (array_chunk($rows, 500) as $chunk) {
            Income::upsert(
                $chunk,
                uniqueBy: ['income_id', 'barcode'],
                update: $updateColumns
            );
        }

        return count($rows);
    }
}
