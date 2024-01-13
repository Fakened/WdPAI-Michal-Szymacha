<!DOCTYPE html>
<html>
    <head>
        <title>Tasker</title>
        <meta charset="UTF-8">
        <meta name="description" content="In progress">
        <meta name="keywords" content="In progress">
        <meta name="author" content="Michal Szymacha">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="data/css/mainview.css">
        <script src="data/js/mainview.js"></script>
    </head>
    <body>
        <?php
            if(!isset($_SESSION['id'])) {
                header("Location: login");
            }
        ?>
        <div class="mainHeader">
            <div class="mainHeader__logo">
                <span class="mainHeader__logo--text">Tasker</span>
                <img src="data/img/logo.svg" alt="Logo" class="mainHeader__logo--logo">
            </div> 
            <div class="mainHeader__user">
                <img src="data/img/user.png" alt="User" class="mainHeader__user--img" onclick="goToUser()">
            </div>
        </div>
        <div class="mainContainer">
            <div class="mainContainer__menu">
                <div class="mainContainer__menu--addTask" id ="addTaskButtons">
                <span id = "isAdmin" style = "display: none;"><?php echo $_SESSION['is_admin'] ?></span>
                    <script>generateToMainview()</script>     
                </div>
                
            </div>
            <div class="mainContainer__calendar" id = "calendar">
                <script>
                    generateCalendar();
                </script>
            </div>
        </div>
        <div class = "AddTask" id="AddTaskDiv" style = "display:none">
            <div class = "AddTask__Background">
                <div class = "AddTask__header">
                    <span class = "AddTask__header--text">Add Task</span>
                    <img src="data/img/close.png" alt="Close" class="AddTask__header--close" onclick="closeAddTask()">
                </div>
                <table class = "AddTask__form">
                    <tr class = "addTR">
                        <td class = "AddTask__form--element"><span class = "AddTask__form--text">Title</span></td>
                        <td class = "AddTask__form--element"><input type="text" class = "AddTask__form--input" id = "titleInput"></td>
                    </tr>
                    <tr class = "addTR">
                        <td class = "AddTask__form--element"><span class = "AddTask__form--text">Date</span></td>
                        <td class = "AddTask__form--element"><input type="date" class="AddTask__form--input" id="dateInput"></td>
                    </tr>
                    <tr class = "addTR">
                        <td class = "AddTask__form--element"><span class = "AddTask__form--text">Time</span></td>
                        <td class = "AddTask__form--element"><input type="time" class="AddTask__form--input" id="timeInput"></td>
                    </tr>
                    <tr class = "addTR">
                        <td class = "AddTask__form--element"><span class = "AddTask__form--text">Description</span></td>
                        <td class = "AddTask__form--element"><textarea class="AddTask__form--input--textarea" id="descriptionInput"></textarea></td>
                    </tr>
                    <tr class = "addTR">
                        <td class = "AddTask__form--element"><span class = "AddTask__form--text">Priority</span></td>
                        <td class = "AddTask__form--element">
                            <select class="AddTask__form--input" id="priorityInput">
                                <option value="1">Low</option>
                                <option value="2">Medium</option>
                                <option value="3">High</option>
                            </select>
                        </td>
                </table>
                <div class = "AddTask__buttons">
                    <button class = "AddTask__buttons--button" onclick="addTask()">Add</button>
                </div>
            </div>
        </div>
        <div class = "AddTask" id="AddTeamTaskDiv" style = "display:none">
            <div class = "AddTask__Background">
                <div class = "AddTask__header">
                    <span class = "AddTask__header--text">Add Team Task</span>
                    <img src="data/img/close.png" alt="Close" class="AddTask__header--close" onclick="closeTeamAddTask()">
                </div>
                <table class = "AddTask__form">
                    <tr class = "addTR">
                        <td class = "AddTask__form--element"><span class = "AddTask__form--text">Title</span></td>
                        <td class = "AddTask__form--element"><input type="text" class = "AddTask__form--input" id = "titleInputTeam"></td>
                    </tr>
                    <tr class = "addTR">
                        <td class = "AddTask__form--element"><span class = "AddTask__form--text">Date</span></td>
                        <td class = "AddTask__form--element"><input type="date" class="AddTask__form--input" id="dateInputTeam"></td>
                    </tr>
                    <tr class = "addTR">
                        <td class = "AddTask__form--element"><span class = "AddTask__form--text">Time</span></td>
                        <td class = "AddTask__form--element"><input type="time" class="AddTask__form--input" id="timeInputTeam"></td>
                    </tr>
                    <tr class = "addTR">
                        <td class = "AddTask__form--element"><span class = "AddTask__form--text">Description</span></td>
                        <td class = "AddTask__form--element"><textarea class="AddTask__form--input--textarea" id="descriptionInputTeam"></textarea></td>
                    </tr>
                    <tr class = "addTR">
                        <td class = "AddTask__form--element"><span class = "AddTask__form--text">Priority</span></td>
                        <td class = "AddTask__form--element">
                            <select class="AddTask__form--input" id="priorityInputTeam">
                                <option value="1">Low</option>
                                <option value="2">Medium</option>
                                <option value="3">High</option>
                            </select>
                        </td>
                </table>
                <div class = "AddTask__buttons">
                    <button class = "AddTask__buttons--button" onclick="addTeamTask()">Add</button>
                </div>
            </div>
        </div>
        <div class = "TaskView" id="TaskView" style = "display:none">
            <div class = "TaskView__Background">
                <div class = "AddTask__header">
                    <span class = "AddTask__header--text">Your Task</span>
                    <img src="data/img/close.png" alt="Close" class="AddTask__header--close" onclick="closeTaskView()">
                </div>
              <div class = "TaskView__Tasks" id = "TaskView__Tasks">
                
              </div>  
            </div>
        </div>
    </body>
</html>