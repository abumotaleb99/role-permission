<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\TicketReply;
use Carbon\Carbon;

class SupportTicket extends Controller
{
    public function index() {
        $tickets = Ticket::with('user')->latest()->get();

        return view('backend.admin.tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::with('user')->findOrFail($id);
        $replies = TicketReply::with('user', 'admin')->where('ticket_id', $id)->get();
        
        return view('backend.admin.tickets.show', compact('ticket', 'replies'));
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

        if (Auth::guard('admin')->check()) {
            $reply->admin_id = Auth::guard('admin')->id();
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
