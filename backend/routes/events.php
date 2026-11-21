<?php

require_once __DIR__ . '/../services/EventService.php';

$eventService = new EventService();

Flight::route('GET /events', function () use ($eventService) {
    Flight::json($eventService->getAllEvents(), 200);
});

Flight::route('GET /events/@id', function ($id) use ($eventService) {
    $event = $eventService->getEventById((int)$id);

    if (!$event) {
        Flight::json(['error' => 'Event not found'], 404);
        return;
    }

    Flight::json($event, 200);
});

Flight::route('POST /events', function () use ($eventService) {
    try {
        $data = Flight::request()->data->getData();
        $id = $eventService->createEvent($data);

        Flight::json(['message' => 'Event created', 'id' => $id], 201);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});

Flight::route('PUT /events/@id', function ($id) use ($eventService) {
    try {
        $data = Flight::request()->data->getData();
        $updated = $eventService->updateEvent((int)$id, $data);

        if (!$updated) {
            Flight::json(['error' => 'Event not found'], 404);
            return;
        }

        Flight::json(['message' => 'Event updated'], 200);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});

Flight::route('DELETE /events/@id', function ($id) use ($eventService) {
    $deleted = $eventService->deleteEvent((int)$id);

    if (!$deleted) {
        Flight::json(['error' => 'Event not found'], 404);
        return;
    }

    Flight::json(['message' => 'Event deleted'], 200);
});