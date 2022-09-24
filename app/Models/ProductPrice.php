<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    private const PRODUCTS_PRICES_TABLE = "zad_1_ceny";

    // Set up default db table and primary key for Product Price Model.
    protected $table = self::PRODUCTS_PRICES_TABLE;
    protected $primaryKey = "id";

    // Set all fillable fields for this model.
    protected $fillable = [
        'product_id', 'value', 'type'
    ];

    // Cast all fillable attributes of model
    protected $casts = [
        'product_id' => 'integer',
        'value' => 'integer',
        'type' => 'integer'
    ];

    /**
     * Get product assigned to the product price.
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, "product_id", "id");
    }
}
