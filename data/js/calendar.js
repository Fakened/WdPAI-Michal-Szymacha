var today = new Date();
var year = today.getFullYear();
var month = today.getMonth();

function generateCalendar(monthToAdd = 0) {
	today.setMonth(today.getMonth() + monthToAdd);
	month += monthToAdd;
	if (month < 0) {
		month = 11;
		year--;
	} else if (month > 11) {
		month = 0;
		year++;
	}
	const daysInMonth = new Date(year, month + 1, 0).getDate();
	const firstDay = new Date(year, month, 1).getDay();
	var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	const dayNames = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
	let html = `
	<div class = "mainContainer__calendar--menu">
		<button class="mainContainer__calendar--button" id="prevMonth" onclick="generateCalendar(-1)"><</button>
		<h1 class="mainContainer__calendar--date">${year} ${months[month]}</h1>
		<button class="mainContainer__calendar--button" id="nextMonth" onclick="generateCalendar(1)">></button>
	</div>
	<div class="mainContainer__calendar--calendar">`;
	html += '<table class="Callendar">';
	html += '<tr>';
	for (let day = 0; day < 7; day++) {
		html += `<th>${dayNames[day]}</th>`;
	}
	html += '</tr><tr>';
	let dayCounter = 1;
	for (let i = 0; i < 6; i++) {
		for (let j = 1; j < 8; j++) {
			if (i === 0 && j < firstDay) {
				html += '<td class ="day"></td>';
			} else if (dayCounter <= daysInMonth) {
				html += `<td class="day" value="${dayCounter}" onClick= "newPage(${dayCounter}, ${month + 1}, ${year})">${dayCounter}</td>`;
				dayCounter++;
			}
		}
		if (dayCounter > daysInMonth) {
			break;
		} else {
			html += '</tr><tr>';
		}
	}
	html += '</tr></table></div>';
	document.getElementById('calendar').innerHTML = html;
}


function newPage(day, month, year) {
	var endpoint = "getDayTasks";
	var formData = new FormData();
	formData.append('day', day);
	formData.append('month', month);
	formData.append('year', year);
	fetch(endpoint, {
		method: 'POST',
		body: formData,
		Credentials: 'include'
	}).then((response) => response.json()).then((data) => {
		console.log(data);
	}).catch((error) => {
		console.log(error);
	});
}

function addTaskDiv() {
	var div = document.getElementById('AddTaskDiv');
	div.style.display = 'flex';
}

function closeAddTask() {
	var div = document.getElementById('AddTaskDiv');
	div.style.display = 'none';
}

function generateToMainview() {
    var userAdmin = document.getElementById('isAdmin');
	var isAdmin = (userAdmin.innerHTML === 'true');
	let html = ''
    if (isAdmin) {
		html = `<button class = "mainContainer__addTask--button" id="addTask" type = "submit">Add team task</button>
				<button class="mainContainer__addTask--button" id="addTask" type = 'submit' onClick="addTaskDiv()">Add task</button>`;
	} else {
		html = '<button class="mainContainer__addTask--button" id="addTask" type = "submit">Add task</button>';
	}
	document.getElementById('addTaskButtons').innerHTML = html;
}


function addTask() {
	let today = new Date();
	title = document.getElementById('titleInput').value;
	date = document.getElementById('dateInput').value;
	time = document.getElementById('timeInput').value;
	description = document.getElementById('descriptionInput').value;
	priority = document.getElementById('priorityInput').value;
	if (title === '') {
		alert('Please enter a title!');
		document.getElementById('titleInput').focus();
		return;
	}
	if (date === '') {
		alert('Please enter a date!');
		document.getElementById('dateInput').focus();
		return;
	}
	if (time === '') {
		alert('Please enter a time!');
		document.getElementById('timeInput').focus();
		return;
	}
	dateToCheck = new Date(date + ' ' + time);
	if (dateToCheck < today) {
		alert('Please enter a valid date and time!');
		document.getElementById('dateInput').focus();
		return;
	}

	var endpoint = "addTask";
	var formData = new FormData();
	formData.append('title', title);
	formData.append('date', date);
	formData.append('time', time);
	formData.append('description', description);
	formData.append('priority', priority);
	fetch(endpoint, {
		method: 'POST',
		body: formData,
		Credentials: 'include'
	}).then((response) => response.text()).then((data) => {
		console.log(data);
	}).catch((error) => {
		console.log(error);
	});
}