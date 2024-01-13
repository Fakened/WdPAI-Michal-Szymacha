<!DOCTYPE html>
<html>
    <head>
        <title>Tasker</title>
        <meta charset="UTF-8">
        <meta name="description" content="In progress">
        <meta name="keywords" content="In progress">
        <meta name="author" content="Michal Szymacha">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="data/css/user.css">
        <script src="data/js/user.js"></script>
    </head>
    <body>
    <div style ="display:none">
            <span id = "isAdmin" style = "display: none;"><?php echo $_SESSION['is_admin'] ?></span>
            <span id = "userId" style = "display: none;"><?php echo $_SESSION['id'] ?></span>
        </div>
        <?php
            if(!isset($_SESSION['id'])) {
                header("Location: login");
            }
        ?>
        <div class="mainHeader">
            <div class="mainHeader__logo">
                <span class="mainHeader__logo--text" onclick="goToMain()">Tasker</span>
                <img src="data/img/logo.svg" alt="Logo" class="mainHeader__logo--logo" onclick="goToMain()">
            </div> 
            <div class="mainHeader__user">
                <button class="mainHeader__user--button" onclick="logout()">Logout</button>
            </div>
        </div>
        <div class="mainContainer">
            <div class="mainContainer__User">
                <h1 class = "mainContainer__UserHeader">User Information</h1>
                <button class="mainContainer__User--button" onclick="Edit()">Edit</button><br>
                <span class="mainContainer__User--text">Email: </span><input type="text" id="email" readonly><br>
                <span class="mainContainer__User--text">Name: </span></span><input type="text" id="name" readonly><br>
                <span class="mainContainer__User--text">Surname: </span></span><input type="text" id="surname" readonly><br>
                <span class="mainContainer__User--text">Phone: </span></span><input type="text" id="phone" readonly><br>
                <script>
                    getUserInfo();
                </script>
                <div class="mainContainer__User--saveButton" id="saveButtons">
                    <button class="mainContainer__User--button" id="saveButton">Save</button>
                    <button class="mainContainer__User--button" id="cancelButton">Cancel</button>
                </div>
            </div>
            <div class="mainContainer__ChangePass">
                <h1 class = "mainContainer__UserHeader">Change Password</h1>
                <span class="mainContainer__ChangePass--text">Old Password: </span><input type="password" id="oldPass"><br>
                <span class="mainContainer__ChangePass--text">New Password: </span><input type="password" id="newPass"><br>
                <span class="mainContainer__ChangePass--text">Repeat New Password: </span><input type="password" id="repeatNewPass"><br>
                <button class="mainContainer__ChangePass--button" onclick="changePassword()">Change Password</button>
            </div>
            <div class="mainContainer__Team">
                <h1 class = "mainContainer__UserHeader">You team</h1>
                <div class = "mainContainer__TeamTable" id="teamTableDiv">
                </div>
                <script>
                    generateTeamView();
                </script>
            </div>
            <div class = "AddMemberView" id="AddMemberView" style = "display:none">
                <div class = "AddMemberView__Background">
                    <div class = "AddMemberView__header">
                        <span class = "AddMemberView__header--text">Add member to your team</span>
                        <img src="data/img/close.png" alt="Close" class="AddMemberView__header--close" onclick="closeAddMemberDiv()">
                    </div>
                    <div class = "AddMemberView__members" id = "AddMemberView__members">
                    </div>
                </div>
            </div>
            <div class = "AddMemberView" id="RemoveMemberView" style = "display:none">
                <div class = "AddMemberView__Background">
                    <div class = "AddMemberView__header">
                        <span class = "AddMemberView__header--text">Remove member to your team</span>
                        <img src="data/img/close.png" alt="Close" class="AddMemberView__header--close" onclick="closeRemoveMemberDiv()">
                    </div>
                    <div class = "AddMemberView__members" id = "RemoveMemberView__members">
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>