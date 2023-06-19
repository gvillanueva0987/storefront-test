<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = [];

        $categories = ['Category 1', 'Category 2', 'Category 3'];
        $images = [
            'https://s3-us-west-2.amazonaws.com/s.cdpn.io/881020/nike01', 
            'https://s3-us-west-2.amazonaws.com/s.cdpn.io/881020/nike02', 
            'https://s3-us-west-2.amazonaws.com/s.cdpn.io/881020/nike03',
            'https://s3-us-west-2.amazonaws.com/s.cdpn.io/881020/nike04',
            'https://s3-us-west-2.amazonaws.com/s.cdpn.io/881020/nike05',
            'https://s3-us-west-2.amazonaws.com/s.cdpn.io/881020/nike06',
        ];

        for ($i = 1; $i <= 150; $i++) {
            $name = "Product $i";
            $price = rand(1, 1000);
            $description = "Description of Product $i";
            $imported = (bool)rand(0, 1);
            $category = $categories[rand(0, 2)];
            $image = $images[rand(0, 5)];

            $product = [
                'name' => $name,
                'price' => $price,
                'description' => $description,
                'imported' => $imported,
                'category' => $category,
                'image' => $image
            ];

            $products[] = $product;
        }

        if ($request->has('category')) {
            $categoryToFilter = 'category';
            $products = array_filter($products, function($product) use ($categoryToFilter) {
                return filterByCategory($product, $categoryToFilter);
            });
        }

        if ($request->has('price_range')) {
            $categoryToFilter = 'price';
            $products = array_filter($products, function($product) use ($categoryToFilter) {
                return filterByPrice($product, $categoryToFilter);
            });
        }

        return view('product-listing', ['products' => $products]);
    }

    function filterByCategory($product, $category)
    {
        return $product['category'] === $category;
    }

    function filterByPrice($product, $price)
    {
        return $product['price'] <= $price;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
