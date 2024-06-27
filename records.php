<!DOCTYPE html>
<html>
<head>
    <title>FTN | Records</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/jquery.min.js"></script>
    <style>
        /* For popup background */
        #user-popup-background {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9998;
        }
    </style>
    <script>
        function showUserPopup(userId) {
            // alert(userId);
            $.ajax({
                url: './view/userDetails.php',
                data: { id: userId },
                success: function(response) {
                    var userData = JSON.parse(response);
                    $('#user-name').text(userData.username);
                    $('#user-email').text(userData.email);
                    $('#user-birthdate').text(userData.birthdate);
                    $('#user-phone-number').text(userData.phone_number);
                    $('#user-popup').show();
                    $('#user-popup-background').show();
                }
            });
        }

        function closeUserPopup() {
            $('#user-popup').hide();
            $('#user-popup-background').hide();
        }
    </script>
</head>
<body>
    <?php include './view/header.php'; ?>

    <h1>Records</h1>
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Birthdate</th>
            <th>Phone number</th>
            <th>Tools</th>
        </tr>
        <?php
            require_once __DIR__ . '/model/user.model.php';
            require_once __DIR__ . '/controller/user.controller.php';

            $userModel = new UserModel();
            $userController = new UserController($userModel);

            $users = $userController->getAllUsers();

            foreach ($users as $user) {
                echo '<tr onmouseover="this.style.backgroundColor=\'#ffffe0\'" onmouseout="this.style.backgroundColor=\'unset\'"">';
                echo '<td><a href="#" onclick="showUserPopup(' . $user['id'] . ')">' . $user['username'] . '</a></td>';
                echo '<td>' . $user['email'] . '</td>';
                echo '<td>' . $user['birthdate'] . '</td>';
                echo '<td>' . $user['phone_number'] . '</td>';
                echo '<td><button class="delete-user" data-id="' . $user['id'] . '">Delete</button></td>';
                echo '</tr>';
            }
        ?>
    </table>

    <div id="user-popup-background"></div>
    <div id="user-popup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border: 1px solid #ccc; z-index: 9999;">
        <h2 id="user-name"></h2>
        <p><strong>Email:</strong> <span id="user-email"></span></p>
        <p><strong>Birthdate:</strong> <span id="user-birthdate"></span></p>
        <p><strong>Phone Number:</strong> <span id="user-phone-number"></span></p>
        <button onclick="closeUserPopup()">Close</button>
    </div>

    <script>
        $(document).ready(function() {
            $('button.delete-user').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: './view/delete.php',
                        method: 'POST',
                        data: { id: id },
                        success: function(response) {
                            console.log(response);
                            location.reload();
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>

