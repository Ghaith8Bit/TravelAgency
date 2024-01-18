<?php

use App\Http\Controllers\BotManController;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Drivers\DriverManager;

// Load the driver(s) you are going to use
DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

// Create BotMan instance
$botman = app('botman');

$botman->hears('/help', function (BotMan $bot) {
    BotManController::handleHelp($bot);
});

$botman->hears('/search', function (BotMan $bot) {
    BotManController::handleSearch($bot);
});

$botman->hears('/upcoming', function (BotMan $bot) {
    BotManController::handleUpcoming($bot);
});

$botman->hears('/contact', function (BotMan $bot) {
    BotManController::handleContact($bot);
});

$botman->fallback(function (BotMan $bot) {
    $bot->reply("Sorry, I didn't understand that command. Type '<b>/help</b>' to see available commands.");
});

$botman->listen();
