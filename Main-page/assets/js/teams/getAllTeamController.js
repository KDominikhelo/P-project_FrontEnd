window.addEventListener("load", (event) => {





    const url = "http://p-project.hu/Backend/Controller/TeamController.php";
    var team_field = document.getElementById('teams');
    
    

    
    
    const data = {
      function: "getUserTeams"
    };
    
    function imageChecker(image) {
    
      let randomImage = Math.floor(Math.random() * 6) + 1;
    
        var image2 ="https://images.unsplash.com/photo-1542626991-cbc4e32524cc?crop=faces%2Cedges&cs=tinysrgb&fit=crop&fm=jpg&ixid=MnwxMjA3fDB8MXxhbGx8fHx8fHx8fHwxNjgwODgwNjIx&ixlib=rb-4.0.3&q=60&w=1200&auto=format&h=630&mark-w=64&mark-align=top%2Cleft&mark-pad=50&blend-mode=normal&blend-alpha=10&blend-w=1&mark=https%3A%2F%2Fimages.unsplash.com%2Fopengraph%2Flogo.png&blend=000000";
        var image3 ="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80";
        var image4 ="https://images.unsplash.com/photo-1531403009284-440f080d1e12?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80";
        var image5 ="https://images.unsplash.com/photo-1627634777217-c864268db30c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80";
        var image6 ="https://images.unsplash.com/photo-1512758017271-d7b84c2113f1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80";
        var image7 ="https://images.unsplash.com/photo-1590402494587-44b71d7772f6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80";
    
        if (image === "default" || image == 10) {
            if (randomImage == 1) {
               return image2;
            }
            else if(randomImage == 2){
              return image3;
            }
            else if(randomImage == 3){
              return image4;
            }
            else if(randomImage == 4){
              return image3;
            }
            else if(randomImage == 5){
              return image5;
            }
            else if(randomImage == 6){
              return image6;
            }
            else{
              return image7;
            }
        }
    
        else{
            return image;
        }
    
    }
    
    
    
    const options = {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    };
    
    
    fetch(url, options)
      .then(response => {
    
        return response.json();
      })
      .then(data => {
    
        const projects = data.Result;
    

    
    
        projects.forEach(project => {
         

          
    
           
            team_field.innerHTML += `
            <div class="col-md-4 mb-2">
            <div class="project_card card">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <img class="project_image mt-4"
                            src="${imageChecker(project.img)}"
                            alt="">
                        <div class="project_owner">
                            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="">

                        </div>
                        <div class="col-12 text-center mt-4">
                            <p class="project_owner_name">${project.name}</p>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-6 text-center">
                        <div class="btn btn-success p-button" onClick="inviteUserToTeam(${project.id})">Meghívás</div>
                    </div>
                    <div class="col-6 text-center">
                        <div class="btn btn-primary p-button" onClick="editTeam(${project.id},'${project.name}')">Szerkesztés</div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="collabs">

                        Csapat tagjai:

                            <ul id="teamMemberField${project.id}">

                          
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>`;
      
        getAllteamMember(project.id);
    
    
        });
      })
      .catch(error => {
        console.error(error);
      });
    
    
    });


function getAllteamMember(teamId){


    fetch("http://p-project.hu/Backend/Controller/TeamController.php",{
        method:"POST",
        headers:{
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify({
          function: "getTeamMembers",
          id: teamId,
        })
    }).then(data=>{
        return data.json();
    }).then(data=>{
      
      
      var teamMembers = data.Result;


      if (teamMembers.length == 0) {

        document.getElementById(`teamMemberField${teamId}`).innerHTML = `<p>Ehhez a csapathoz jelenleg egy felhasználó sincs hozzárendelve!</p>`
        
      }

      else{

        teamMembers.forEach(p => {
     
          let teamMember = p;
         
          document.getElementById(`teamMemberField${teamId}`).innerHTML += `<span class="tt" data-bs-placement="bottom" title="${teamMember.first_name + ' ' + teamMember.last_name + ' ' + teamMember.roleName}">
          <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="">
        </span>`;
      
      
    });

      }


      


    }).catch(err=>{
        console.log(err);
    })
   
  
    


}

function editTeam(teamId,teamName) {
        
      localStorage.setItem('teammIdAndName', teamId + ' ' + teamName)

        window.location.href = './editTeam.html';


    }


function inviteUserToTeam(teamId) {

localStorage.setItem("teamId", teamId);  

var myTaskModal = new bootstrap.Modal(`#addMemberToTeam`);

myTaskModal.show();

      
    }