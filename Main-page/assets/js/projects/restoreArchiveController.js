


window.addEventListener("load", (event) => {




    const url = "http://p-project.hu/Backend/Controller/ProjectController.php";
    var projects_field = document.getElementById('projects');
    
    
    var userDatas = localStorage.getItem('userData');
    var userData = JSON.parse(userDatas).user;
    
    
    
    const data = {
      function: "getArchivedProjectByUser",
      id: userData.id,
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
    
        var projectNumber = 1;
    
    
        projects.forEach(project => {
         
    
            splittedDescription = project.description.split(' ').slice(0, 5).join(' ');
    
           
            projects_field.innerHTML += `<div class="col-md-4 mb-2">
            <div class="project_card card">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="project_number">
                                <p>${projectNumber + "."}</p>
                            </div>
                            <img class="project_image mt-4"
                                src="${imageChecker(project.img)}"
                                alt="">
                            <div class="project_owner">
                                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="">
                                <p class="project_owner_name">${project.name}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="description">${splittedDescription + "..."}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="collabs">
                                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="">
                                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="">
                                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="">
                            </div>
                            <p>@02-user és további 2 ember társaságában.</p>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col-6 ">
                            ${project.start_date}
                        </div>
                        <div class="col-6 ">
                            <div class="btn btn-info p-button" onclick="restoreArchivedProject(${project.id})">Project Visszaállítása</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
      
        projectNumber++;
    
    
        });
      })
      .catch(error => {
        console.error(error);
      });
    
    
    });
    
    
    
    function restoreArchivedProject(id) {

        const url = "http://p-project.hu/Backend/Controller/ProjectController.php";

        const data = {
            function: "restoreProject",
            project: id,
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
          
              return response.json();
            })
            .then(data => {
          
              alert(data.message);

              window.location.href = './getAllProjects.html';
          
        
            })
            .catch(error => {
              console.error(error);
            });
          
        
    }
    
   
