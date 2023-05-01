
const searchInput = document.getElementById("searchRewiever");
const searchField = document.getElementById("rewieverList");


searchInput.addEventListener('input', () => {

searchField.innerHTML = "";    

var searchValue = searchInput.value;
var func = "searchByEmail";
const url = 'http://p-project.hu/Backend/Controller/UserController.php';


var xhttp = new XMLHttpRequest();

xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 201) {

    var response = JSON.parse(this.responseText);

    console.log();

response.user.forEach(user => {
 
   
    searchField.innerHTML += `<a class="dropdown-item" onclick="userSave('${user.email}')">${user.first_name + " " + user.last_name + " | " + user.email}</a> <div class="dropdown-divider"></div>`;


});

}
};
xhttp.open("POST", url, true);
xhttp.setRequestHeader("Content-Type", "application/json");
xhttp.setRequestHeader("Accept", "application/json");
xhttp.withCredentials = true;
xhttp.send(JSON.stringify({
email: searchValue,
function: func 
}));

  });

var resultList = document.getElementById("resultList");

var userId_s = [];

function userSave(userEmail) {




var searchValue = userEmail;
var func = "searchByEmail";
const url = 'http://p-project.hu/Backend/Controller/UserController.php';


var xhttp = new XMLHttpRequest();

xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 201) {

    var response = JSON.parse(this.responseText);


 response.user.forEach(user => {
 
   
    resultList.innerHTML += `<li id="${user.id}" class="list-group-item rewiever">${user.first_name + " " + user.last_name + " | " + user.email}</li>`;

    userId_s.push(user.id);


});

}
};
xhttp.open("POST", url, true);
xhttp.setRequestHeader("Content-Type", "application/json");
xhttp.setRequestHeader("Accept", "application/json");
xhttp.withCredentials = true;
xhttp.send(JSON.stringify({
email: searchValue,
function: func 
}));


}     


const fillTaskForm = document.getElementById("fillTaskForm");


fillTaskForm.addEventListener("submit", (e) => {

e.preventDefault();

formSubmit();

});




function formSubmit() {

const url = 'http://p-project.hu/Backend/Controller/TaskController.php';

var func = "updateTask";
var taskId = localStorage.getItem('taskId');
var content = document.getElementById('taskDescription').value;

var title = document.getElementById('taskTitle').value;


var taskPriority = document.getElementById('taskPriority').value;



const dateTime = document.getElementById("taskDeadLine");


const splitted = dateTime.value.split("-");
const year = splitted[0];
const month = splitted[1];
const day_min_sec = splitted[2];
const day = day_min_sec.split("T");
const min_sec = day[1].split(":");
const min = min_sec[0];
const sec = min_sec[0];

var deadLine = `${year}-${month}-${day[0]} ${min}:${sec}:00`;





if (userId_s.length === 0) {
    var rewieverId = -1;
    var devId = -1;
  }
  
else if (userId_s.length === 1){
    var devId = userId_s[0];
    var rewieverId = -1;

}  
  
  else {

    var rewieverId = userId_s[1];
    var devId = userId_s[0];
  }



fetch(url,{
    method:"POST",
    headers:{
        "Content-Type": "application/json",
        "Accept": "application/json"
    },
    body: JSON.stringify({

function: func,
id: parseInt(taskId),
content: content,
priority: taskPriority,
deadline: deadLine,
devId: parseInt(devId),
reviewId: parseInt(rewieverId),
title: title,
milestone: 1

    })
}).then(data=>{
    return data.json();
}).then(data=>{
    alert(data.message)
    window.location.href = './getProjectById.html';
}).catch(err=>{
    console.log(err);
})

}


