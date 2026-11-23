<?php

require_once __DIR__ . '/../services/CategoryService.php';

$categoryService = new CategoryService();


Flight::route('GET /categories', function () use ($categoryService) {
    Flight::json($categoryService->getAllCategories(), 200);
});


Flight::route('GET /test/@id', function ($id) {
    Flight::json(['received_id' => $id], 200);
});


Flight::route('GET /categories/@id', function ($id) use ($categoryService) {
    $category = $categoryService->getCategoryById((int)$id);

    if (!$category) {
        Flight::json(['error' => 'Category not found'], 404);
        return;
    }

    Flight::json($category, 200);
});


Flight::route('POST /categories', function () use ($categoryService) {
    try {
        $data = Flight::request()->data->getData();
        $id = $categoryService->createCategory($data);

        Flight::json(['message' => 'Category created', 'id' => $id], 201);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});


Flight::route('PUT /categories/@id', function ($id) use ($categoryService) {
    try {
        $data = Flight::request()->data->getData();
        $updated = $categoryService->updateCategory((int)$id, $data);

        if (!$updated) {
            Flight::json(['error' => 'Category not found'], 404);
            return;
        }

        Flight::json(['message' => 'Category updated'], 200);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});


Flight::route('DELETE /categories/@id', function ($id) use ($categoryService) {
    $deleted = $categoryService->deleteCategory((int)$id);

    if (!$deleted) {
        Flight::json(['error' => 'Category not found'], 404);
        return;
    }

    Flight::json(['message' => 'Category deleted'], 200);
});