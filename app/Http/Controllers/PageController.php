<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ProductService;
use http\Exception\InvalidArgumentException;
use Illuminate\View\View;

class PageController extends Controller
{
    private ProductService $productService;

    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Index all available models by provided phrase.
     * @param string $phrase
     * @return View
     */
    public function indexByName(string $phrase): View
    {
        // Get all products with provided criteria.
        $products = $this->productService->getByName($phrase);

        // Return view with products.
        return view('products', compact('products'));
    }

    /**
     * Generate and insert random amount of Product models into database.
     * @param int $amount
     * @return void
     */
    public function insertRandom(int $amount): void
    {
        // Check if amount is lower or equal zero.
        if ($amount <= 0)
        {
            throw new InvalidArgumentException("Amount of generated models cannot be lower than 1.");
        }

        // Insert random amount of products to the database via product service.
        $this->productService->addRandom($amount);
    }
}
