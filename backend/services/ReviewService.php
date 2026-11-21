<?php

declare(strict_types=1);

require_once __DIR__ . '/../dao/ReviewDao.php';

class ReviewService
{
    private ReviewDao $reviewDao;

    public function __construct(?ReviewDao $reviewDao = null)
    {
        $this->reviewDao = $reviewDao ?? new ReviewDao();
    }

    public function getAllReviews(): array
    {
        return $this->reviewDao->findAll();
    }

    public function getReviewById(int $id): ?array
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid review ID.');
        }

        return $this->reviewDao->findById($id);
    }

    public function createReview(array $data): int
    {
        if (empty($data['user_id']) || empty($data['event_id']) || !isset($data['rating'])) {
            throw new InvalidArgumentException('User ID, event ID and rating are required.');
        }

        if ((int)$data['user_id'] <= 0 || (int)$data['event_id'] <= 0) {
            throw new InvalidArgumentException('Invalid user or event ID.');
        }

        $rating = (int)$data['rating'];

        if ($rating < 1 || $rating > 5) {
            throw new InvalidArgumentException('Rating must be between 1 and 5.');
        }

        $reviewData = [
            'user_id' => (int)$data['user_id'],
            'event_id' => (int)$data['event_id'],
            'rating' => $rating,
            'comment' => $data['comment'] ?? null
        ];

        return $this->reviewDao->create($reviewData);
    }

    public function updateReview(int $id, array $data): bool
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid review ID.');
        }

        if (isset($data['user_id']) && (int)$data['user_id'] <= 0) {
            throw new InvalidArgumentException('Invalid user ID.');
        }

        if (isset($data['event_id']) && (int)$data['event_id'] <= 0) {
            throw new InvalidArgumentException('Invalid event ID.');
        }

        if (isset($data['rating'])) {
            $data['rating'] = (int)$data['rating'];

            if ($data['rating'] < 1 || $data['rating'] > 5) {
                throw new InvalidArgumentException('Rating must be between 1 and 5.');
            }
        }

        return $this->reviewDao->update($id, $data);
    }

    public function deleteReview(int $id): bool
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid review ID.');
        }

        return $this->reviewDao->delete($id);
    }
}