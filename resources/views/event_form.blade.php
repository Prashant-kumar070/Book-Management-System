<form action="{{ route('save.ticket') }}" method="POST" id="ticketForm">
    @csrf

    <!-- Event Name -->
    <div class="form-group">
        <label for="event_name">Event Name</label>
        <input type="text" id="event_name" name="event_name" value="{{ $event->name ?? '' }}" required>
    </div>
    <input type="hidden" id="event_id" name="event_id" value="{{ $event->id ?? '' }}">

    <!-- Event Description -->
    <div class="form-group">
        <label for="event_description">Event Description</label>
        <textarea id="event_description" name="event_description" rows="4" required>{{ $event->description ?? '' }}</textarea>
    </div>

    <!-- Start and End Dates -->
    <div class="form-row">
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" id="start_date" name="start_date" value="{{ $event->start_date ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" id="end_date" name="end_date" value="{{ $event->end_date ?? '' }}" required>
        </div>
    </div>

    <!-- Organizer -->
    <div class="form-group">
        <label for="organizer">Organizer</label>
        <input type="text" id="organizer" name="organizer" value="{{ $event->organizer ?? '' }}" required>
    </div>

    <!-- Tickets Section -->
    <h2>Tickets</h2>
    <button type="button" onclick="addNewTicket()">Add New Ticket</button>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Ticket No</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="ticket_table">
            @if(isset($event) && $event->tickets->isNotEmpty())
                @foreach($event->tickets as $ticket)
                    <tr id="ticket_{{ $ticket->id }}">
                        <td>
                            <input type="text" name="tickets[{{ $ticket->id }}][ids]" value="{{ $ticket->id }}" disabled>
                        </td>
                        <td>
                            <input type="text" name="tickets[{{ $ticket->id }}][ticket_no]" value="{{ $ticket->ticket_no }}" disabled>
                        </td>
                        <td>
                            <input type="text" name="tickets[{{ $ticket->id }}][price]" value="{{ $ticket->price }}" disabled>
                        </td>
                        <td>
                            <button type="button" onclick="editTicket({{ $ticket->id }})">Edit</button>
                            <button type="button" onclick="deleteTicket({{ $ticket->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    {{-- <td colspan="4">No tickets available. Add a new ticket.</td> --}}
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Save Event -->
    <div class="form-group">
        <button type="submit">Save Event</button>
    </div>
</form>
