<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Return Book Operation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link href="css/lend_styles.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>

    <div class="container-fluid">
        <div class="content">
            <div class="container mt-4">
                <h2 class="mb-3">Return a Book</h2>

                <label for="book_select">Book Name:</label>
                <select id="book_select" class="form-control">
                    <option value="">Select a book</option>
                </select>

                <div id="book_details" class="details-box">
                    <h4>Book Details</h4>
                    <p><strong>Name:</strong> <span id="book_name">N/A</span></p>
                    <p><strong>Author:</strong> <span id="book_author">N/A</span></p>
                    <p><strong>Publisher:</strong> <span id="book_publisher">N/A</span></p>
                    <p><strong>Published Date:</strong> <span id="book_published_date">N/A</span></p>
                </div>

                <label for="user_select">User Name:</label>
                <select id="user_select" class="form-control">
                    <option value="">Select a user</option>
                </select>

                <div id="user_details" class="details-box">
                    <h4>User Details</h4>
                    <p><strong>Full Name:</strong> <span id="user_fullname">N/A</span></p>
                    <p><strong>Address:</strong> <span id="user_address">N/A</span></p>
                    <p><strong>Gender:</strong> <span id="user_gender">N/A</span></p>
                </div>

                <div id="lent_details" class="details-box">
                    <h4>Lent Details</h4>
                    <p><strong>Lent Date:</strong> <span id="lent_date">N/A</span></p>
                    <p><strong>Expected Return Date:</strong> <span id="expected_return_date">N/A</span></p>
                    <p><strong>Overdue Status:</strong> <span id="overdue_status">N/A</span></p>
                    <p><strong>Overdue Days:</strong> <span id="overdue_days">N/A</span></p>
                    <p><strong>Fine:</strong> <span id="fine">N/A</span></p>
                </div>

                <button id="returnButton" class="btn btn-primary">Return</button>
                <button id="cancelButton" class="btn btn-danger">Cancel</button>
            </div>
        </div>
    </div>

    <script src="js/return.js"></script>
</body>

</html>
