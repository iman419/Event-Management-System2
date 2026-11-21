<?php

require_once __DIR__ . '/../services/VenueService.php';

$venueService = new VenueService();

Flight::route('GET /venues', function () use ($venueService) {
    Flight::json($venueService->getAllVenues(), 200);
});

Flight::route('GET /venues/@id', function ($id) use ($venueService) {
    $venue = $venueService->getVenueById((int)$id);

    if (!$venue) {
        Flight::json(['error' => 'Venue not found'], 404);
        return;
    }

    Flight::json($venue, 200);
});

Flight::route('POST /venues', function () use ($venueService) {
    try {
        $data = Flight::request()->data->getData();
        $id = $venueService->createVenue($data);

        Flight::json(['message' => 'Venue created', 'id' => $id], 201);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});

Flight::route('PUT /venues/@id', function ($id) use ($venueService) {
    try {
        $data = Flight::request()->data->getData();
        $updated = $venueService->updateVenue((int)$id, $data);

        if (!$updated) {
            Flight::json(['error' => 'Venue not found'], 404);
            return;
        }

        Flight::json(['message' => 'Venue updated'], 200);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});

Flight::route('DELETE /venues/@id', function ($id) use ($venueService) {
    $deleted = $venueService->deleteVenue((int)$id);

    if (!$deleted) {
        Flight::json(['error' => 'Venue not found'], 404);
        return;
    }

    Flight::json(['message' => 'Venue deleted'], 200);
});