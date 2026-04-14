<?php

declare(strict_types=1);

namespace App\DTO;

final class IncomeDTO
{
    public function __construct(
        public readonly int $incomeId,
        public readonly ?string $number,
        public readonly string $date,
        public readonly ?string $lastChangeDate,
        public readonly string $supplierArticle,
        public readonly string $techSize,
        public readonly int $barcode,
        public readonly int $quantity,
        public readonly string $totalPrice,
        public readonly ?string $dateClose,
        public readonly string $warehouseName,
        public readonly int $nmId,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            (int) ($data['income_id'] ?? 0),
            $data['number'] ?? null,
            $data['date'] ?? '',
            $data['last_change_date'] ?? null,
            $data['supplier_article'] ?? '',
            $data['tech_size'] ?? '',
            (int) ($data['barcode'] ?? 0),
            (int) ($data['quantity'] ?? 0),
            (string) ($data['total_price'] ?? ''),
            $data['date_close'] ?? null,
            $data['warehouse_name'] ?? '',
            (int) ($data['nm_id'] ?? 0),
        );
    }

    public function toArray(): array
    {
        return [
            'income_id' => $this->incomeId,
            'number' => $this->number,
            'date' => $this->date,
            'last_change_date' => $this->lastChangeDate,
            'supplier_article' => $this->supplierArticle,
            'tech_size' => $this->techSize,
            'barcode' => $this->barcode,
            'quantity' => $this->quantity,
            'total_price' => $this->totalPrice,
            'date_close' => $this->dateClose,
            'warehouse_name' => $this->warehouseName,
            'nm_id' => $this->nmId,
        ];
    }
}
