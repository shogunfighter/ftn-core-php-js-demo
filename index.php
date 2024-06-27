<!DOCTYPE html>
<html>

<head>
    <title>FTN | Register</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/jquery.min.js"></script>
</head>

<body>
    <?php include './view/header.php'; ?>
    <div class="container">
        <h1>Register</h1>
        <form id="registerForm">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="birthdate">Birthdate:</label>
            <input type="date" id="birthdate" name="birthdate" required>

            <label for="phone_number">Phone Number:</label>
            <input type="tel" id="phone_number" name="phone_number" required>

            <label for="url">URL:</label>
            <input type="text" id="url" name="url" required>

            <input type="submit" value="Register">
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#registerForm').submit(function (e) {
                e.preventDefault(); // Prevent the form from submitting normally

                var formData = $(this).serialize();
                console.log("formData:", formData);

                $.ajax({
                    type: 'POST',
                    url: './view/register.php',
                    data: formData
                })
                .done(function (response) {
                    // Handle the response from the server
                    // console.log(response);
                    alert(response);
                })
                .fail(function () {
                    console.log('Error submitting form');
                });
            });
        });
    </script>

</body>

</html>