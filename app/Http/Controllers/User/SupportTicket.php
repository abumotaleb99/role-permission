<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SupportTicket extends Controller
{
    public function index() {
        $tickets = Ticket::where('user_id', Auth::id())->latest()->get();

        return view('backend.user.tickets.index', compact('tickets'));
    }

    public function create() {
        return view('backend.user.tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:255',
        ]);

        if ($request->hasFile('file')) {
            $fileUrl = $this->handleUploadedFile($request->file('file'));
        }

        $ticket = new Ticket();
        $ticket->user_id = auth()->id();
        $ticket->date = Carbon::now();
        $ticket->subject = $request->subject;
        $ticket->priority = $request->priority;
        $ticket->message = $request->message;
        $ticket->file = $fileUrl;
        $ticket->save();

        return redirect()->route('user.tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show($id)
    {
        $ticket = Ticket::with('user')->findOrFail($id);
        $replies = TicketReply::with('user', 'admin')->where('ticket_id', $id)->get();
        
        return view('backend.user.tickets.show', compact('ticket', 'replies'));
    }

    public function reply(Request $request, $id) {
        $request->validate([
            'message' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048',
        ]);

        $reply = new TicketReply();
        $reply->ticket_id = $id;
        $reply->message = $request->message;
        $reply->date = Carbon::now();

        if (Auth::check()) {
            $reply->user_id = Auth::id();
        }

        if ($request->hasFile('file')) {
            $fileUrl = $this->handleUploadedFile($request->file('file'));
            $reply->file = $fileUrl;
        }

        $reply->save();

        return redirect()->back()->with('success', 'Reply sent successfully.');
    }

    // Handle Upload File Method
    private function handleUploadedFile($file) {
        if ($file && $file->isValid()) {
            $timestamp = now()->timestamp;
            $directory = 'assets/uploads/tickets/';
            $fileName = $timestamp . '_' . $file->getClientOriginalName();
            $file->move(public_path($directory), $fileName);
            return $directory . $fileName;
        }
        return null;
    }
}
