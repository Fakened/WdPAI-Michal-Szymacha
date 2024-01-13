function goToMain() {
    window.location.href = "mainview";
}

function logout() {
    window.location.href = "logout";
}


function getUserInfo() {
    var endpoint = "getUserInfo";
    fetch(endpoint, {
        method: 'GET',
        Credentials: 'include'
    }).then((response) => response.json()).then((data) => {
        console.log(data.user.email);
        document.getElementById("email").value = data.user.email;
        document.getElementById("name").value = data.user.name;
        document.getElementById("surname").value = data.user.surname;
        document.getElementById("phone").value = data.user.phone;
    }).catch((error) => {
        console.log(error);
        allert('Something went wrong! Please try again!');
    });

}

function Edit() {
    var name = document.getElementById("name");
    var surname = document.getElementById("surname");
    var phone = document.getElementById("phone");

    name.removeAttribute("readonly");
    surname.removeAttribute("readonly");
    phone.removeAttribute("readonly");

    var divbutton = document.getElementById("saveButtons");
    divbutton.style.visibility = "visible";
    saveButton = document.getElementById("saveButton");

    saveButton.onclick = function () {
        name.setAttribute("readonly", "readonly");
        surname.setAttribute("readonly", "readonly");
        phone.setAttribute("readonly", "readonly");
        divbutton.style.visibility = "hidden";

        var endpoint = "editUserInfo";
        var formData = new FormData();
        formData.append('name', name.value);
        formData.append('surname', surname.value);
        formData.append('phone', phone.value);

        fetch(endpoint, {
            method: 'POST',
            body: formData,
            Credentials: 'include'
        }).then((response) => response.text()).then((data) => {
            console.log(data);
        }).catch((error) => {
            console.log(error);
            alert('Something went wrong! Please try again! Error: ' + error);
        });
    }

    cancelButton = document.getElementById("cancelButton");
    cancelButton.onclick = function () {
        name.setAttribute("readonly", "readonly");
        surname.setAttribute("readonly", "readonly");
        phone.setAttribute("readonly", "readonly");
        divbutton.style.visibility = "hidden";
    }

}

function changePassword() {
    var oldPassword = document.getElementById("oldPass");
    var newPassword = document.getElementById("newPass");
    var confirmPassword = document.getElementById("repeatNewPass");

    if (oldPassword.value == "" || newPassword.value == "" || confirmPassword.value == "") {
        alert("Please fill all fields!");
        return;
    }

    if (newPassword.value != confirmPassword.value) {
        alert("Passwords don't match!");
        return;
    }
    console.log(oldPassword.value);
    var endpoint = "changePassword";
    var formData = new FormData();
    formData.append('oldPassword', oldPassword.value);
    formData.append('newPassword', newPassword.value);
    fetch(endpoint, {
        method: 'POST',
        body: formData,
        Credentials: 'include'
    }).then((response) => response.json()).then((data) => {
        console.log(data);
        if (data.message == 'success') {
            alert('Password changed!');
            oldPassword.value = "";
            newPassword.value = "";
            confirmPassword.value = "";
        } else if (data.message == 'short') {
            alert('Password is too short!');
        } else if (data.message == 'capital') {
            alert('Password must contain at least one capital letter!');
        } else if (data.message == 'number') {
            alert('Password must contain at least one number!');
        } else if (data.message == 'special') {
            alert('Password must contain at least one special character!');
        } else if (data.message == 'old') {
            alert('Old password is incorrect!');
        } else {
            alert('Something went wrong! Please try again!');
        }
    }).catch((error) => {
        console.log(error);
        alert('Something went wrong! Please try again! Error: ' + error);
    });
}

function generateTeamView() {
    var div = document.getElementById("teamTableDiv");
    let html = '';
    var isAdmin = document.getElementById("isAdmin").innerHTML;

    if (isAdmin == 'true') {
        html += `
        <button class="button" onclick="addTeamMemberDiv()">Add team member</button>
        <button class="button" onclick="removeTeamMemberDiv()">Remove team member</button>
        `
    }

    endpoint = "getYourTeam";
    fetch(endpoint, {
        method: 'GET',
        Credentials: 'include'
    }).then((response) => response.json()).then((data) => {
        if (data.message == "success") {
            if (data.team.length == 0) {
                html += '<h2>You are not in any team!</h2>'
            } else {
                html += `<div class="teamTableDiv__table">
                <table class = "teamTable">
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                `
                for (var i = 0; i < data.team.length; i++) {
                    if (data.team[i].name == null) {
                        data.team[i].name = 'Empty';

                    }
                    if (data.team[i].surname == null) {
                        data.team[i].surname = 'Empty';

                    }
                    if (data.team[i].phone == null) {
                        data.team[i].phone = 'Empty';

                    }
                    html += `
                    <tr>
                        <td >${data.team[i].name}</td>
                        <td>${data.team[i].surname}</td>
                        <td>${data.team[i].email}</td>
                        <td>${data.team[i].phone}</td>
                    </tr>
                    `
                }
                html += '</table></div>'
                div.innerHTML = html;
        }
        } else {
            alert('Something went wrong with you team! Please try again!');
        }
    }).catch((error) => {
        console.log(error);
    });
}

function addTeamMemberDiv() {
    var table = document.getElementById("AddMemberView__members");
    var html = ``;
    html += `<div class="teamTableDiv__table">
    <table class="AddMemberView__members--table">
        <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Add</th>
        </tr>
    `
    var endpoint = "getUsersWithoutTeam";
    fetch(endpoint, {
        method: 'GET',
        Credentials: 'include'
    }).then((response) => response.json()).then((data) => {
        if (data.message == "success") {
            for (var i = 0; i < data.users.length; i++) {
                if (data.users[i].name == null) {
                    data.users[i].name = 'Empty';

                }
                if (data.users[i].surname == null) {
                    data.users[i].surname = 'Empty';

                }
                if (data.users[i].phone == null) {
                    data.users[i].phone = 'Empty';

                }
                html += `
                <tr>
                    <td class = "teamtabletd">${data.users[i].name}</td>
                    <td class = "teamtabletd">${data.users[i].surname}</td>
                    <td class = "teamtabletd">${data.users[i].email}</td>
                    <td class = "teamtabletd"><button class="button" onclick="addMember(${data.users[i].id})">Add</button></td>
                </tr>
                `
            }
            html += '</table></div>'
            table.innerHTML = html;
        } else {
            alert('Something went wrong with you team! Please try again!');
        }
    }).catch((error) => {
        console.log(error);
    });


    var div = document.getElementById("AddMemberView");
    div.style.display = "flex";
}

function closeAddMemberDiv() {
    var div = document.getElementById("AddMemberView");
    div.style.display = "none";
}

function addMember(id) {
    var endpoint = "addMember";
    var formData = new FormData();
    formData.append('id', id);
    fetch(endpoint, {
        method: 'POST',
        body: formData,
        Credentials: 'include'
    }).then((response) => response.json()).then((data) => {
        console.log(data);
        if (data.message == "success") {
            alert('Member added!');
            generateTeamView();
            closeAddMemberDiv();
        } else {
            alert('Something went wrong! Please try again!');
        }
    }).catch((error) => {
        console.log(error);
    });
}

function removeTeamMemberDiv() {
    var userId = document.getElementById("userId").innerHTML;
    var div = document.getElementById("RemoveMemberView__members");
    var html = ``;
    endpoint = "getYourTeam";
    fetch(endpoint, {
        method: 'GET',
        Credentials: 'include'
    }).then((response) => response.json()).then((data) => {
        if (data.message == "success") {
            console.log(data.team);
            if (data.team.length == 0) {
                html += '<h2>You are not in any team!</h2>'
            } else {
                html += `<div class="teamTableDiv__table">
                <table class="AddMemberView__members--table">
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Remove</th>
                    </tr>
                `
                for (var i = 0; i < data.team.length; i++) {
                    if (data.team[i].id == userId) {
                        continue;
                    }
                    if (data.team[i].name == null) {
                        data.team[i].name = 'Empty';

                    }
                    if (data.team[i].surname == null) {
                        data.team[i].surname = 'Empty';

                    }
                    if (data.team[i].phone == null) {
                        data.team[i].phone = 'Empty';

                    }
                    html += `
                    <tr>
                        <td class = "teamtabletd">${data.team[i].name}</td>
                        <td class = "teamtabletd">${data.team[i].surname}</td>
                        <td class = "teamtabletd">${data.team[i].email}</td>
                        <td class = "teamtabletd"><button class="button" onclick="removeMember(${data.team[i].id})">Remove</button></td>
                    </tr>
                    `
                }
                html += '</table></div>'
                div.innerHTML = html;
        }
        } else {
            alert('Something went wrong with you team! Please try again!');
        }
    }).catch((error) => {
        console.log(error);
    });
    var divView = document.getElementById("RemoveMemberView");
    divView.style.display = "flex";
}

function closeRemoveMemberDiv() {


    var div = document.getElementById("RemoveMemberView");
    div.style.display = "none";
}


function removeMember(id) {
    var endpoint = "removeMember";
    var formData = new FormData();
    formData.append('id', id);
    fetch(endpoint, {
        method: 'POST',
        body: formData,
        Credentials: 'include'
    }).then((response) => response.json()).then((data) => {
        console.log(data);
        if (data.message == "success") {
            alert('Member removed!');
            generateTeamView();
            closeRemoveMemberDiv();
        } else {
            alert('Something went wrong! Please try again!');
        }
    }).catch((error) => {
        console.log(error);
    });
}