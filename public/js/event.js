

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