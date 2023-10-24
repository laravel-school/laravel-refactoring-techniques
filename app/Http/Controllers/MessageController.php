<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('conversations', 'conversations.userone', 'conversations.usertwo', 'user.messages')
            ->orderBy('updated_at', 'desc')
            ->groupBy('conversation_id')
            ->groupBy('user_id')
            ->paginate(50);

        $messagesToAdminAccounts = DB::table('users')
            ->join('messages', 'users.id', '=', 'messages.user_id')
            ->join('conversations', function ($joinagain) {
                $joinagain->on('users.id', '=', 'conversations.user_one')->orOn('users.id', '=', 'conversations.user_two');
            })
            ->where('users.createdby', '=', 'admin')
            ->select('users.*', 'messages.message', 'messages.is_seen', 'messages.isflagged', 'messages.deleted_from_sender', 'messages.deleted_from_receiver', 'messages.user_id', 'messages.conversation_id', 'conversations.user_one', 'conversations.user_two', 'conversations.status', 'conversations.ispotentialuser')
            ->groupBy('messages.conversation_id')
            ->get()
            ->count();

        $potentialMessages  = DB::table('messages')
            ->join('conversations', 'messages.conversation_id', '=', 'conversations.id')
            ->where('conversations.ispotentialuser', '=', 1)
            ->groupBy('messages.conversation_id')
            ->select('messages.*')
            ->get()
            ->count();

        $flagedMessages  = DB::table('messages')
            ->join('conversations', 'messages.conversation_id', '=', 'conversations.id')
            ->where('messages.isflagged', 1)
            ->select('messages.*')
            ->get()
            ->count();

        $totalmessages = Message::with('Conversations', 'User')->get()->count();

        return view('all-messages')
            ->with(['messages' => $messages, 'messagestoadminaccounts' => $messagesToAdminAccounts, 'potentialmessages' => $potentialMessages, 'flagedmessages' => $flagedMessages, 'totalmessages' => $totalmessages]);
    }

    public function refactor()
    {
        return view('refactor');
    }
}
