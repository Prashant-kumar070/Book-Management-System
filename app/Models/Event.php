<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // Fillable properties to allow mass assignment
    protected $fillable = [
        'name', 
        'description', 
        'organizer', 
        'start_date', 
        'end_date'
    ];

    /**
     * Get the tickets for the event.
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
