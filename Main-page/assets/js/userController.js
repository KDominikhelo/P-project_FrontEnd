
window.addEventListener("load", (event) => {
    event.preventDefault();



    if (localStorage.getItem('userData') == null) {
        console.log("Nincs user bejelentkezve");
        window.location.href = '../Landing-page/index.html'; 
     }

   else{

        var data = localStorage.getItem('userData');
        var userData = JSON.parse(data).user;

        var userField = document.getElementById('userField');

        userField.innerText = "Hello " + userData.first_name + " " +userData.last_name;


        var username = document.getElementById("userNameField_profile");
        var email = document.getElementById("emailField_profile");
        var phone = document.getElementById("phoneField_profile")

        username.innerText = userData.first_name + " " +userData.last_name;
        email.innerText = "Email: " + userData.email;
        phone.innerText = "Phone: " + userData.phone;




   }
 


});







