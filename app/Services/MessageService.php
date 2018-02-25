<?php

namespace App\Services;
use App\Chat;

class MessageService
{
    public function getAllMessages() {
        $messages = Chat::orderBy('created_at')->get();

        return $messages;
    }

    public function edit() {

    }

    public function delete()
    {

    }
}