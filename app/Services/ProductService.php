<?php

namespace App\Services;

use App\Helpers\NameGenerator;
use App\Models\Product;
use App\Models\ProductPrice;
use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class ProductService
{
    /**
     * Get all products by name
     * @param string $name
     * @return Collection
     */
    public function getByName(string $name): Collection
    {
        // Check if name length is shorter than three characters.
        if (Str::length($name) < 3) {
            throw new InvalidArgumentException("Name length must be higher than 3 characters.");
        }

        // Return product with ProductPrice relation.
        return Product::query()->with('prices')->where("name", "LIKE", "%$name%")->get();
    }

    /**
     * Add random amount of product models.
     * @param int $amount
     * @return void
     */
    public function addRandom(int $amount): void
    {
        // Create models collection for future use.
        $models = new Collection();

        // Iterate amount to create, initialize new Product model and product price model with relation.
        for ($i = 0; $i < $amount; $i++) {
            $productModel = Product::create([
                'name' => NameGenerator::generate(5)
            ]);

            // Initialize new ProductPrice model.
            $productPriceModel = new ProductPrice([
                'value' => 23,
                'type' => 0
            ]);

            // Save productPrice in relation with Product.
            $productModel->prices()->save($productPriceModel);

            // Add new product model to products collection.
            $models->add($productModel);
        }

        // Set discount on random drawn amount of object with percentage.
        $this->randomDiscount($amount, 0.25, 0.20, $models);
    }

    /**
     * Generate random discount for product models.
     * @param int $amount
     * @param float $modelsPercentage
     * @param float $discountPercentage
     * @param Collection $models
     * @return void
     */
    public function randomDiscount(int $amount, float $modelsPercentage, float $discountPercentage, Collection $models): void
    {
        $calculatedModelsNumber = $amount * $modelsPercentage;
        $modelsToDiscount = $models->random($calculatedModelsNumber);

        foreach ($modelsToDiscount as $model) {
            $calculatedDiscount = $model->standardPrice->value - ($model->standardPrice->value * $discountPercentage);
            $discountModel = new ProductPrice([
                'value' => $calculatedDiscount,
                'type' => 1
            ]);

            $model->prices()->save($discountModel);
        }
    }
}
