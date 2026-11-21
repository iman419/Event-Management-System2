
<?php

require_once __DIR__ . '/../services/HolidayService.php';

$holidayService = new HolidayService();

Flight::route('GET /holidays/@year', function ($year) use ($holidayService) {
    try {
        $holidays = $holidayService->getHolidays((int)$year);
        Flight::json($holidays, 200);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    } catch (RuntimeException $e) {
        Flight::json(['error' => $e->getMessage()], 502);
    }
});
