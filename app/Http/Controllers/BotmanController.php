<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

class BotmanController extends Controller
{
    /**
     * for testing purpose
     *
     * @return void
     */
    // public function handle()
    // {
    //     DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

    //     $config = [];

    //     $botman = BotManFactory::create($config);

    //     $botman->hears('hi', function ($bot) {
    //         $bot->reply('Hello! How can I help you?');
    //     });

    //     $botman->hears('help', function ($bot) {
    //         $bot->reply('You can say hi, hello, or ask for help!');
    //     });

    //     $botman->fallback(function ($bot) {
    //         $bot->reply("Sorry, I didn't understand that.");
    //     });


    //     $botman->listen();
    // }

    /**
     * Conversational bot handler.
     *
     * @return void
     */
    public function handle() {
        $botman = resolve('botman');

        $botman->hears('Hello|Hi', function($bot) {
            $bot->startConversation(new OnboardingConversation);
        });

        $botman->fallback(function($bot) {
            $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
        });
        $botman->listen();
    }
}
