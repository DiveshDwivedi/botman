<?php

namespace App\Bots;

use BotMan\BotMan\BotMan;
use RTippin\Messenger\Support\BotActionHandler;
use RTippin\Messenger\Models\Thread;
use RTippin\Messenger\Facades\MessengerComposer;

class ChatBotHandler extends BotActionHandler
{
    /**
     * The bots settings.
     */
    public static function getSettings(): array
    {
        return [
            'alias' => 'chat',
            'description' => 'A chatbot that helps users with their queries.',
            'name' => 'ChatBot',
            'unique' => true,
            'avatar' => public_path('vendor/messenger/images/bots.png'),
        ];
    }

    /**
     * @throws \Exception
     */
    public function handle(): void
    {
        $message = $this->payload('message');
        
        if (!$message) {
            return;
        }

        $botman = app('botman');
        
        // Configure BotMan to use our thread
        $botman->hears('.*', function(BotMan $bot, $message) {
            $response = $this->processMessage($message);
            
            MessengerComposer::to($this->thread)
                ->message($response)
                ->send();
        });

        $botman->listen();
    }

    /**
     * Process the incoming message and return a response
     */
    private function processMessage(string $message): string
    {
        // Add your custom logic here to process the message
        // You can integrate with external APIs, use NLP, etc.
        
        if (preg_match('/(hi|hello|hey)/i', $message)) {
            return "Hello! How can I help you today?";
        }
        
        if (preg_match('/help/i', $message)) {
            return "I can help you with various tasks. Just let me know what you need!";
        }
        
        return "I received your message: $message. How can I assist you further?";
    }
}