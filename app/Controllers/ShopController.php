<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Categorie;
use Mini\Models\Produit;

final class ShopController extends Controller
{
    public function categories(): void
    {
        $categories = Categorie::getAll();

        $this->render('shop/categories', params: [
            'title' => 'Catalogue - Catégories',
            'categories' => $categories,
        ]);
    }

    public function productsByCategory(string $id): void
    {
        $categoryId = (int) $id;
        $category = Categorie::findById($categoryId);

        if ($category === null) {
            http_response_code(404);
            echo 'Catégorie introuvable';
            return;
        }

        $products = Produit::getByCategorie($categoryId);

        $this->render('shop/products', params: [
            'title' => 'Produits - ' . ($category['nom'] ?? ''),
            'category' => $category,
            'products' => $products,
        ]);
    }

    public function productShow(string $id): void
    {
        $productId = (int) $id;
        $product = Produit::findById($productId);

        if ($product === null) {
            http_response_code(404);
            echo 'Produit introuvable';
            return;
        }

        $this->render('shop/product_show', params: [
            'title' => 'Fiche produit - ' . ($product['nom'] ?? ''),
            'product' => $product,
        ]);
    }
}
