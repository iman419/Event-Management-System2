<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDao.php';

/**
 * Data access object for the events table.
 * Only listed columns may be inserted or updated through this class.
 */
final class EventDao extends BaseDao
{
    public function __construct(?PDO $connection = null)
    {
        $this->table = 'events';
        $this->primaryKey = 'event_id';
        $this->allowedColumns = ['category_id', 'venue_id', 'title', 'description', 'event_date', 'created_by'];
        parent::__construct($connection);
    }
}
