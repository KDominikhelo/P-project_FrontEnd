


const createPorjectForm = document.getElementById("createProjectForm");

createPorjectForm.addEventListener("submit", (event) => {
    event.preventDefault();

    formSubmit();


});

function formSubmit(){

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
    var func = "createProject";




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
            function: func 
        }) 
        
      })
      


      .then(response => {

     

        if (!response.ok) {
            throw new Error(`Hiba a kérés feldolgozásakor: ${response.status} ${response.statusText}`);
        }
    })
    .then(data => {

            console.log(data)
        
    })
    .catch(e => console.log("error::", e));









}