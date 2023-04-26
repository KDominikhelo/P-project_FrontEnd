window.addEventListener("load", (event) => {


    event.preventDefault();

    if (window.location.hash) {
        console.log(window.location.hash);
    }



})


var makeNewPwForm = document.getElementById('makeNewPwForm');

makeNewPwForm.addEventListener("submit", (event) => {

    event.preventDefault();

    var emailInput = document.getElementById('emailInput').value;

    var newPw = document.getElementById('passwordInput').value;



    const url = "http://p-project.hu/Backend/Controller/UserController.php";

    var token = window.location.hash.split('#')[1];  

    const data = {
      function: "resetPassword",
      email: emailInput,
      pw: newPw,
      token: token
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
    
        window.location.href = './index.html';
    
      })
      .catch(error => {
        console.error(error);
      });



});