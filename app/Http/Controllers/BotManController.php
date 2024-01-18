<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Trip;
use Auth;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\Validator;

class BotManController extends Controller
{
    public static function handleHelp($botman)
    {
        $question = Question::create("Sure! Here are some available commands:")
            ->fallback('Sorry, I couldn\'t process your request. Please try again.')
            ->callbackId('ask_about_option')
            ->addButtons([
                Button::create('Search For Trip')->value('HandleSearch'),
                Button::create('Upcoming Trips')->value('HandleUpcoming'),
                Button::create('Contact Us')->value('handleContact'),
            ]);

        $botman->ask($question, function (Answer $answer, $botman) {
            if ($answer->isInteractiveMessageReply()) {
                $handler = $answer->getValue();
                if ($handler !== null && method_exists(BotManController::class, $handler)) {
                    BotManController::$handler($botman);
                }
            }
        });
    }
    public static function handleSearch($botman)
    {
        $question = Question::create('Do you want to filter trips by price range or date range?')
            ->fallback('Sorry, I couldn\'t process your request. Please try again.')
            ->callbackId('search_options')
            ->addButtons([
                Button::create('Price Range')->value('price_range'),
                Button::create('Date Range')->value('date_range'),
                Button::create('No Filter')->value('no_filter'),
            ]);

        $botman->ask($question, function (Answer $answer, $botman) {
            $option = $answer->getValue();

            switch ($option) {
                case 'price_range':
                    // Ask for price range
                    $botman->ask('Please enter the minimum price for the trip:', function (Answer $answer, $botman) {
                        $minPrice = $answer->getText();
                        // Validate that $minPrice is a valid numeric value
                        if (!is_numeric($minPrice)) {
                            $botman->repeat('Please enter a valid numeric value for the minimum price.');
                            return;
                        }

                        $botman->ask('Please enter the maximum price for the trip:', function (Answer $answer, $botman) use ($minPrice) {
                            $maxPrice = $answer->getText();

                            // Validate that $maxPrice is a valid numeric value
                            if (!is_numeric($maxPrice)) {
                                $botman->repeat('Please enter a valid numeric value for the maximum price.');
                                return;
                            }

                            // Filter trips by price range
                            $trips = Trip::filterByPriceRange($minPrice, $maxPrice);

                            if ($trips->isEmpty()) {
                                $botman->say('No trips found within the specified price range.');
                            } else {
                                $message = "Here are the trips:<br>";
                                foreach ($trips as $trip) {
                                    $message .= "- Name: {$trip->name}<br>";
                                    $message .= "  Description: {$trip->description}<br>";
                                    $message .= "  Price: {$trip->price}<br>";
                                    $message .= "  Start Date: {$trip->start_date->toDateString()}<br>";
                                    $message .= "  End Date: {$trip->end_date->toDateString()}<br>";

                                    $botman->say($message);
                                }
                            }
                        });
                    });
                    break;


                case 'date_range':
                    $botman->ask('Please enter the start date for the trip (YYYY-MM-DD):', function (Answer $answer, $botman) {
                        $startDate = $answer->getText();

                        // Validate that $startDate is in the correct date format
                        if (!\DateTime::createFromFormat('Y-m-d', $startDate)) {
                            $botman->repeat('Please enter a valid date in the format YYYY-MM-DD for the start date.');
                            return;
                        }

                        $botman->ask('Please enter the end date for the trip (YYYY-MM-DD):', function (Answer $answer, $botman) use ($startDate) {
                            $endDate = $answer->getText();

                            // Validate that $endDate is in the correct date format
                            if (!\DateTime::createFromFormat('Y-m-d', $endDate)) {
                                $botman->repeat('Please enter a valid date in the format YYYY-MM-DD for the end date.');
                                return;
                            }

                            // Filter trips by date range
                            $trips = Trip::filterByDateRange($startDate, $endDate);

                            if ($trips->isEmpty()) {
                                $botman->say('No trips found within the specified date range.');
                            } else {
                                $message = "Here are the trips:<br>";
                                $count = count($trips);
                                foreach ($trips as $key => $trip) {
                                    $message .= "- Name: " . substr($trip->name, 0, 50) . "<br>";
                                    $message .= "- Description: " . substr($trip->description, 0, 50) . "<br>";
                                    $message .= "- Price: {$trip->price}<br>";
                                    $message .= "- Start Date: {$trip->start_date->toDateString()}<br>";
                                    $message .= "- End Date: {$trip->end_date->toDateString()}<br>";

                                    // Check if it's not the last iteration
                                    if ($key < $count - 1) {
                                        $message .= "<br><hr><br>";
                                    }
                                }

                                $botman->say($message);
                            }
                        });
                    });
                    break;


                case 'no_filter':
                    $question = Question::create('Do you want to search for trips by name?')
                        ->addButtons([
                            Button::create('Yes')->value('yes'),
                            Button::create('No')->value('no'),
                        ]);
                    $botman->ask($question, function (Answer $answer, $botman) {
                        if ($answer->isInteractiveMessageReply()) {
                            $searchByName = $answer->getValue();
                            if ($searchByName === 'yes') {
                                $botman->ask('Please enter the name of the trip:', function (Answer $answer, $botman) {
                                    $name = $answer->getText();

                                    // Filter trips by name
                                    $trips = Trip::filterByName($name);

                                    if ($trips->isEmpty()) {
                                        $botman->say('No trips found with the specified name.');
                                    } else {
                                        $message = "Here are the trips:<br>";
                                        $count = count($trips);
                                        foreach ($trips as $key => $trip) {
                                            $message .= "- Name: " . substr($trip->name, 0, 50) . "<br>";
                                            $message .= "- Description: " . substr($trip->description, 0, 50) . "<br>";
                                            $message .= "- Price: {$trip->price}<br>";
                                            $message .= "- Start Date: {$trip->start_date->toDateString()}<br>";
                                            $message .= "- End Date: {$trip->end_date->toDateString()}<br>";

                                            // Check if it's not the last iteration
                                            if ($key < $count - 1) {
                                                $message .= "<br><hr><br>";
                                            }
                                        }

                                        $botman->say($message);
                                    }
                                });
                            } elseif ($searchByName === 'no') {
                                // Retrieve all trips
                                $trips = Trip::all();

                                if ($trips->isEmpty()) {
                                    $botman->say('No trips found.');
                                } else {
                                    $message = "Here are the trips:<br>";
                                    $count = count($trips);
                                    foreach ($trips as $key => $trip) {
                                        $message .= "- Name: " . substr($trip->name, 0, 50) . "<br>";
                                        $message .= "- Description: " . substr($trip->description, 0, 50) . "<br>";
                                        $message .= "- Price: {$trip->price}<br>";
                                        $message .= "- Start Date: {$trip->start_date->toDateString()}<br>";
                                        $message .= "- End Date: {$trip->end_date->toDateString()}<br>";

                                        // Check if it's not the last iteration
                                        if ($key < $count - 1) {
                                            $message .= "<br><hr><br>";
                                        }
                                    }
                                    $botman->say($message);
                                }
                            }
                        }
                    });
                    break;

                default:
                    $botman->reply("Sorry, I didn't understand that option.");
                    break;
            }
        });
    }
    static public function handleUpcoming($botman)
    {
        $trips = Trip::getUpcomingTrips();

        if ($trips->isEmpty()) {
            $botman->say('No trips found.');
        } else {
            $message = "Here are the trips:<br>";
            foreach ($trips as $trip) {
                $message .= "- Name: " . substr($trip->name, 0, 50) . "<br>";
                $message .= "- Description: " . substr($trip->description, 0, 50) . "<br>";
                $message .= "- Price: {$trip->price}<br>";
                $message .= "- Start Date: {$trip->start_date->toDateString()}<br>";
                $message .= "- End Date: {$trip->end_date->toDateString()}<br>";

                $message .= "<br><hr><br>";
            }
            $botman->say($message);
        }
    }
    static public function handleContact($botman)
    {
        $botman->ask('What is your name?', function (Answer $answer, $botman) {
            $name = $answer->getText();

            if (empty($name)) {
                $botman->repeat('Please enter a valid name.');
                return;
            }

            $botman->ask('What is your email address?', function (Answer $answer, $botman) use ($name) {
                $email = $answer->getText();

                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $botman->repeat('Please enter a valid email.');
                    return;
                }

                $botman->ask('Please enter your message:', function (Answer $answer, $botman) use ($name, $email) {
                    $message = $answer->getText();

                    Contact::create([
                        'name' => $name,
                        'email' => $email,
                        'message' => $message,
                    ]);

                    $botman->say('Thank you! Your message has been received.');
                });
            });
        });
    }


}
