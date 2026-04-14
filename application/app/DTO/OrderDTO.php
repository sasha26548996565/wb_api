<?php

declare(strict_types=1);

namespace App\DTO;

final class OrderDTO
{
    public function __construct(
        public readonly string $gNumber,
        public readonly string $date,
        public readonly ?string $lastChangeDate,
        public readonly string $supplierArticle,
        public readonly string $techSize,
        public readonly int $barcode,
        public readonly string $totalPrice,
        public readonly string $discountPercent,
        public readonly string $warehouseName,
        public readonly string $oblast,
        public readonly ?int $incomeId,
        public readonly string $odid,
        public readonly int $nmId,
        public readonly string $subject,
        public readonly string $category,
        public readonly string $brand,
        public readonly ?bool $isCancel,
        public readonly ?string $cancelDt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['g_number'] ?? '',
            $data['date'] ?? '',
            $data['last_change_date'] ?? null,
            $data['supplier_article'] ?? '',
            $data['tech_size'] ?? '',
            (int) ($data['barcode'] ?? 0),
            (string) ($data['total_price'] ?? ''),
            (string) ($data['discount_percent'] ?? ''),
            $data['warehouse_name'] ?? '',
            $data['oblast'] ?? '',
            isset($data['income_id']) ? (int) $data['income_id'] : null,
            (string) ($data['odid'] ?? ''),
            (int) ($data['nm_id'] ?? 0),
            $data['subject'] ?? '',
            $data['category'] ?? '',
            $data['brand'] ?? '',
            isset($data['is_cancel']) ? (bool) $data['is_cancel'] : null,
            $data['cancel_dt'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'g_number' => $this->gNumber,
            'date' => $this->date,
            'last_change_date' => $this->lastChangeDate,
            'supplier_article' => $this->supplierArticle,
            'tech_size' => $this->techSize,
            'barcode' => $this->barcode,
            'total_price' => $this->totalPrice,
            'discount_percent' => $this->discountPercent,
            'warehouse_name' => $this->warehouseName,
            'oblast' => $this->oblast,
            'income_id' => $this->incomeId,
            'odid' => $this->odid,
            'nm_id' => $this->nmId,
            'subject' => $this->subject,
            'category' => $this->category,
            'brand' => $this->brand,
            'is_cancel' => $this->isCancel,
            'cancel_dt' => $this->cancelDt,
        ];
    }
}
