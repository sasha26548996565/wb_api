<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $hidden = [
        'updated_at',
        'created_at',
        'id',
    ];

    protected $fillable = [
        'income_id',
        'number',
        'date',
        'last_change_date',
        'supplier_article',
        'tech_size',
        'barcode',
        'quantity',
        'total_price',
        'date_close',
        'warehouse_name',
        'nm_id',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'last_change_date' => 'date:Y-m-d',
        'date_close' => 'date:Y-m-d',
        'income_id' => 'integer',
        'barcode' => 'integer',
        'quantity' => 'integer',
        'nm_id' => 'integer',
    ];
}
