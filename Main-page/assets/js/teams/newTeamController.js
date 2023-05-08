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



function addNewUserToField(){

var addNewField = document.getElementById('addUserField');




addNewField.innerHTML += `
<div class="row mt-2">

    <div class="col-2">
        <img style="width: 100%; border-radius: 50%;" src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="">
    </div>

    <div class="col-10">
        <input type="text" class="form-control" placeholder="email cím">

        <select class="form-select" aria-label="Default select example">
            <option selected>Role</option>
            <option value="Developer">Developer</option>
            <option value="Frontend">Frontend</option>
            <option value="Backend">Backend</option>
            <option value="Product Owner">Product Owner</option>
            <option value="Projectmanager">Projectmanager</option>
          </select>

    </div>

</div>`





}