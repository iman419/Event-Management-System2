<?php

declare(strict_types=1);

require_once __DIR__ . '/../dao/UserDao.php';

class UserService
{
    private UserDao $userDao;

    public function __construct(?UserDao $userDao = null)
    {
        $this->userDao = $userDao ?? new UserDao();
    }

    public function getAllUsers(): array
    {
        return $this->userDao->findAll();
    }

    public function getUserById(int $id): ?array
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid user ID.');
        }

        return $this->userDao->findById($id);
    }

    public function createUser(array $data): int
    {
        if (empty($data['full_name']) || empty($data['email']) || empty($data['password'])) {
            throw new InvalidArgumentException('Full name, email and password are required.');
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email address.');
        }

        if (strlen($data['password']) < 8) {
            throw new InvalidArgumentException('Password must be at least 8 characters long.');
        }

        $role = $data['role'] ?? 'user';

        if (!in_array($role, ['user', 'admin'], true)) {
            throw new InvalidArgumentException('Invalid user role.');
        }

        $userData = [
            'full_name' => trim($data['full_name']),
            'email' => trim($data['email']),
            'password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => $role
        ];

        return $this->userDao->create($userData);
    }

    public function updateUser(int $id, array $data): bool
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid user ID.');
        }

        if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email address.');
        }

        if (isset($data['full_name'])) {
            $data['full_name'] = trim($data['full_name']);

            if ($data['full_name'] === '') {
                throw new InvalidArgumentException('Full name cannot be empty.');
            }
        }

        if (isset($data['password'])) {
            if (strlen($data['password']) < 8) {
                throw new InvalidArgumentException('Password must be at least 8 characters long.');
            }

            $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
            unset($data['password']);
        }

        if (isset($data['role']) && !in_array($data['role'], ['user', 'admin'], true)) {
            throw new InvalidArgumentException('Invalid user role.');
        }

        return $this->userDao->update($id, $data);
    }

    public function deleteUser(int $id): bool
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid user ID.');
        }

        return $this->userDao->delete($id);
    }
}