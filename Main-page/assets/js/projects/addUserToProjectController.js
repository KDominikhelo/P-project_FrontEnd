    var searchInput = document.getElementById('searchUserToAddProject');
    
    var resultList1 = document.getElementById('addUserField');
    var userId_s = [];

    searchInput.addEventListener('input', () => {

        

        var searchValue = searchInput.value;
        var func = "searchByEmail";
        const url = 'http://p-project.hu/Backend/Controller/UserController.php';
        
    
        var xhttp = new XMLHttpRequest();
        
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 201) {

            resultList1.innerHTML = '';
    
            var response = JSON.parse(this.responseText);


     
            response.user.forEach(user => {
         
                var userDatas = localStorage.getItem('userData');
                var userData = JSON.parse(userDatas).user;
if(userData.id !== user.id){
    var bool = true;
    userId_s.forEach(data=>{
        if (data.user == user.id ){
            bool = false
        }
         
    })
    if (bool) {
        resultList1.innerHTML += `<a class="dropdown-item mt-2" onclick="userSave('${user.email}')">${user.first_name + " " + user.last_name + " | " + user.email}</a> <div class="dropdown-divider"></div>`;
      
    }

}
    
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



 function userSave(userEmail) {
    



    var searchValue = userEmail;
    var func = "searchByEmail";
    const url = 'http://p-project.hu/Backend/Controller/UserController.php';


    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        console.log(userId_s);
    if (this.readyState == 4 && this.status == 201) {

        var response = JSON.parse(this.responseText);


     response.user.forEach(user => {
     console.log(user , "user DATA");
       
        resultList.innerHTML += `<li id="${user.id}" class="list-group-item rewiever">${user.first_name + " " + user.last_name + " | " + user.email} <input type="checkbox" class="btn-check" id="btncheckEditor${user.id}" autocomplete="off">
        <label class="btn btn-outline-primary" for="btncheckEditor${user.id}">Editor</label>   <input type="checkbox" class="btn-check" id="btncheckReviewr${user.id}" autocomplete="off">  <label class="btn btn-outline-primary" for="btncheckReviewr${user.id}">Reviewer</label> </li>`;
  
        var projectDatas = localStorage.getItem('project');
        var projectData = JSON.parse(projectDatas).Project;


        if(document.getElementById(`btncheckEditor${user.id}`) && document.getElementById(`btncheckReviewr${user.id}`) ){
            userId_s.push({
                function:"addUserToProject",
                project:parseInt(projectData.id),
                user: parseInt(user.id),
                role:6,
                editor:document.getElementById(`btncheckEditor${user.id}`).checked ,
                reviewer:document.getElementById(`btncheckReviewr${user.id}`).checked
            }
            );
            userId_s.forEach((item)=>{
               
                document.getElementById(`btncheckEditor${item.user}`).addEventListener("click",()=>{
                       console.log("btncheckEditor" ,item.user);
                      item.editor = document.getElementById(`btncheckEditor${item.user}`).checked  
                   
                })
                document.getElementById(`btncheckReviewr${item.user}`).addEventListener("click",()=>{
                    
                  
                      console.log("btncheckReviewr" ,item.user);
                   item.reviewer = document.getElementById(`btncheckReviewr${item.user}`).checked
                      
                })
                  
           })
                
            
           
            
            
        }
                  


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
 
 



 const addMemberToProjectForm = document.getElementById("addMemberToProjectForm");


 addMemberToProjectForm.addEventListener("submit", (e) => {

    e.preventDefault();

    formSubmit();

});




function formSubmit() {
    
   for (let i = 0; i < userId_s.length; i++) {
     console.log(JSON.stringify(userId_s[i]));
     console.log(userId_s[i]);
    fetch("http://p-project.hu/Backend/Controller/ProjectController.php",{
        method:"POST",
        headers:{
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify(userId_s[i])
    }).then(data=>{
        return data.json();
    }).then(data=>{
        alert(data.message)
    }).catch(err=>{
        console.log(err);
    })
   
   }
    

}