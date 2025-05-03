<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\LaravelCache;
use Illuminate\Http\Request;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class BotmanController extends Controller
{
    /**
     * Conversational bot handler.
     *
     * @return void
     */
    public function handle(Request $request) {
        // $botman = resolve('botman');

        $config = []; // no config needed for web driver
        $adapter = new FilesystemAdapter;
        $botman = BotManFactory::create($config, new LaravelCache($adapter), $request);

        $botman->hears('Hello|Hi', function($bot) {
            $bot->startConversation(new OnboardingConversation);
        });

        $botman->fallback(function($bot) {
            $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
        });
        $botman->listen();
    }
}
