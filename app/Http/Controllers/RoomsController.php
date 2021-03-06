<?php

namespace App\Http\Controllers;

use App\Exceptions\UserDataEditingException;
use App\Http\Requests\UserEditRequest;
use App\Room;
use App\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class RoomsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $roomsData = Room::get();

        return view('rooms', [
            'rooms' => $roomsData,
        ]);
    }

    /**
     * @param UserEditRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws UserDataEditingException
     */
    public function edit(UserEditRequest $request)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $userData = User::find(Auth::id());

        $userData->name = $request->input('name');
        $userData->email = $request->input('email');

        /** @noinspection PhpUndefinedMethodInspection */
        if (!$userData->save()) {
            throw new UserDataEditingException();
        }

        return view('profile', [
            'user' => $userData,
        ]);
    }
}
