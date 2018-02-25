<?php

namespace App\Http\Controllers;

use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use App\Support\ResponseHelper;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance
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
    public function index()
    {
       $chatService = app()->make(MessageService::class);
       $messages = $chatService->getAllMessages();

       return view('home');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser() {
        $user = Auth::user();
        return ResponseHelper::jsonSuccess($user);
    }
}
