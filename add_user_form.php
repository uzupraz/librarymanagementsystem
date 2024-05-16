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
    <title>User Application</title>
    <style>
        .error {
            color: red;
            display: none;
        }

        .input-error {
            border-color: red;
        }
    </style>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-fluid">
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>

        <div class="content">
            <div class="container">
                <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
                    User Application
                </nav>

                <div class="container">
                    <div class="text-center mb-4">
                        <p class="text-muted">Complete the below form</p>
                    </div>

                    <div class="container d-flex justify-content-center">
                        <form action="add_user.php" method="post" style="width:50vw; min-width:300px;">
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Full Name:</label>
                                    <input type="text" class="form-control" name="FullName" placeholder="John Abraham" required>
                                    <div class="error"></div>
                                </div>
                                <div class="col">
                                    <label class="form-label">Date of Birth:</label>
                                    <input type="date" class="form-control" name="DateOfBirth" required>
                                    <div class="error"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address:</label>
                                <input type="text" class="form-control" name="Address" required>
                                <div class="error"></div>
                            </div>

                            <div class="form-group mb-3">
                                <label>Gender:</label>
                                &nbsp;
                                <input type="radio" class="form-check-input" name="Gender" id="male" value="Male" required>
                                <label for="male" class="form-input-label">Male</label>
                                &nbsp;
                                <input type="radio" class="form-check-input" name="Gender" id="female" value="Female" required>
                                <label for="female" class="form-input-label">Female</label>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="1" id="IsAdmin" name="IsAdmin">
                                <label class="form-check-label" for="IsAdmin">
                                    Is Admin
                                </label>
                            </div>

                            <div id="adminFields" style="display:none;">
                                <div class="mb-3">
                                    <label class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="Email">
                                    <div class="error"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password:</label>
                                    <input type="password" class="form-control" name="Password">
                                    <div class="error"></div>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-success" id="submit" name="submit" disabled>Add</button>
                                <a href="user_index.php" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const submitButton = document.getElementById("submit");
            const fullName = document.getElementsByName("FullName")[0];
            const address = document.getElementsByName("Address")[0];
            const dateOfBirth = document.getElementsByName("DateOfBirth")[0];
            const email = document.getElementsByName("Email")[0];
            const password = document.getElementsByName("Password")[0];
            const isAdminCheckbox = document.getElementById("IsAdmin");

            function validateEmail(email) {
                return email.includes('@') && email.includes('.');
            }

            function validateFullName(name) {
                return name.includes(' ') && name.length >= 4;
            }

            function calculateAge(dateOfBirth) {
                const birthDate = new Date(dateOfBirth);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;
            }

            function displayError(input, isValid, message) {
                const errorDiv = input.nextElementSibling;
                if (input.value.trim() !== "") { // Only display errors if the user has interacted with the field
                    if (!isValid) {
                        input.classList.add("input-error");
                        errorDiv.textContent = message;
                        errorDiv.style.display = 'block';
                    } else {
                        input.classList.remove("input-error");
                        errorDiv.style.display = 'none';
                    }
                }
            }

            function updateSubmitButtonState() {
                const isFullNameValid = validateFullName(fullName.value);
                const isAddressValid = address.value.length >= 4;
                const isAgeValid = calculateAge(dateOfBirth.value) > 8;
                let isEmailValid = true,
                    isPasswordValid = true;

                if (isAdminCheckbox.checked) {
                    isEmailValid = validateEmail(email.value);
                    isPasswordValid = password.value.length >= 8 && password.value.match(/(?=.*\d)(?=.*[a-zA-Z])/);
                }

                displayError(fullName, isFullNameValid, "Full name must include at least one space and be at least 4 characters.");
                displayError(address, isAddressValid, "Address must be at least 4 characters long.");
                displayError(dateOfBirth, isAgeValid, "User must be over 8 years old.");
                displayError(email, isEmailValid, "Email must include '@' and '.'.");
                displayError(password, isPasswordValid, "Password must be at least 8 characters with at least one number and one letter.");

                submitButton.disabled = !(isFullNameValid && isAddressValid && isAgeValid && (!isAdminCheckbox.checked || (isAdminCheckbox.checked && isEmailValid && isPasswordValid)));
            }

            fullName.addEventListener("input", updateSubmitButtonState);
            address.addEventListener("input", updateSubmitButtonState);
            dateOfBirth.addEventListener("change", updateSubmitButtonState);
            email.addEventListener("input", updateSubmitButtonState);
            password.addEventListener("input", updateSubmitButtonState);
            isAdminCheckbox.addEventListener("change", function() {
                document.getElementById("adminFields").style.display = this.checked ? "block" : "none";
                updateSubmitButtonState(); // Recheck form state when admin fields toggle
                email.value = ""; // Reset email and password fields when toggling admin status
                password.value = "";
            });

            updateSubmitButtonState(); // Initial check on page load
        });
    </script>
</body>

</html>
