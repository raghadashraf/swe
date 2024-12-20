<?php
require __DIR__ . '/vendor/autoload.php';

$classes=["Software"];
$instructors=["P.ashraf"];
$rooms=["1"];
$client = new \GuzzleHttp\Client();
$response = $client->post('http://localhost:8080/schedule', [
    'json' => [
        'classes' => $classes,
        'instructors' => $instructors,
        'rooms' => $rooms,
    ]
]);

$schedule = json_decode($response->getBody(), true);
echo $schedule;
?>