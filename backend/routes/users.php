<?php

require_once __DIR__ . '/../services/UserService.php';

$userService = new UserService();


Flight::route('GET /users', function () use ($userService) {
    Flight::json($userService->getAllUsers(), 200);
});


Flight::route('GET /users/@id', function ($id) use ($userService) {
    $user = $userService->getUserById((int)$id);

    if (!$user) {
        Flight::json(['error' => 'User not found'], 404);
        return;
    }

    Flight::json($user, 200);
});


Flight::route('POST /users', function () use ($userService) {
    try {
        $data = Flight::request()->data->getData();
        $id = $userService->createUser($data);

        Flight::json(['message' => 'User created', 'id' => $id], 201);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});


Flight::route('PUT /users/@id', function ($id) use ($userService) {
    try {
        $data = Flight::request()->data->getData();
        $updated = $userService->updateUser((int)$id, $data);

        if (!$updated) {
            Flight::json(['error' => 'User not found'], 404);
            return;
        }

        Flight::json(['message' => 'User updated'], 200);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});


Flight::route('DELETE /users/@id', function ($id) use ($userService) {
    $deleted = $userService->deleteUser((int)$id);

    if (!$deleted) {
        Flight::json(['error' => 'User not found'], 404);
        return;
    }

    Flight::json(['message' => 'User deleted'], 200);
});