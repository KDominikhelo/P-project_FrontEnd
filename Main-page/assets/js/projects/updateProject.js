
const updateProjectForm = document.getElementById("updateProjectForm");

var projectDatas = localStorage.getItem('project');
var projectData = JSON.parse(projectDatas).Project;

updateProjectForm.addEventListener("submit", (event) => {

    event.preventDefault();
    updateProject();

});



function updateProject(){

    const dateTime = document.getElementById("projectStartDate");


    const splitted = dateTime.value.split("-");
    const year = splitted[0];
    const month = splitted[1];
    const day_min_sec = splitted[2];
    const day = day_min_sec.split("T");
    const min_sec = day[1].split(":");
    const min = min_sec[0];
    const sec = min_sec[0];



    var name = document.getElementById("projectName").value
    var description = document.getElementById("projectDescription").value
    var startDate = `${year}-${month}-${day[0]} ${min}:${sec}:00`;
    var priority = document.getElementById("projectPriority").value;
    var extraTime = 10;
    var func = "updateProject";
    var img = "default";




    const url = 'http://p-project.hu/Backend/Controller/ProjectController.php';



  fetch(url, {
        method: "POST",
        credentials: "include",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "Cookie": `${document.cookie}`
        },
        body: JSON.stringify({
            name: name, 
            description: description,
            startDate: startDate,
            priority: priority,
            extraTime: extraTime,
            function: func,
            img: img,
            id: projectData.id 
        }) 
        
        
      })
 
      .then(response => {

        if (!response.ok) {
            console.log(body);
            throw new Error(`Hiba a kérés feldolgozásakor: ${response.status} ${response.statusText}`);
        }
    })
    .then(data => {

            alert('A Project adatok sikeresen megváltoztak!');
            window.location.href = './getAllProjects.html';
        
    })
    .catch(e => console.log("error::", e));


}
