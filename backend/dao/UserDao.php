<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDao.php';

/**
 * Data access object for the users table.
 * Only listed columns may be inserted or updated through this class.
 */
final class UserDao extends BaseDao
{
    public function __construct(?PDO $connection = null)
    {
        $this->table = 'users';
        $this->primaryKey = 'user_id';
        $this->allowedColumns = ['full_name', 'email', 'password_hash', 'role'];
        parent::__construct($connection);
    }
}
