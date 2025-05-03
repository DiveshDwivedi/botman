<?php

namespace App\Http\Controllers;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

class OnboardingConversation extends Conversation
{
    protected $firstname;
    protected $email;
    protected $user;
    protected $thread;

    public function askFirstname()
    {
        $this->ask('Hello! What is your firstname?', function (Answer $answer) {
            $this->firstname = $answer->getText();
            $this->bot->typesAndWaits(2);
            $this->say('Nice to meet you ' . $this->firstname);
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        $this->ask('One more thing - what is your email?', function (Answer $answer) {
            $this->email = $answer->getText();

            $this->say('Great - that is all we need, '.$this->firstname);
        });
    }

    public function run()
    {
        $this->askFirstname();
    }
}