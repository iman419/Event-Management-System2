<?php

declare(strict_types=1);

require_once __DIR__ . '/../dao/RegistrationDao.php';

class RegistrationService
{
    private RegistrationDao $registrationDao;

    public function __construct(?RegistrationDao $registrationDao = null)
    {
        $this->registrationDao = $registrationDao ?? new RegistrationDao();
    }

    public function getAllRegistrations(): array
    {
        return $this->registrationDao->findAll();
    }

    public function getRegistrationById(int $id): ?array
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid registration ID.');
        }

        return $this->registrationDao->findById($id);
    }

    public function createRegistration(array $data): int
    {
        if (empty($data['user_id']) || empty($data['event_id'])) {
            throw new InvalidArgumentException('User ID and event ID are required.');
        }

        if ((int)$data['user_id'] <= 0 || (int)$data['event_id'] <= 0) {
            throw new InvalidArgumentException('Invalid user or event ID.');
        }

        $status = $data['status'] ?? 'registered';

        if (!in_array($status, ['registered', 'cancelled', 'attended'], true)) {
            throw new InvalidArgumentException('Invalid registration status.');
        }

        $registrationData = [
            'user_id' => (int)$data['user_id'],
            'event_id' => (int)$data['event_id'],
            'status' => $status
        ];

        return $this->registrationDao->create($registrationData);
    }

    public function updateRegistration(int $id, array $data): bool
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid registration ID.');
        }

        if (isset($data['user_id']) && (int)$data['user_id'] <= 0) {
            throw new InvalidArgumentException('Invalid user ID.');
        }

        if (isset($data['event_id']) && (int)$data['event_id'] <= 0) {
            throw new InvalidArgumentException('Invalid event ID.');
        }

        if (isset($data['status']) && !in_array($data['status'], ['registered', 'cancelled', 'attended'], true)) {
            throw new InvalidArgumentException('Invalid registration status.');
        }

        return $this->registrationDao->update($id, $data);
    }

    public function deleteRegistration(int $id): bool
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid registration ID.');
        }

        return $this->registrationDao->delete($id);
    }
}