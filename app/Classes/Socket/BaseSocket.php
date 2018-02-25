<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 18.02.2018
 * Time: 11:43
 */

namespace App\Classes\Socket;

use Illuminate\Support\Facades\Auth;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

use App\Chat;
use App\Message;

class BaseSocket implements MessageComponentInterface
{
    protected $clients;
    protected $roomId;

    public function __construct($room_id) {
        $this->roomId = $room_id;
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        foreach ($this->clients as $client) {
            if ($conn !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send(json_encode(['isSystem' => true, 'command' => 'reload_users']));
            }
        }
//        $user = Auth::user();
//        $chatUser = Chat::query()->where([
//            'user_id' => $user->id,
//            'room_id' => $this->roomId
//        ])->first();
//        if (empty($chatUser)) {
//            Chat::query()->create([
//                'user_id' => $user->id,
//                'room_id' => $this->roomId
//            ]);
//        }
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
        $message = json_decode($msg);
        if(!$message->isSystem){
            $newMessage = Message::query()->create([
                'user_id'   =>  $message->userId,
                'room_id'   =>  $this->roomId,
                'message'   =>  $message->text
            ]);
            $newMessageWithUser =  Message::query()->where('id',$newMessage->id)->with('user')->first();
            foreach ($this->clients as $client) {
                    $client->send(json_encode($newMessageWithUser->toArray()));
            }
        } else {
            if($message->text == 'disconnect'){
                Chat::query()->where([
                    'user_id' => $message->userId,
                    'room_id' => $this->roomId
                ])->delete();
                foreach ($this->clients as $client) {
                    if ($from !== $client) {
                        // The sender is not the receiver, send to each client connected
                        $client->send(json_encode(['isSystem' => true, 'command' => 'reload_users']));
                    }
                }
                $this->clients->detach($from);
                echo "Connection {$from->resourceId} has disconnected\n";
            } else {
                $chatUser = Chat::query()->firstOrCreate([
                    'user_id' => $message->userId,
                    'room_id' => $this->roomId
                ]);
//                dd($chatUser);
////                if ($chatUser) {}
//                Chat::query()->create([
//                    'user_id' => $message->userId,
//                    'room_id' => $this->roomId
//                ]);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages

        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}