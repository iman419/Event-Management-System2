<?php

declare(strict_types=1);

require_once __DIR__ . '/../dao/VenueDao.php';

class VenueService
{
    private VenueDao $venueDao;

    public function __construct(?VenueDao $venueDao = null)
    {
        $this->venueDao = $venueDao ?? new VenueDao();
    }

    public function getAllVenues(): array
    {
        return $this->venueDao->findAll();
    }

    public function getVenueById(int $id): ?array
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid venue ID.');
        }

        return $this->venueDao->findById($id);
    }

    public function createVenue(array $data): int
    {
        if (empty($data['name']) || empty($data['address']) || empty($data['city'])) {
            throw new InvalidArgumentException('Name, address and city are required.');
        }

        $venueData = [
            'name' => trim($data['name']),
            'address' => trim($data['address']),
            'city' => trim($data['city'])
        ];

        foreach ($venueData as $value) {
            if ($value === '') {
                throw new InvalidArgumentException('Venue fields cannot be empty.');
            }
        }

        return $this->venueDao->create($venueData);
    }

    public function updateVenue(int $id, array $data): bool
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid venue ID.');
        }

        foreach (['name', 'address', 'city'] as $field) {
            if (isset($data[$field])) {
                $data[$field] = trim($data[$field]);

                if ($data[$field] === '') {
                    throw new InvalidArgumentException("$field cannot be empty.");
                }
            }
        }

        return $this->venueDao->update($id, $data);
    }

    public function deleteVenue(int $id): bool
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid venue ID.');
        }

        return $this->venueDao->delete($id);
    }
}