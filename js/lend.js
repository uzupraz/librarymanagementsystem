$(document).ready(function () {
  var isUserSubscribed = false;
  var isBookAvailable = false;

  // Function to check how many books a user has lent
  function checkUserLentBooks(userId) {
    $.ajax({
      type: "POST",
      url: "check_user_lent_books.php",
      data: {
        userid: userId,
      },
      success: function (data) {
        var result = JSON.parse(data);
        $("#user_lent").text(result.message);
        isUserSubscribed = result.canLendMore;
        updateLendButtonState();
      },
      error: function () {
        alert("Error checking lent books.");
      },
    });
  }

  // Fetch and display book details
  function fetchBookDetails(bookId) {
    $.ajax({
      url: "fetch_book_details.php",
      data: {
        bookid: bookId,
      },
      success: function (data) {
        var book = JSON.parse(data);
        $("#book_name").text(book.bookname);
        $("#book_author").text(book.author);
        $("#book_publisher").text(book.publisher);
        $("#book_published_date").text(book.publishdate || "N/A");
        checkBookAvailability(bookId);
      },
    });
  }

  // Check book availability and update Lend button state
  function checkBookAvailability(bookId) {
    $.ajax({
      url: "check_book_availability.php",
      data: {
        bookid: bookId,
      },
      success: function (data) {
        var result = JSON.parse(data);
        isBookAvailable = result.isAvailable;
        updateLendButtonState();
        $("#book_availability").text(result.message);
      },
    });
  }

  // Fetch and display user details
  function fetchUserDetails(userId) {
    $.ajax({
      url: "fetch_user_details.php",
      data: {
        userid: userId,
      },
      success: function (data) {
        var user = JSON.parse(data);
        $("#user_fullname").text(user.FullName);
        $("#user_address").text(user.Address);
        $("#user_gender").text(user.Gender);
        checkUserSubscription(userId);
      },
    });
  }

  // Check user subscription status
  function checkUserSubscription(userId) {
    $.ajax({
      url: "check_subscription.php",
      data: {
        userid: userId,
      },
      success: function (data) {
        var result = JSON.parse(data);
        isUserSubscribed = result.isSubscribed;
        updateLendButtonState();
        $("#user_subscription").text(result.message);
      },
    });
  }

  // Update the state of the Lend button
  function updateLendButtonState() {
    $("#lendButton").prop("disabled", !(isUserSubscribed && isBookAvailable));
  }

  function resetDetails(selector) {
    $(selector).find("span").text("N/A");
  }

  // Handler when book is selected
  $("#book_search").change(function () {
    var selectedBook = $(this).val();
    var bookId = $("#book_list option")
      .filter(function () {
        return $(this).val() === selectedBook;
      })
      .data("id");
    if (bookId) {
      fetchBookDetails(bookId);
    }
  });

  // Handler when user is selected
  $("#user_search").change(function () {
    var selectedUser = $(this).val();
    var userId = $("#user_list option")
      .filter(function () {
        return $(this).val() === selectedUser;
      })
      .data("id");
    if (userId) {
      checkUserLentBooks(userId);
      fetchUserDetails(userId);
    }
  });

  // Lend button functionality
  $("#lendButton").click(function () {
    var bookId = $("#book_list option")
      .filter(function () {
        return $(this).val() === $("#book_search").val();
      })
      .data("id");

    var userId = $("#user_list option")
      .filter(function () {
        return $(this).val() === $("#user_search").val();
      })
      .data("id");

    if (bookId && userId) {
      $.ajax({
        type: "POST",
        url: "lend_book.php",
        data: {
          userid: userId,
          bookid: bookId,
        },
        success: function (response) {
          var result = JSON.parse(response);
          alert(result.message); // Show a success/failure message
          if (result.success) {
            window.location.href =
              "lentbook_index.php" + "?msg=Book lent successfully";
          }
        },
        error: function () {
          alert("Error processing the lend operation.");
        },
      });
    } else {
      alert("Please select both a book and a user.");
    }
  });

  $("#book_search").on("input", function () {
    var search = $(this).val();
    $.ajax({
      type: "POST",
      url: "search_books.php",
      data: {
        search: search,
      },
      success: function (data) {
        var books = JSON.parse(data);
        var dataList = $("#book_list").empty();
        books.forEach((book) => {
          $("<option>")
            .val(book.bookname)
            .data("id", book.bookid)
            .appendTo(dataList);
        });
      },
    });
    resetDetails("#book_details");
  });

  $("#user_search").on("input", function () {
    var search = $(this).val();
    $.ajax({
      type: "POST",
      url: "search_users.php",
      data: {
        search: search,
      },
      success: function (data) {
        var users = JSON.parse(data);
        var dataList = $("#user_list").empty();
        users.forEach((user) => {
          $("<option>")
            .val(user.FullName)
            .data("id", user.userid)
            .appendTo(dataList);
        });
      },
    });
    resetDetails("#user_details");
  });
});
