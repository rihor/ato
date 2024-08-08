<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => ProductStatus::class,
        ];
    }

    public function changes() : HasMany
    {
        return $this->hasMany(ProductHistory::class);
    }

    public function latestChange() : HasOne
    {
        return $this->hasOne(ProductHistory::class)->latestOfMany();
    }
}
