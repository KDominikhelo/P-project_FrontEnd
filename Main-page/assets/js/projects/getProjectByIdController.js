var projectName = document.getElementById("projectName");

var projectDatas = localStorage.getItem('project');
var projectData = JSON.parse(projectDatas).Project;

var userDatas = localStorage.getItem('userData');
var userData = JSON.parse(userDatas).user;






window.addEventListener("load", (event) => {



usersOnProject()


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


   
    var tasks = data.Result;

    
    tasks.forEach(task => {

        var task_content = 'Ennek a feladatnak még nincs leírása...';


        if (task.content == null) {
            task.content = task_content;
        }

      
       document.getElementById(task.column_id).innerHTML += `
       <div ondrag="moveTask(${task.id})" class="card mt-2" draggable="true">
           <div class="card-header">${task.title}</div>
           <div class="card-body" onclick="createModalForTask(${task.id})">
               <p>${task.content}</p>
           </div>
       </div>`;
  

    });



})
.catch(error => {
    console.error('Error:', error);
});

});


function moveTask(taskId) {
    
    localStorage.setItem('movingTask', taskId);
}


function createModalForTask(taskId) {

    var modal_task = document.getElementById('modal_task');



const url = 'http://p-project.hu/Backend/Controller/TaskController.php';

fetch(url, {
    method: "POST",
    credentials: "include",
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json",
    },
    body: JSON.stringify({
        function: "getTaskById",
        id: taskId,
    }) 
  })
  
.then(response => {
    if (!response.ok) {
        throw new Error(`Hiba a kérés feldolgozásakor: ${response.status} ${response.statusText}`);
    }
    return response.json();
})
.then(data => {





    single_task = data.Result;

    single_task.forEach(task => {

        var task_content = 'Ennek a feladatnak még nincs leírása...';

        if (task.content == null) {
            task.content = task_content;
        }

        if (task.priority == null) {
            task.priority = '';
        }
        if (task.developerName == null) {
            task.developerName = '';
        }
        if (task.developerRole == null) {
            task.developerRole = '';
        }
        if ( task.reviewerName == null) {
            task.reviewerName = '';
        }
        if (task.reviewerRole == null) {
            task.reviewerRole = '';
        }
        if (task.deadline == null) {
            task.deadline = '';
        }

        modal_task.innerHTML = `<div class="modal fade" id="modal${task.id}" tabindex="-1" aria-labelledby="modal${task.id}" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="${task.id}">P-project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
    
                    <div class="row">
                        <h2>${task.title}</h2>
                        <div class="col-md-12">
    
                          
                            <p>${task.content}</p>
                           
                            <div class="">
                                <label for="floatingTextarea">Task prioritása: ${task.priority}</label>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row mt-5">
                    
                    <div class="col-md-12">
                    
                    Ide jön majd a checkField rész

                    </div>
    
                    <div class="row mt-5">
                        <div class="col-md-8">
                            <div class="form-floating mb-3">
                                <ul class="list-group mb-4" id="commentField">
                                
                                ${commentShow(task.id)}
                                
                                </ul>

                                <div class="row">
                                    <div class="col-10">
                                        <input type="text" class="form-control dark-input" id="commentInput" placeholder="Comment">
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-primary" onClick="createCommentandGetAllComments(${task.id})">Elküld</button>
                                    </div>
                                </div>
                
                                <div id="mentionList">

                                </div>

                            </div>
             
                            <button class="btn btn-danger mt-5" onClick="deleteTask(${task.id})">Task törlése</button>    
                            <button class="btn btn-success mt-5" onClick="taskszerkesztes(${task.id})">Task Szerkesztése</button>

                        </div>
                        <div class="col md-4 text-center">
    
                            <div class="list-group dark-input">
                                <button type="button" class="list-group-item list-group-item-action"
                                    aria-current="true">Fejlesztő: ${task.developerName} <br> ${task.developerRole}</button>
                                <button type="button" class="list-group-item list-group-item-action">Ellenőrzi: ${task.reviewerName} <br> ${task.reviewerRole}</button>
                                <button type="button" class="list-group-item list-group-item-action">Határidő: ${task.deadline}</button>
                            </div>



                             
                        </div>

                        ${milestoneChecker(task.id)}

                        <div id="milestones"></div>

                    
                        <div id="addMilestone"></div> 

                    </div>
                </div>
            </div>
        </div>
    </div>`;

var myTaskModal = new bootstrap.Modal(`#modal${task.id}`);

myTaskModal.show();


addComment(); 

    })

 
})

.catch(e => console.log("error::", e));



    
}


function addComment() {
    
var commentInput = document.getElementById('commentInput');
var mentionList = document.getElementById('mentionList');

commentInput.addEventListener('input', () => {


    if (commentInput.value.includes('@')) {


        var keresendo = [];



        var commentValue = commentInput.value.split('@');

      
        commentValue.map((item, index)=>{
            if (index != 0) {
                if (item.includes(' ')) {
                    keresendo.push(item.split(' ')[0]);
                }
                else{
                    keresendo.push(item);
                }
            }

            

        })
       
        for (let i = 0; i < keresendo.length; i++) {
            var func = "searchByEmail";
            const url = 'http://p-project.hu/Backend/Controller/UserController.php';
            
        
            var xhttp = new XMLHttpRequest();
            
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 201) {
        
                var response = JSON.parse(this.responseText);
        
                mentionList.innerHTML = '';

            response.user.forEach(user => { 

                mentionList.innerHTML += `<a class="btn btn-primary mt-2">${user.first_name + ' ' + user.last_name + ' | ' + user.email}</a>`;
        

        
            });
        
            }
            };
            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("Content-Type", "application/json");
            xhttp.setRequestHeader("Accept", "application/json");
            xhttp.withCredentials = true;
            xhttp.send(JSON.stringify({
            email: keresendo[i],
            function: func 
            }));
            
        }


    }


})
}


function milestoneChecker(taskId) {

    const url = 'http://p-project.hu/Backend/Controller/TaskController.php';

    const requestData = {
        function: "getTaskMilestone",
        id: parseInt(taskId)
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
    
        var milestone = data.milestone;
        var milestones = document.getElementById("milestones");
    
        if (milestone.length == 0) {

            milestones.innerHTML += `<button class="btn btn-warning mt-5" onClick="addMilestone_field(${taskId})">Mérföldkő hozzáadása</button>`;

        }
        else{

            milestone.forEach(milestone_single => {
    
                milestones.innerHTML += `<ul class="list-group"><li class="list-group-item mt-2"> Mérföldkő: ${milestone_single.title}  Aktív   <button class="btn btn-danger" onClick="deleteMilestone(${taskId})"> Mérföldkő törlése</button>   </li></ul>`;
        
            });

        }
       
    
    
    })
    .catch(error => {
        console.error('Error:', error);
    });

    
}


function deleteMilestone(taskId) {
    

    const url = 'http://p-project.hu/Backend/Controller/TaskController.php';

    const requestData = {
        function: "deleteMilestone",
        task: parseInt(taskId),
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
    
    
       alert(data.message);
    
    
    
    })
    .catch(error => {
        console.error('Error:', error);
    });





}



function addMilestone(taskId) {



    const url = 'http://p-project.hu/Backend/Controller/TaskController.php';

    const requestData = {
        function: "addMilestone",
        task: parseInt(taskId),
        milestone: parseInt(selectMenu)
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
    
    
       alert(data.message);
    
    
    
    })
    .catch(error => {
        console.error('Error:', error);
    });


    
}



function addMilestone_field(taskId) {

    var addMilestone_field = document.getElementById("addMilestone");

    var select = `
        <div class="row">  <div class="col-10"> <select class="form-select mt-2" aria-label="Default select example" id="addMilestone_select"></select> </div> <div class="col-2"> <button class="btn btn-success mt-2" onClick="addMilestone(${taskId})">Hozzáad</button> </div> </div>`
        
    addMilestone_field.innerHTML += select;                
    

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
    
    
       
        var tasks = data.Result;

        document.getElementById("addMilestone_select").innerHTML = "";
        
        tasks.forEach(task => {
    
            var task_content = 'Ennek a feladatnak még nincs leírása...';

            
          
            document.getElementById("addMilestone_select").innerHTML += `<option value="${task.id}">${task.title} </option>`;
      
    
        });
    
    
    
    })
    .catch(error => {
        console.error('Error:', error);
    });

    
}



function addMilestone(taskId) {

    var selectMenu = document.getElementById("addMilestone_select").value;


    const url = 'http://p-project.hu/Backend/Controller/TaskController.php';

    const requestData = {
        function: "addMilestone",
        task: parseInt(taskId),
        milestone: parseInt(selectMenu)
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
    
    
       alert(data.message);
    
    
    
    })
    .catch(error => {
        console.error('Error:', error);
    });

    
}





function usersOnProject() {
    
    var usersOnProject_field = document.getElementById('usersOnTheProject');


    const url = "http://p-project.hu/Backend/Controller/ProjectController.php";

    const data = {
      function: "getUserByProjectId",
      id: projectData.id,
    };
    
    const options = {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    };
    
    
    fetch(url, options)
    
      .then(response => {
    
        if (!response.ok) {
            throw new Error(`Hiba a kérés feldolgozásakor: ${response.status} ${response.statusText}`);
        }
    
        return response.json();
      })
      .then(data => { 
    
    
        const users = data.Result;
    
        users.forEach(user => {
         
    
        
            usersOnProject_field.innerHTML += `
                              <span class="tt" data-bs-placement="bottom" title="${user.first_name + ' ' + user.last_name + ' ' + user.name}">
                              <img class="" src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="">
                              </span>
                       `;
      
    
    
        });
    
    
      })
    
      .catch(error => {
        console.error(error);
      });
    
}


    

  
function taskszerkesztes(taskId) {

    localStorage.setItem('taskId', taskId)
        
        window.location.href = './updateTask.html';
    
}

 






function commentShow(taskId) {
    


       fetch('http://p-project.hu/Backend/Controller/TaskController.php', {
            method: "POST",
            credentials: "include",
            headers: {
              "Content-Type": "application/json",
              "Accept": "application/json",
            },
            body: JSON.stringify({
                function: "getTaskComment",
                id: taskId
            }) 
          })
          
        .then(response => {
            if (!response.ok) {
                throw new Error(`Hiba a kérés feldolgozásakor: ${response.status} ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
    
            var commentField = document.getElementById('commentField');

            commentField.innerHTML = '';

            data.comment.map(comment_s => {
     
                commentField.innerHTML += `<li class="list-group-item rewiever" >${comment_s.first_name + " " + comment_s.last_name + " | " + comment_s.name+ ' : ' + comment_s.content + ' ' + comment_s.created_at}  <button class="btn btn-primary text-end">O</button> <button class="btn btn-danger text-end" onClick="deleteComment(${comment_s.id},${taskId})">X</button> </li>`;
          
    
            });
        
            
            
         
        })
    
        .catch(e => console.log("error::", e));




}





function deleteComment(commentId,taskId) {


    console.log(commentId);

    const body = {
        comment: commentId,
        function: 'deleteComment'
    };



    const url = 'http://p-project.hu/Backend/Controller/CommentController.php';


    fetch(url, {
        method: "POST",
        credentials: "include",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
        },
        body: JSON.stringify(body) 
      })
      
    .then(response => {
        if (!response.ok) {
            throw new Error(`Hiba a kérés feldolgozásakor: ${response.status} ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {

        alert(data.message);

        commentShow(taskId);
     
     
    })

    .catch(e => console.log("error::", e));


    
}





function createCommentandGetAllComments(taskId){

    console.log(taskId);

    var userId = userData.id;

    var commentInput = document.getElementById('commentInput').value;

    const url = 'http://p-project.hu/Backend/Controller/CommentController.php';

    fetch(url, {
        method: "POST",
        credentials: "include",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
        },
        body: JSON.stringify({
            taskId: taskId,
            comment: commentInput,
            userId: userId,
            mentionedUser: -1,
            function: "createComment",
            
        }) 
      })
      
    .then(response => {
        if (!response.ok) {
            throw new Error(`Hiba a kérés feldolgozásakor: ${response.status} ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {

        commentShow(taskId);
        alert(data.message);
     
    })

    .catch(e => console.log("error::", e));



    



   



}





function deleteTask(taskId) {

    
    const url = 'http://p-project.hu/Backend/Controller/TaskController.php';

    fetch(url, {
        method: "POST",
        credentials: "include",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
        },
        body: JSON.stringify({
            function: "deleteTask",
            id: taskId,
        }) 
      })
      
    .then(response => {
        if (!response.ok) {
            throw new Error(`Hiba a kérés feldolgozásakor: ${response.status} ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {

        alert(data.message);
        
        window.location.href = './getProjectById.html';
     
    })

    .catch(e => console.log("error::", e));

    
}


    

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



function deleteProject(){


    const url = 'http://p-project.hu/Backend/Controller/ProjectController.php';

    fetch(url, {
        method: "POST",
        credentials: "include",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
        },
        body: JSON.stringify({
            function: "deleteProject",
            id: projectId,
        }) 
      })
      
    .then(response => {
        if (!response.ok) {
            throw new Error(`Hiba a kérés feldolgozásakor: ${response.status} ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {

        alert(data.Result);
        
        window.location.href = './getAllProjects.html';
     
    })

    .catch(e => console.log("error::", e));




};


function editProject() {
    
    window.location.href = "./updateProject.html";

   

}



