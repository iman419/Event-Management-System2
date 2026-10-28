<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDao.php';

/**
 * Data access object for the venues table.
 * Only listed columns may be inserted or updated through this class.
 */
final class VenueDao extends BaseDao
{
    public function __construct(?PDO $connection = null)
    {
        $this->table = 'venues';
        $this->primaryKey = 'venue_id';
        $this->allowedColumns = ['name', 'address', 'city'];
        parent::__construct($connection);
    }
}
