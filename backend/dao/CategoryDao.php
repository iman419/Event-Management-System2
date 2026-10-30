<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDao.php';

/**
 * Data access object for the categories table.
 * Only listed columns may be inserted or updated through this class.
 */
final class CategoryDao extends BaseDao
{
    public function __construct(?PDO $connection = null)
    {
        $this->table = 'categories';
        $this->primaryKey = 'category_id';
        $this->allowedColumns = ['name', 'description'];
        parent::__construct($connection);
    }
}
