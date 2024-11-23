<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Event Management System</h1>

        @if($events->isNotEmpty())
            @foreach($events as $event)
                @include('event_form', ['event' => $event])
            @endforeach
        @else
            @include('event_form', ['event' => null]) <!-- Render empty form -->
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        let ticketCounter = {{ $events->pluck('tickets.*.id')->flatten()->max() ?? 0 }} + 1;

        document.querySelectorAll('input, textarea').forEach(input => {
    input.addEventListener('input', () => {
        input.setAttribute('data-changed', 'true');
    });
});

function addNewTicket() {
    const table = document.getElementById('ticket_table');
    const row = document.createElement('tr');
    row.id = `ticket_${ticketCounter}`;

    row.innerHTML = `
        <td><input type="text" name="tickets[${ticketCounter}][ids]" value="${ticketCounter}" required data-changed="true"></td>
        <td><input type="text" name="tickets[${ticketCounter}][ticket_no]" required data-changed="true"></td>
        <td><input type="text" name="tickets[${ticketCounter}][price]" required data-changed="true"></td>
        <td>
            <button type="button" onclick="saveTicket(${ticketCounter})">Save</button>
        </td>
    `;

    table.appendChild(row);
    ticketCounter++;
}
        function saveTicket(ticketId) {
            const row = document.getElementById(`ticket_${ticketId}`);
            const inputs = row.querySelectorAll('input');
            inputs.forEach(input => input.setAttribute('disabled', true));

            const actionCell = row.cells[3];
            actionCell.innerHTML = `
                <button type="button" onclick="editTicket(${ticketId})">Edit</button>
                <button type="button" onclick="deleteTicket(${ticketId})">Delete</button>
            `;
        }

        function editTicket(ticketId) {
            const row = document.getElementById(`ticket_${ticketId}`);
            const inputs = row.querySelectorAll('input');
            inputs.forEach(input => input.removeAttribute('disabled'));

            const actionCell = row.cells[3];
            actionCell.innerHTML = `<button type="button" onclick="saveTicket(${ticketId})">Save</button>`;
        }

        function deleteTicket(ticketId) {
            const row = document.getElementById(`ticket_${ticketId}`);
            row.remove();
        }
    </script>

<script>
    $(document).ready(function() {
        $('#ticketForm').submit(function(e) {
            e.preventDefault();  // Prevent form submission

            $('input').each(function() {
                $(this).removeAttr('disabled');
            });

            var formData = $(this).serialize();  // Get form data
            $.ajax({
                url: "{{ route('save.ticket') }}",  // Laravel route for saving ticket
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        alert(response.message);  // Success message
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    alert("Error: " + JSON.stringify(errors));
                }
            });
        });
    });
</script>
</body>
</html>
