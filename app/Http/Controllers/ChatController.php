<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesan;
use App\Models\User;
use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        // Get all users except the current authenticated user
        $users = User::where('id', '!=', Auth::id())->orderBy('name')->get();
        return view('chat.index', compact('users'));
    }

    public function fetchGlobalMessages()
    {
        // Fetch all messages where penerima_id is null (global)
        $messages = Pesan::whereNull('penerima_id')->oldest()->get();

        // Update last_global_chat_read_at for the current user
        $user = Auth::user();
        $user->last_global_chat_read_at = now();
        $user->save();

        return response()->json($messages);
    }

    public function fetchPrivateMessages($userId)
    {
        $myId = Auth::id();

        // Fetch private messages between me and the selected user
        $messages = Pesan::where(function ($q) use ($myId, $userId) {
            $q->where('pengirim_id', $myId)
                ->where('penerima_id', $userId);
        })->orWhere(function ($q) use ($myId, $userId) {
            $q->where('pengirim_id', $userId)
                ->where('penerima_id', $myId);
        })->oldest()->get();

        // Mark unread messages as read
        Pesan::where('pengirim_id', $userId)
            ->where('penerima_id', $myId)
            ->where('sudah_dibaca', false)
            ->update(['sudah_dibaca' => true]);

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'isi_pesan' => 'required|string',
            'penerima_id' => 'nullable|exists:users,id' // null = global
        ]);

        $pesan = Pesan::create([
            'pengirim_id' => Auth::id(),
            'penerima_id' => $request->penerima_id,
            'isi_pesan' => $request->isi_pesan,
            'sudah_dibaca' => false
        ]);

        return response()->json($pesan->load('pengirim'));
    }

    public function unreadCount()
    {
        $userId = Auth::id();
        $user = Auth::user();

        // Private unread per user
        $privateCounts = Pesan::select('pengirim_id')
            ->selectRaw('count(*) as count')
            ->where('penerima_id', $userId)
            ->where('sudah_dibaca', false)
            ->groupBy('pengirim_id')
            ->get()
            ->pluck('count', 'pengirim_id');

        // Global unread
        // Check if there are any global messages added after the user's last read time
        $globalCount = 0;
        if ($user->last_global_chat_read_at) {
            $globalCount = Pesan::whereNull('penerima_id')
                ->where('created_at', '>', $user->last_global_chat_read_at)
                ->where('pengirim_id', '!=', $userId)
                ->count();
        }
        else {
            // If never read, all global messages not sent by them are unread
            $globalCount = Pesan::whereNull('penerima_id')
                ->where('pengirim_id', '!=', $userId)
                ->count();
        }

        $total = $privateCounts->sum() + $globalCount;

        return response()->json([
            'total' => $total,
            'private' => $privateCounts,
            'global' => $globalCount
        ]);
    }

    // Polling Methods
    public function fetchPolls()
    {
        $polls = Poll::with(['creator', 'options.votes', 'votes'])->latest()->get();
        return response()->json($polls);
    }

    public function storePoll(Request $request)
    {
        if (Auth::user()->role !== 'kakak_asuh') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'question' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
        ]);

        $poll = Poll::create([
            'user_id' => Auth::id(),
            'question' => $request->question,
        ]);

        foreach ($request->options as $optionText) {
            $poll->options()->create([
                'option_text' => $optionText,
            ]);
        }

        return response()->json(['message' => 'Poll created successfully', 'poll' => $poll->load('options')]);
    }

    public function votePoll(Request $request, $pollId)
    {
        $request->validate([
            'option_id' => 'required|exists:poll_options,id',
        ]);

        $userId = Auth::id();

        // Check if already voted
        $existingVote = PollVote::where('poll_id', $pollId)->where('user_id', $userId)->first();
        if ($existingVote) {
            return response()->json(['message' => 'You have already voted on this poll.'], 400);
        }

        PollVote::create([
            'poll_id' => $pollId,
            'poll_option_id' => $request->option_id,
            'user_id' => $userId,
        ]);

        return response()->json(['message' => 'Vote cast successfully']);
    }
}
