<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    // Beszélgetések, nem rakom át service-be mert nem kell más
    private function conversations($me)
    {
        return Message::with(['sender', 'receiver'])
            ->where('sender_id', $me)
            ->orWhere('receiver_id', $me)
            ->latest()
            ->get()
            ->unique(fn ($m) => $m->sender_id == $me ? $m->receiver_id : $m->sender_id);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('message.index', [
            'conversations' => $this->conversations(auth()->id()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
         $users = User::where('id', '!=', auth()->id())
        ->orderBy('first_name')
        ->get();
        return view('message.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'receiver_id' => ['required', 'exists:users,id', 'not_in:' . auth()->id()],
            'content'     => ['required', 'string', 'max:255'],
        ]);

        Message::create([
            'sender_id'   => auth()->id(),
            'receiver_id' => $data['receiver_id'],
            'content'     => $data['content'],
        ]);

        return redirect('/uzenet/' . $data['receiver_id']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $me = auth()->id();

        if ($id == $me) {
            return redirect('/uzenetek');
        }

        $otherUser = User::findOrFail($id);

        $chatMessages = Message::where(fn ($q) => $q->where('sender_id', $me)->where('receiver_id', $id))
            ->orWhere(fn ($q) => $q->where('sender_id', $id)->where('receiver_id', $me))
            ->latest()
            ->get();

        return view('message.index', [
            'conversations' => $this->conversations($me),
            'otherUser'     => $otherUser,
            'chatMessages'  => $chatMessages,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
