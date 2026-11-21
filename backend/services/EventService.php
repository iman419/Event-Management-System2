<?php

declare(strict_types=1);

require_once __DIR__ . '/../dao/EventDao.php';

class EventService
{
    private EventDao $eventDao;

    public function __construct(?EventDao $eventDao = null)
    {
        $this->eventDao = $eventDao ?? new EventDao();
    }

    public function getAllEvents(): array
    {
        return $this->eventDao->findAll();
    }

    public function getEventById(int $id): ?array
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid event ID.');
        }

        return $this->eventDao->findById($id);
    }

    public function createEvent(array $data): int
    {
        $requiredFields = ['category_id', 'venue_id', 'title', 'description', 'event_date'];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || trim((string)$data[$field]) === '') {
                throw new InvalidArgumentException("$field is required.");
            }
        }

        if ((int)$data['category_id'] <= 0 || (int)$data['venue_id'] <= 0) {
            throw new InvalidArgumentException('Invalid category or venue ID.');
        }

        $eventData = [
            'category_id' => (int)$data['category_id'],
            'venue_id' => (int)$data['venue_id'],
            'title' => trim($data['title']),
            'description' => trim($data['description']),
            'event_date' => $data['event_date']
        ];

        if (isset($data['created_by'])) {
            $eventData['created_by'] = (int)$data['created_by'];
        }

        if (strtotime($eventData['event_date']) === false) {
            throw new InvalidArgumentException('Invalid event date.');
        }

        return $this->eventDao->create($eventData);
    }

    public function updateEvent(int $id, array $data): bool
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid event ID.');
        }

        foreach (['title', 'description'] as $field) {
            if (isset($data[$field])) {
                $data[$field] = trim($data[$field]);

                if ($data[$field] === '') {
                    throw new InvalidArgumentException("$field cannot be empty.");
                }
            }
        }

        foreach (['category_id', 'venue_id', 'created_by'] as $field) {
            if (isset($data[$field])) {
                $data[$field] = (int)$data[$field];

                if ($data[$field] <= 0) {
                    throw new InvalidArgumentException("Invalid $field.");
                }
            }
        }

        if (isset($data['event_date']) && strtotime($data['event_date']) === false) {
            throw new InvalidArgumentException('Invalid event date.');
        }

        return $this->eventDao->update($id, $data);
    }

    public function deleteEvent(int $id): bool
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid event ID.');
        }

        return $this->eventDao->delete($id);
    }
}