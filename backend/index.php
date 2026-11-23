
<?php


if (php_sapi_name() === 'cli-server') {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $file = __DIR__ . $uri;

    if ($uri !== '/' && is_file($file)) {
        return false;
    }
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config/Database.php';

require_once __DIR__ . '/routes/users.php';
require_once __DIR__ . '/routes/categories.php';
require_once __DIR__ . '/routes/venues.php';
require_once __DIR__ . '/routes/events.php';
require_once __DIR__ . '/routes/registrations.php';
require_once __DIR__ . '/routes/reviews.php';
require_once __DIR__ . '/routes/holidays.php';

Flight::set('flight.base_url', '');

Flight::start();
