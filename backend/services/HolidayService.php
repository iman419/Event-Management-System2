<?php

class HolidayService
{
    public function getHolidays($year, $countryCode = 'BA')
    {
        if (!is_numeric($year) || $year < 2000 || $year > 2100) {
            throw new InvalidArgumentException("Invalid year.");
        }

        $url = "https://date.nager.at/api/v3/PublicHolidays/$year/$countryCode";

        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'timeout' => 10,
                'ignore_errors' => false,
                'header' => "Accept: application/json\r\n"
            ]
        ]);

        $response = @file_get_contents($url, false, $context);

        if ($response === false) {
            throw new RuntimeException("External API is unavailable or timed out.");
        }

        $holidays = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($holidays)) {
            throw new RuntimeException("Invalid response from External API.");
        }

        return $holidays;
    }
}