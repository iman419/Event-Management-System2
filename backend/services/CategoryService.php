<?php

declare(strict_types=1);

require_once __DIR__ . '/../dao/CategoryDao.php';

class CategoryService
{
    private CategoryDao $categoryDao;

    public function __construct(?CategoryDao $categoryDao = null)
    {
        $this->categoryDao = $categoryDao ?? new CategoryDao();
    }

    public function getAllCategories(): array
    {
        return $this->categoryDao->findAll();
    }

    public function getCategoryById(int $id): ?array
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid category ID.');
        }

        return $this->categoryDao->findById($id);
    }

    public function createCategory(array $data): int
    {
        if (empty($data['name'])) {
            throw new InvalidArgumentException('Category name is required.');
        }

        $categoryData = [
            'name' => trim($data['name']),
            'description' => $data['description'] ?? null
        ];

        if ($categoryData['name'] === '') {
            throw new InvalidArgumentException('Category name cannot be empty.');
        }

        return $this->categoryDao->create($categoryData);
    }

    public function updateCategory(int $id, array $data): bool
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid category ID.');
        }

        if (isset($data['name'])) {
            $data['name'] = trim($data['name']);

            if ($data['name'] === '') {
                throw new InvalidArgumentException('Category name cannot be empty.');
            }
        }

        return $this->categoryDao->update($id, $data);
    }

    public function deleteCategory(int $id): bool
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid category ID.');
        }

        return $this->categoryDao->delete($id);
    }
}