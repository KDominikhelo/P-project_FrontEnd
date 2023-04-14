var projectName = document.getElementById("projectName");

var projectDatas = localStorage.getItem('project');
var projectData = JSON.parse(projectDatas).Project;

var userDatas = localStorage.getItem('userData');
var userData = JSON.parse(userDatas).user;

var taskField = document.getElementById('tasks');

window.addEventListener("load", (event) => {


projectName.innerText = projectData.name;


const url = 'http://p-project.hu/Backend/Controller/TaskController.php';
const requestData = {
    function: "getTaskByProjectId",
    id: projectData.id
};

fetch(url, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(requestData)
})
.then(response => {
    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
})
.then(data => {

    console.log(data.Result);
   
    var tasks = data.Result;
    
    tasks.forEach(task => {
     
  
        taskField.innerHTML += `
                                <div class="card mt-2" draggable="true">
                                    <div class="card-header">${task.title}</div>
                                    <div class="card-body" data-bs-toggle="modal" data-bs-target="#taskModal">
                                        <p>rövid leírás...</p>
                                    </div>
                                </div>
                                
                                `;
  

    });



})
.catch(error => {
    console.error('Error:', error);
});

});

    

var projectId = projectData.id;
var userId = userData.id;

const taskCreateFrom = document.getElementById("taskCreateFrom");

taskCreateFrom.addEventListener("submit", (e) => {

    e.preventDefault();

    var taskTitle = document.forms["taskCreateFrom"]["taskTitle"].value;




    const url = 'http://p-project.hu/Backend/Controller/TaskController.php';

    fetch(url, {
        method: "POST",
        credentials: "include",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
        },
        body: JSON.stringify({
            function: "createTask",
            projectId: projectId,
            title: taskTitle,
            userId: userId
        }) 
      })
      
    .then(response => {
        if (!response.ok) {
            throw new Error(`Hiba a kérés feldolgozásakor: ${response.status} ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {

      

        localStorage.setItem('taskId', data.message)
        
        window.location.href = './taskFill.html';
     
    })

    .catch(e => console.log("error::", e));
});




