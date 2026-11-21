<?php

require_once __DIR__ . '/../services/ReviewService.php';

$reviewService = new ReviewService();

Flight::route('GET /reviews', function () use ($reviewService) {
    Flight::json($reviewService->getAllReviews(), 200);
});

Flight::route('GET /reviews/@id', function ($id) use ($reviewService) {
    $review = $reviewService->getReviewById((int)$id);

    if (!$review) {
        Flight::json(['error' => 'Review not found'], 404);
        return;
    }

    Flight::json($review, 200);
});

Flight::route('POST /reviews', function () use ($reviewService) {
    try {
        $data = Flight::request()->data->getData();
        $id = $reviewService->createReview($data);

        Flight::json(['message' => 'Review created', 'id' => $id], 201);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});

Flight::route('PUT /reviews/@id', function ($id) use ($reviewService) {
    try {
        $data = Flight::request()->data->getData();
        $updated = $reviewService->updateReview((int)$id, $data);

        if (!$updated) {
            Flight::json(['error' => 'Review not found'], 404);
            return;
        }

        Flight::json(['message' => 'Review updated'], 200);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});

Flight::route('DELETE /reviews/@id', function ($id) use ($reviewService) {
    $deleted = $reviewService->deleteReview((int)$id);

    if (!$deleted) {
        Flight::json(['error' => 'Review not found'], 404);
        return;
    }

    Flight::json(['message' => 'Review deleted'], 200);
});