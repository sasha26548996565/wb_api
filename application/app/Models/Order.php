<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $hidden = [
        'updated_at',
        'created_at',
        'id',
    ];

    protected $fillable = [
        'g_number',
        'date',
        'last_change_date',
        'supplier_article',
        'tech_size',
        'barcode',
        'total_price',
        'discount_percent',
        'warehouse_name',
        'oblast',
        'income_id',
        'odid',
        'nm_id',
        'subject',
        'category',
        'brand',
        'is_cancel',
        'cancel_dt',
    ];

    protected $casts = [
        'date' => 'datetime',
        'last_change_date' => 'date:Y-m-d',
        'cancel_dt' => 'datetime',
        'barcode' => 'integer',
        'income_id' => 'integer',
        'nm_id' => 'integer',
        'is_cancel' => 'boolean',
    ];
}
