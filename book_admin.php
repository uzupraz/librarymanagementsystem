<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="css/style.css">
   <title>PHP BOOKS Application</title>

   <script>
      // Function to validate form fields including date check and number of books
      function validateForm() {
         let bookName = document.forms["bookForm"]["book_name"].value;
         let author = document.forms["bookForm"]["book_author"].value;
         let publisher = document.forms["bookForm"]["publisher"].value;
         let publishDate = document.forms["bookForm"]["publish_date"].value;
         let numberOfBooks = document.forms["bookForm"]["number_of_books"].value;

         // Check if any field is empty or default values are not modified where required
         if (bookName === "" || author === "" || publisher === "" || publishDate === "" || numberOfBooks === "") {
            alert("All fields must be filled out.");
            return false;
         }

         // Validate number of books is a positive integer
         if (numberOfBooks <= 0) {
            alert("Number of books must be at least 1.");
            return false;
         }

         // Check if the publish date is not in the future
         let today = new Date();
         let inputDate = new Date(publishDate);
         today.setHours(0, 0, 0, 0); // Clear time portion

         if (inputDate > today) {
            alert("Publish date cannot be in the future.");
            return false;
         }

         return true;
      }

      document.addEventListener("DOMContentLoaded", function() {
         const categoryInput = document.getElementById("categories");
         const categoryList = document.getElementById("categoryList");

         // Fetch existing categories from the database
         fetch("get_categories.php")
            .then(response => response.json())
            .then(data => {
               data.forEach(category => {
                  const option = document.createElement("option");
                  option.value = category.categoryname;
                  categoryList.appendChild(option);
               });
            })
            .catch(error => console.error("Error fetching categories:", error));

         categoryInput.addEventListener("input", function() {
            const inputValue = categoryInput.value;
            const lastCommaIndex = inputValue.lastIndexOf(",");
            const currentInput = inputValue.substring(lastCommaIndex + 1).trim();

            categoryList.innerHTML = ""; // Clear current suggestions

            // Fetch existing categories from the database again
            fetch("get_categories.php")
               .then(response => response.json())
               .then(data => {
                  data.forEach(category => {
                     if (category.categoryname.toLowerCase().startsWith(currentInput.toLowerCase())) {
                        const option = document.createElement("option");
                        option.value = category.categoryname;
                        categoryList.appendChild(option);
                     }
                  });
               })
               .catch(error => console.error("Error fetching categories:", error));
         });
      });
   </script>
</head>

<body>

   <div class="container-fluid">
      <?php include 'header.php'; ?>
      <?php include 'sidebar.php'; ?>

      <div class="content">

         <div class="text-center mb-4" style="background-color: #00ff5573;">
            <h3>Add Book</h3>
         </div>

         <div class="container justify-content-center">
            <form action="add_book.php" method="post" style="width:50vw; min-width:300px;" name="bookForm" onsubmit="return validateForm()">
               <div class="row mb-3">
                  <div class="col">
                     <label class="form-label">Book Name:</label>
                     <input type="text" class="form-control" name="book_name" placeholder="Love Story" required>
                  </div>

                  <div class="col">
                     <label class="form-label">Book Author:</label>
                     <input type="text" class="form-control" name="book_author" placeholder="Ashley Poston" required>
                  </div>
               </div>

               <div class="mb-3">
                  <label class="form-label">Publisher:</label>
                  <input type="text" class="form-control" name="publisher" placeholder="Asmita Publication" required>
               </div>
               <div class="form-group mb-3">
                  <label class="form-label">Publish Date:</label>
                  <input type="date" class="form-control" name="publish_date" required>
               </div>
               <div class="form-group mb-3">
                  <label class="form-label">Number of Books:</label>
                  <input type="number" class="form-control" name="number_of_books" value="1" min="1" required>
               </div>

               <div class="form-group mb-3">
                  <label class="form-label">Categories:</label>
                  <input type="text" class="form-control" name="categories" id="categories" list="categoryList" placeholder="Enter categories separated by commas" required>
                  <datalist id="categoryList"></datalist>
               </div>

               <div>
                  <button type="submit" class="btn btn-success" name="submit">Save</button>
                  <a href="book_index.php" class="btn btn-danger">Cancel</a>
               </div>
            </form>
         </div>
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


</body>

</html>
