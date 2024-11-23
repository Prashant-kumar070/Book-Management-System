<?php
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', function () {

    $events = Event::with('tickets')->get();
    // dd($events);
    return view('index', compact('events'));
});

Route::post('/submit', [EventController::class, 'saveOrUpdateEvent'])->name('save.ticket');
