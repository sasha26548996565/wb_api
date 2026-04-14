<?php

declare(strict_types=1);

namespace App\DTO;

final class StockDTO
{
    public function __construct(
        public readonly string $date,
        public readonly ?string $lastChangeDate,
        public readonly string $supplierArticle,
        public readonly string $techSize,
        public readonly int $barcode,
        public readonly int $quantity,
        public readonly ?bool $isSupply,
        public readonly ?bool $isRealization,
        public readonly ?int $quantityFull,
        public readonly string $warehouseName,
        public readonly ?int $inWayToClient,
        public readonly ?int $inWayFromClient,
        public readonly int $nmId,
        public readonly string $subject,
        public readonly string $category,
        public readonly string $brand,
        public readonly int $scCode,
        public readonly string $price,
        public readonly string $discount,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['date'] ?? '',
            $data['last_change_date'] ?? null,
            $data['supplier_article'] ?? '',
            $data['tech_size'] ?? '',
            (int) ($data['barcode'] ?? 0),
            (int) ($data['quantity'] ?? 0),
            isset($data['is_supply']) ? (bool) $data['is_supply'] : null,
            isset($data['is_realization']) ? (bool) $data['is_realization'] : null,
            isset($data['quantity_full']) ? (int) $data['quantity_full'] : null,
            $data['warehouse_name'] ?? '',
            isset($data['in_way_to_client']) ? (int) $data['in_way_to_client'] : null,
            isset($data['in_way_from_client']) ? (int) $data['in_way_from_client'] : null,
            (int) ($data['nm_id'] ?? 0),
            $data['subject'] ?? '',
            $data['category'] ?? '',
            $data['brand'] ?? '',
            (int) ($data['sc_code'] ?? 0),
            (string) ($data['price'] ?? ''),
            (string) ($data['discount'] ?? ''),
        );
    }

    public function toArray(): array
    {
        return [
            'date' => $this->date,
            'last_change_date' => $this->lastChangeDate,
            'supplier_article' => $this->supplierArticle,
            'tech_size' => $this->techSize,
            'barcode' => $this->barcode,
            'quantity' => $this->quantity,
            'is_supply' => $this->isSupply,
            'is_realization' => $this->isRealization,
            'quantity_full' => $this->quantityFull,
            'warehouse_name' => $this->warehouseName,
            'in_way_to_client' => $this->inWayToClient,
            'in_way_from_client' => $this->inWayFromClient,
            'nm_id' => $this->nmId,
            'subject' => $this->subject,
            'category' => $this->category,
            'brand' => $this->brand,
            'sc_code' => $this->scCode,
            'price' => $this->price,
            'discount' => $this->discount,
        ];
    }
}
