
let clicked = false;


window.addEventListener('load', function() {

  document.addEventListener('click', function() {
    if (!clicked) {
     
      var email = localStorage.getItem('userLog').split(' ')[0];
      var password = localStorage.getItem('userLog').split(' ')[1];

      var func = "login";  
      
    const url = 'http://p-project.hu/Backend/Controller/UserController.php';

    fetch(url, {
        method: "POST",
        credentials: "include",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
        },
        body: JSON.stringify({
          email: email, 
          password: password,
          function: func 
        }) 
      })
      
    .then(response => {
        if (!response.ok) {
            throw new Error(`Hiba a kérés feldolgozásakor: ${response.status} ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
    
            console.log();("Sikeres bejelentkezés");


    })

    .catch(e => console.log("error::", e));

      clicked = true;
    }
  });
});

window.addEventListener("unload", function (event) {
    



    var data = localStorage.getItem('userData');
    var userData = JSON.parse(data).user;
    var id = userData.id;
    var func = "logout";
    const url = 'http://p-project.hu/Backend/Controller/UserController.php';
    
    // Az AJAX kérés beállítása és elküldése
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 201) {
        var response = JSON.parse(this.responseText);
        localStorage.removeItem('userData');
        localStorage.removeItem('userLog');
        window.location.href = '../Landing-page/index.html';
    }
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.setRequestHeader("Accept", "application/json");
    xhttp.withCredentials = true;
    xhttp.send(JSON.stringify({
    id: id, 
    function: func 
    }));



    event.preventDefault();
  
  


  
});




const buttons = document.querySelectorAll(".logOutBtn")


const logOutBtn = (e) => {

    e.preventDefault();

    var data = localStorage.getItem('userData');
    var userData = JSON.parse(data).user;
    var id = userData.id;
    var func = "logout";



    const url = 'http://p-project.hu/Backend/Controller/UserController.php';

    fetch(url, {
        method: "POST",
        credentials: "include",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
        },
        body: JSON.stringify({
          id: id, 
          function: func 
        }) 
      })
      
    .then(response => {
        if (!response.ok) {
            throw new Error(`Hiba a kérés feldolgozásakor: ${response.status} ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {

        console.log(data)
            alert("Viszlát");
            localStorage.removeItem('userData');
            localStorage.removeItem('userLog');
            window.location.href = '../Landing-page/index.html';
        
    })

    .catch(e => console.log("error::", e));

};



buttons.forEach((button) => {
  button.addEventListener("click", logOutBtn);
});





