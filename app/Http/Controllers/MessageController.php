<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Artist;
use App\Http\Model\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(Request $request, Artist $artist)
    {
        $message = new Message;
        $message->text = $request->text;
        $message->to_artist_id = $artist->id;
        $message->user_id = Auth::user()->id;
        $message->save();
        return $message->text;
    }
}
