<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    use HasFactory;

    protected $fillable = ['ticket_id', 'admin_id', 'user_id', 'message', 'date', 'file'];

    public function ticket() {
        return $this->belongsTo(Ticket::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
