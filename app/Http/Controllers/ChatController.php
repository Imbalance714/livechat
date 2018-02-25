<?php

namespace App\Http\Controllers;

use App\Services\MessageService;
use Illuminate\Http\Request;
use App\Chat;
use App\Room;
use App\Message;
use App\User;
use App\Support\ResponseHelper;
class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getChatInfo(Request $request)
    {
        try{
            $data = [
                'chatUsers' => null,
                'chatMessages' => null
            ];

        }catch (\Exception $e) {
            return $e;
        }
    }
    public function getAllMessages (Request $request) {
        return ResponseHelper::jsonSuccess(Message::query()->with('user')->get());
    }

    public function getOnlineUsers () {
        return ResponseHelper::jsonSuccess(Chat::query()->with('user')->get());
    }

}
