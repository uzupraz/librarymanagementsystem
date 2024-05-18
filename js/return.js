$(document).ready(function () {
    // Function to fetch and display book details based on book ID
    function fetchBookDetails(bookId) {
        $.ajax({
            url: "fetch_book_details.php",
            data: { bookid: bookId },
            success: function (data) {
                var book = JSON.parse(data);
                $("#book_name").text(book.bookname || "N/A");
                $("#book_author").text(book.author || "N/A");
                $("#book_publisher").text(book.publisher || "N/A");
                $("#book_published_date").text(book.publishdate || "N/A");
            },
        });
    }

    // Function to fetch and display user details based on user ID
    function fetchUserDetails(userId) {
        $.ajax({
            url: "fetch_user_details.php",
            data: { userid: userId },
            success: function (data) {
                var user = JSON.parse(data);
                $("#user_fullname").text(user.FullName || "N/A");
                $("#user_address").text(user.Address || "N/A");
                $("#user_gender").text(user.Gender || "N/A");
            },
        });
    }

    // Function to fetch lent and return dates for the specific book and user
    function fetchLentDetails(bookId, userId) {
        $.ajax({
            url: "fetch_lent_dates.php",
            data: { bookid: bookId, userid: userId },
            success: function (data) {
                var details = JSON.parse(data);
                var lentDate = details.lent_date || "N/A";
                var expectedReturnDate = details.expected_return_date || "N/A";
                var overdueStatus = "No";
                var overdueDays = 0;
                var fine = 0;

                if (expectedReturnDate !== "N/A") {
                    var today = new Date();
                    var returnDate = new Date(expectedReturnDate);
                    if (today > returnDate) {
                        overdueStatus = "Yes";
                        overdueDays = Math.ceil((today - returnDate) / (1000 * 60 * 60 * 24));
                        fine = 50 + 10 * (overdueDays - 1);
                    }
                }

                $("#lent_date").text(lentDate);
                $("#expected_return_date").text(expectedReturnDate);
                $("#overdue_status").text(overdueStatus);
                $("#overdue_days").text(overdueDays);
                $("#fine").text(fine);
            },
        });
    }

    // Populate the dropdowns for books and users based on entries in lentbooks
    function populateDropdowns(url, dropdownId) {
        $.ajax({
            url: url,
            method: "GET",
            success: function (data) {
                var items = JSON.parse(data);
                var dropdown = $(dropdownId).empty();
                dropdown.append('<option value="">Select an option</option>');
                items.forEach((item) => {
                    $("<option>")
                        .val(item.id)
                        .text(item.name)
                        .appendTo(dropdown);
                });
            },
        });
    }

    // Populate book dropdown
    populateDropdowns("search_lent_books.php", "#book_select");

    // Event handler for book selection
    $("#book_select").change(function () {
        var selectedBookId = $(this).val();
        if (selectedBookId) {
            fetchBookDetails(selectedBookId);
            // Populate user dropdown based on selected book
            $.ajax({
                url: "search_lent_users.php",
                method: "GET",
                data: { bookid: selectedBookId },
                success: function (data) {
                    var items = JSON.parse(data);
                    var dropdown = $("#user_select").empty();
                    dropdown.append('<option value="">Select a user</option>');
                    items.forEach((item) => {
                        $("<option>")
                            .val(item.id)
                            .text(item.name)
                            .appendTo(dropdown);
                    });
                },
            });
        } else {
            // Reset user dropdown and details if no book is selected
            $("#user_select").empty().append('<option value="">Select a user</option>');
            $("#book_details span").text("N/A");
            $("#user_details span").text("N/A");
            $("#lent_date").text("N/A");
            $("#expected_return_date").text("N/A");
            $("#overdue_status").text("N/A");
            $("#overdue_days").text("N/A");
            $("#fine").text("N/A");
        }
    });

    // Event handler for user selection
    $("#user_select").change(function () {
        var selectedUserId = $(this).val();
        var selectedBookId = $("#book_select").val();
        if (selectedUserId && selectedBookId) {
            fetchUserDetails(selectedUserId);
            fetchLentDetails(selectedBookId, selectedUserId);
        } else {
            // Reset user details and dates if no user is selected
            $("#user_details span").text("N/A");
            $("#lent_date").text("N/A");
            $("#expected_return_date").text("N/A");
            $("#overdue_status").text("N/A");
            $("#overdue_days").text("N/A");
            $("#fine").text("N/A");
        }
    });

    // Return button functionality
$("#returnButton").click(function () {
    var bookId = $("#book_select").val();
    var userId = $("#user_select").val();
    var overdueStatus = $("#overdue_status").text();
    var fine = parseFloat($("#fine").text());

    if (bookId && userId) {
        console.log("Book ID:", bookId);
        console.log("User ID:", userId);
        console.log("Overdue Status:", overdueStatus === "Yes");
        console.log("Fine:", fine);

        $.ajax({
            type: "POST",
            url: "return_book.php",
            data: {
                userid: userId,
                bookid: bookId,
                overdue: overdueStatus === "Yes",
                fine: fine
            },
            success: function (response) {
                var result = JSON.parse(response);
                alert(result.message); // Show a success/failure message
                if (result.success) {
                    window.location.href = "lentbook_index.php" + "?msg=Book returned successfully";
                }
            },
            error: function () {
                alert("Error processing the return operation.");
            },
        });
    } else {
        alert("Please select both a book and a user.");
    }
});


    // Cancel button functionality
    $("#cancelButton").click(function () {
        // Reset all fields and dropdowns
        $("#book_select").val("").trigger("change");
        $("#user_select").empty().append('<option value="">Select a user</option>');
        $("#book_details span").text("N/A");
        $("#user_details span").text("N/A");
        $("#lent_date").text("N/A");
        $("#expected_return_date").text("N/A");
        $("#overdue_status").text("N/A");
        $("#overdue_days").text("N/A");
        $("#fine").text("N/A");
    });

    // Initialize select2 for better dropdown experience
    $("#book_select, #user_select").select2();
});
