<?php

declare(strict_types=1);

namespace App\DTO;

final class SaleDTO
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
        public readonly ?bool $isSupply,
        public readonly ?bool $isRealization,
        public readonly ?string $promoCodeDiscount,
        public readonly string $warehouseName,
        public readonly string $countryName,
        public readonly string $oblastOkrugName,
        public readonly string $regionName,
        public readonly ?int $incomeId,
        public readonly string $saleId,
        public readonly ?int $odid,
        public readonly string $spp,
        public readonly string $forPay,
        public readonly string $finishedPrice,
        public readonly string $priceWithDisc,
        public readonly int $nmId,
        public readonly string $subject,
        public readonly string $category,
        public readonly string $brand,
        public readonly ?bool $isStorno,
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
            isset($data['is_supply']) ? (bool) $data['is_supply'] : null,
            isset($data['is_realization']) ? (bool) $data['is_realization'] : null,
            isset($data['promo_code_discount']) ? (string) $data['promo_code_discount'] : null,
            $data['warehouse_name'] ?? '',
            $data['country_name'] ?? '',
            $data['oblast_okrug_name'] ?? '',
            $data['region_name'] ?? '',
            isset($data['income_id']) ? (int) $data['income_id'] : null,
            $data['sale_id'] ?? '',
            isset($data['odid']) ? (int) $data['odid'] : null,
            (string) ($data['spp'] ?? ''),
            (string) ($data['for_pay'] ?? ''),
            (string) ($data['finished_price'] ?? ''),
            (string) ($data['price_with_disc'] ?? ''),
            (int) ($data['nm_id'] ?? 0),
            $data['subject'] ?? '',
            $data['category'] ?? '',
            $data['brand'] ?? '',
            isset($data['is_storno']) ? (bool) $data['is_storno'] : null,
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
            'is_supply' => $this->isSupply,
            'is_realization' => $this->isRealization,
            'promo_code_discount' => $this->promoCodeDiscount,
            'warehouse_name' => $this->warehouseName,
            'country_name' => $this->countryName,
            'oblast_okrug_name' => $this->oblastOkrugName,
            'region_name' => $this->regionName,
            'income_id' => $this->incomeId,
            'sale_id' => $this->saleId,
            'odid' => $this->odid,
            'spp' => $this->spp,
            'for_pay' => $this->forPay,
            'finished_price' => $this->finishedPrice,
            'price_with_disc' => $this->priceWithDisc,
            'nm_id' => $this->nmId,
            'subject' => $this->subject,
            'category' => $this->category,
            'brand' => $this->brand,
            'is_storno' => $this->isStorno,
        ];
    }
}
