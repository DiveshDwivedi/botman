<?php

namespace App\Providers;

use App\Models\User;
use App\Bots\ChatBotHandler;
use Illuminate\Support\ServiceProvider;
use RTippin\Messenger\Facades\Messenger;
use RTippin\Messenger\Facades\MessengerBots;

class MessengerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Enable bots feature
        Messenger::setBots(true);

        // Register our ChatBotHandler
        MessengerBots::registerHandlers([
            ChatBotHandler::class,
        ]);
    }

    public function register()
    {
        //
    }
}
