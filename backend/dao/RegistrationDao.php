<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDao.php';

/**
 * Data access object for the registrations table.
 * Only listed columns may be inserted or updated through this class.
 */
final class RegistrationDao extends BaseDao
{
    public function __construct(?PDO $connection = null)
    {
        $this->table = 'registrations';
        $this->primaryKey = 'registration_id';
        $this->allowedColumns = ['user_id', 'event_id', 'status'];
        parent::__construct($connection);
    }
}
