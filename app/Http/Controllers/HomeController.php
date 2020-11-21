<?php

namespace App\Http\Controllers;

use App\Models\Room;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \Auth::user();

        $room = Room::where('code', 'home')->first();

        $messages = $room
            ->messages()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get()
            ->reverse()
            ->values();

        return view('home')
            ->with('chat', ['messages' => $messages])
            ->with('room', $room)
            ->with('user', $user);
    }
}
