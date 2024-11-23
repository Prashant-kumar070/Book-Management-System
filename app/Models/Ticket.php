<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    // Fillable properties to allow mass assignment
    protected $fillable = [
        'event_id',  // Foreign key to link back to the Event model
        'ticket_no', 
        'price'
    ];

    /**
     * Get the event that owns the ticket.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
