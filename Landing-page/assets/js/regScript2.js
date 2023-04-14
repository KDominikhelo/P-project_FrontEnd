
const regform = document.getElementById('regForm');


regform.addEventListener("submit", (e) => {

    

    validateForm();
    e.preventDefault();


});



function validateForm() {

    var email = document.forms["regForm"]["email"].value;
    var password = document.forms["regForm"]["password"].value;
    var passAgain = document.forms["regForm"]["passAgain"].value;
    var firstname = document.forms["regForm"]["firstName"].value;
    var lastname = document.forms["regForm"]["lastName"].value;
    var phone = document.forms["regForm"]["phone"].value;
    var func = "registration";


    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Az email cím formátuma helytelen!");
        return false;
    }

    if (firstname == "" || lastname == "" || email == "" || password == "" || passAgain == "" || phone == "") {
        alert("Minden mezőt ki kell tölteni!");
    }


    if (password.length < 8) {
        alert("A jelszó legalább 8 karakter hosszú kell legyen!");
        return false;
    }

    if (!(password == passAgain)) {
        alert("A két jelszó nem egyezik meg egymással");
        return false;
    }

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
          firstname: firstname,
          lastname: lastname,
          phone: phone,
          function: func,
          img:"default", 
        }) 
      })
      
    .then(response => {
        if (!response.ok) {
            alert("A User-t nem lehetett létrehozni. A jelszó nem elég hosszú, vagy az email már foglalt!")
        }else{
            alert("A regisztráció sikeresen megtörtént!")
        }
    })
    .catch(e => console.log("error::", e));

}

