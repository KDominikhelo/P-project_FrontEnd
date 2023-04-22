const logForm = document.getElementById("logForm");

logForm.addEventListener("submit", (e) => {

    e.preventDefault();

    var email = document.forms["logForm"]["email"].value;
    var password = document.forms["logForm"]["password"].value;
    var func = "login";


    localStorage.setItem('userLog', email + ' ' + password)

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
        if (data.user.email == null) {
            alert("A megadott email és jelszó hibás vagy nem létezik!");
        }

        else {
            alert("Sikeres bejelentkezés");
            localStorage.setItem('userData', JSON.stringify(data));
            window.location.href = '../Main-page/getAllProjects.html';
        }
        
    })

    .catch(e => console.log("error::", e));

});



