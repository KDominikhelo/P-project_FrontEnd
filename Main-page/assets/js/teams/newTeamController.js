var createTeamForm = document.getElementById('createTeamForm');

createTeamForm.addEventListener("submit", (event) => {



    formSubmit();


})


function formSubmit() {
    

    var name = document.getElementById('teamName').value;
    var func = 'createTeam';
    var img = 'default';


    
    const url = 'http://p-project.hu/Backend/Controller/TeamController.php';



  fetch(url, {
        method: "POST",
        credentials: "include",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "Cookie": `${document.cookie}`
        },
        body: JSON.stringify({
            function: func,
            name: name,
            img: img 
        }) 
        
        
      })
 
      .then(response => {

        if (!response.ok) {
            throw new Error(`Hiba a kérés feldolgozásakor: ${response.status} ${response.statusText}`);
        }
    })
    .then(data => {

            alert(data.message);
        
    })
    .catch(e => console.log("error::", e));







}