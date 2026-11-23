$(document).ready(function() {

    // --- 1. JS Validation & AJAX for Adding Tools ---
    $('#addToolForm').submit(function(e) {
        e.preventDefault(); // Stop the form from refreshing the page

        // Clear previous messages
        $('#msg').text('');
        $('#msg').css('color', 'black');

        // Get values
        let name = $('#t_name').val().trim();
        let category = $('#t_cat').val();
        let qty = $('#t_qty').val();
        let price = $('#t_price').val();
        let error = "";

        // --- Client-Side Validation ---
        if (name === "") {
            error = "⚠️ Tool Name is required.";
        } else if (qty === "" || parseInt(qty) < 0) {
            error = "⚠️ Quantity must be a positive number.";
        } else if (price === "" || parseFloat(price) < 0) {
            error = "⚠️ Rent Price cannot be negative.";
        }

        // If error exists, show it and stop
        if (error !== "") {
            $('#msg').text(error).css('color', 'red');
            return; 
        }

        // --- AJAX Request (If validation passes) ---
        $.ajax({
            url: '../controllers/AdminController.php?action=add_tool',
            type: 'POST',
            data: $(this).serialize(), // Send form data
            dataType: 'json', // Expect JSON response
            success: function(response) {
                if (response.status === "success") {
                    $('#msg').text("✅ " + response.message).css('color', 'green');
                    
                    // Optional: Clear form
                    $('#addToolForm')[0].reset();

                    // Optional: Refresh table without reloading page (Advanced) 
                    // For now, we reload to see changes
                    setTimeout(function() {
                        location.reload(); 
                    }, 1000);
                } else {
                    $('#msg').text("❌ " + response.message).css('color', 'red');
                }
            },
            error: function() {
                $('#msg').text("❌ Server Error. Try again.").css('color', 'red');
            }
        });
    });

    // --- 2. You can add more JS here (e.g., for Delete buttons) ---
});