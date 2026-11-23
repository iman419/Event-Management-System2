<?php

require_once __DIR__ . '/../services/RegistrationService.php';

$registrationService = new RegistrationService();

Flight::route('GET /registrations', function () use ($registrationService) {
    Flight::json($registrationService->getAllRegistrations(), 200);
});

Flight::route('GET /registrations/@id', function ($id) use ($registrationService) {
    $registration = $registrationService->getRegistrationById((int)$id);

    if (!$registration) {
        Flight::json(['error' => 'Registration not found'], 404);
        return;
    }

    Flight::json($registration, 200);
});

Flight::route('POST /registrations', function () use ($registrationService) {
    try {
        $data = Flight::request()->data->getData();
        $id = $registrationService->createRegistration($data);

        Flight::json(['message' => 'Registration created', 'id' => $id], 201);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});

Flight::route('PUT /registrations/@id', function ($id) use ($registrationService) {
    try {
        $data = Flight::request()->data->getData();
        $updated = $registrationService->updateRegistration((int)$id, $data);

        if (!$updated) {
            Flight::json(['error' => 'Registration not found'], 404);
            return;
        }

        Flight::json(['message' => 'Registration updated'], 200);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});

Flight::route('DELETE /registrations/@id', function ($id) use ($registrationService) {
    $deleted = $registrationService->deleteRegistration((int)$id);

    if (!$deleted) {
        Flight::json(['error' => 'Registration not found'], 404);
        return;
    }

    Flight::json(['message' => 'Registration deleted'], 200);
});