<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDao.php';

/**
 * Data access object for the reviews table.
 * Only listed columns may be inserted or updated through this class.
 */
final class ReviewDao extends BaseDao
{
    public function __construct(?PDO $connection = null)
    {
        $this->table = 'reviews';
        $this->primaryKey = 'review_id';
        $this->allowedColumns = ['user_id', 'event_id', 'rating', 'comment'];
        parent::__construct($connection);
    }
}
