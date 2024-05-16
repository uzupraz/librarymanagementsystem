<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lend Book Operation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/lend_styles.css"> <!-- Assuming you have a separate CSS file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>

    <div class="container-fluid">
        <div class="content">
            <div class="container mt-4">
                <h2 class="mb-3">Lend a Book</h2>

                <div class="search-section mb-4">
                    <label for="book_search" class="form-label">Book Name:</label>
                    <input type="text" id="book_search" class="form-control" placeholder="Search for a book" list="book_list">
                    <datalist id="book_list"></datalist>
                </div>

                <div id="book_details" class="details-box">
                    <h4>Book Details</h4>
                    <p><strong>Name:</strong> <span id="book_name">N/A</span></p>
                    <p><strong>Author:</strong> <span id="book_author">N/A</span></p>
                    <p><strong>Publisher:</strong> <span id="book_publisher">N/A</span></p>
                    <p><strong>Published Date:</strong> <span id="book_published_date">N/A</span></p>
                    <p><strong>Availability:</strong> <span id="book_availability">N/A</span></p>
                </div>

                <div class="search-section mt-4 mb-4">
                    <label for="user_search" class="form-label">User Name:</label>
                    <input type="text" id="user_search" class="form-control" placeholder="Search for a user" list="user_list">
                    <datalist id="user_list"></datalist>
                </div>

                <div id="user_details" class="details-box">
                    <h4>User Details</h4>
                    <p><strong>Full Name:</strong> <span id="user_fullname">N/A</span></p>
                    <p><strong>Address:</strong> <span id="user_address">N/A</span></p>
                    <p><strong>Gender:</strong> <span id="user_gender">N/A</span></p>
                    <p><strong>Subscription Status:</strong> <span id="user_subscription">N/A</span></p>
                    <p><strong>Currently Lent:</strong> <span id="user_lent">N/A</span></p>
                </div>

                <button id="lendButton" class="btn btn-success">Lend</button>
                <a href="lentbook_index.php" class="btn btn-danger">Cancel</a>
            </div>
        </div>
    </div>


    <script src="js/lend.js"></script>
</body>

</html>