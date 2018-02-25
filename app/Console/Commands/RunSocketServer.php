<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Classes\Socket\ChatSocket;

use App\Room;
class RunSocketServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:socket_server';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('SocketServerRun');
        $room = Room::query()->where('name', '=', 'SERVER:8080')->first();
        if(empty($room)){
            $room =  Room::query()->create(['name' => 'SERVER:8080']);
        }

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new ChatSocket($room->id)
                )
            ),
            8080
        );

        $server->run();
    }
}
