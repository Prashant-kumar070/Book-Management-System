<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function saveTicket(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'event_id' => 'required|exists:events,id',
            'ticket_no' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if the ticket exists
        $existingTicket = DB::table('tickets')->where('ticket_no', $request->ticket_no)->first();

        if ($existingTicket) {
            // If the ticket exists, update it
            $updated = DB::table('tickets')
                ->where('ticket_no', $request->ticket_no)
                ->update([
                    'event_id' => $request->event_id,
                    'price' => $request->price,
                    'updated_at' => now(),
                ]);

            if ($updated) {
                return response()->json([
                    'success' => true,
                    'message' => 'Ticket updated successfully!',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update ticket.'
                ], 500);
            }
        } else {
            // If the ticket doesn't exist, insert a new one
            $ticketId = DB::table('tickets')->insertGetId([
                'event_id' => $request->event_id,
                'ticket_no' => $request->ticket_no,
                'price' => $request->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Ticket saved successfully!',
                'ticket_id' => $ticketId,
            ]);
        }
    }

    public function saveOrUpdateEvent(Request $request)
    {

        // Validate the request data
        $request->validate([
            // 'event_id' => 'sometimes|exists:events,id', // Optional, must exist if provided
            'event_name' => 'required|string|max:255',
            'event_description' => 'required|string',
            'organizer' => 'required|string|max:255',
            'tickets' => 'array',
            'tickets.*.id' => 'sometimes|exists:tickets,id', // Optional, must exist if provided
            'tickets.*.ticket_no' => 'required|string',
            'tickets.*.price' => 'required|numeric'
        ]);

        // Start transaction to ensure data integrity
        DB::beginTransaction();
        try {
            // Check if updating or creating new
            $eventId = $request->input('event_id');
            if ($eventId) {
                // Update existing event
                DB::table('events')->where('id', $eventId)->update([
                    'name' => $request->event_name,
                    'description' => $request->event_description,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'organizer' => $request->organizer
                ]);
            } else {
                // Insert new event
                $eventId = DB::table('events')->insertGetId([
                    'name' => $request->event_name,
                    'description' => $request->event_description,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'organizer' => $request->organizer
                ]);
            }
            $ticketIds = [];
            foreach ($request->tickets as $ticketData) {
                if (isset($ticketData['id']) && DB::table('tickets')->where('id', $ticketData['id'])->exists()) {
                    // Update existing ticket
                    DB::table('tickets')
                        ->where('id', $ticketData['id'])
                        ->update([
                            'ticket_no' => $ticketData['ticket_no'],
                            'price' => $ticketData['price'],
                            'event_id' => $eventId,
                        ]);
                    $ticketIds[] = $ticketData['id'];
                } else {
                    // Insert new ticket
                    $ticketId = DB::table('tickets')->insertGetId([
                        'ticket_no' => $ticketData['ticket_no'],
                        'price' => $ticketData['price'],
                        'event_id' => $eventId,
                    ]);
                    $ticketIds[] = $ticketId;
                }
            
            
            }

            // Optional: Remove any tickets not included in the request
            if (!empty($ticketIds)) {
                DB::table('tickets')->where('event_id', $eventId)->whereNotIn('id', $ticketIds)->delete();
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Event and tickets saved or updated successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Failed to save or update event and tickets.',
                'error' => $e->getMessage()
            ]);
        }
    }
}
