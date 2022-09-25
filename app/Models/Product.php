<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    private const PRODUCTS_TABLE = "zad_1_produkty";

    /* Set up default db table and primary key for Product Model. */
    protected $table = self::PRODUCTS_TABLE;
    protected $primaryKey = "id";

    /* Set all fillable fields for this model. */
    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'price' => 'integer'
    ];

    /**
     * Get all prices for this product model.
     * @return HasMany
     */
    public function prices(): HasMany
    {
        return $this->hasMany(ProductPrice::class, 'product_id', 'id');
    }

    /**
     * Get discounted price of the product if exists.
     * @return ProductPrice|null
     */
    public function discountPrice(): ?ProductPrice
    {
        return $this->prices()->where('type', 1)->first() ?: null;
    }

    /**
     * Get standard price of the product.
     * @return ProductPrice
     */
    public function standardPrice(): ProductPrice
    {
        return $this->prices()->whereNot('type', 1)->first();
    }

    /**
     * Get price attribute to sort.
     * @return int
     */
    public function getPriceAttribute(): int
    {
        return $this->discountPrice() ? (int)$this->discountPrice()->value : (int)$this->standardPrice()->value;
    }
}
