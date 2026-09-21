<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fruit extends Model
{
    protected $fillable = [
        'code',
        'name',
        'category',
        'price',
        'stock',
        'unit',
        'minimum_stock',
        'image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'decimal:2',
        'minimum_stock' => 'decimal:2',
    ];

    public function transactionDetails(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
