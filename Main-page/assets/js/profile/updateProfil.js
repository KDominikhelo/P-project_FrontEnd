
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

        userField.innerText = "Hello " + userData.first_name + " " + userData.last_name;

        
       
        


   }

   if (window.location.href == 'http://p-project.hu/Frontend/Main-page/profile.html') {


   var profileCardField = document.getElementById("profileCard");


   profileCardField.innerHTML += `<div class="col-lg-4 position-absolute top-50 start-50 translate-middle">
                            <div class="card ">
                                <header>
                                    <time datetime="2018-05-15T19:00"></time>
                                    <div class="logo">
                                        <span>
                            
                                        </span><img src="${imageChecker()}" alt="" width="100%"
                                            height="100%" class="image-responsive bx-border-radius position-relative">
                            
                                    </div>
                                    <div class="sponsor"></div>
                                </header>
                                <div class="announcement">
                                    <h3 id="userNameField_profile">${userData.first_name + " " + userData.last_name}</h3>
                                    <p id="emailField_profile">Email: ${userData.email}</p>
                                    <p class="italic" id="phoneField_profile">Telefon: ${userData.phone}</p>
                                </div>
                            
                                <div class="btn btn-info" onClick="profileUpdate()">Profile szerkesztése</div>
                            </div>
                            </div>`;
  
   }
 


});



function imageChecker() {

    var data = localStorage.getItem('userData');
    var userData = JSON.parse(data).user;

    if (userData.img == "default") {
        return "../Landing-page/assets/img/image-2.svg";
    }
    else{

        return userData.img;

    }
    
}


function profileUpdate() {
    
var myTaskModal = new bootstrap.Modal(`#updateProfile`);

myTaskModal.show();


}


const updateProfileForm = document.getElementById('updateProfileForm');


updateProfileForm.addEventListener("submit", (e) => {

    e.preventDefault();

    submitForm();
   


});


function submitForm() {

    var data = localStorage.getItem('userData');
    var userData = JSON.parse(data).user;

    var email = document.forms["updateProfileForm"]["email"].value;
    var profilPic = document.forms["updateProfileForm"]["profilPic"].value;
    var firstname = document.forms["updateProfileForm"]["firstname"].value;
    var lastname = document.forms["updateProfileForm"]["lastname"].value;
    var phone = document.forms["updateProfileForm"]["phone"].value;
   

    
    if (email == '') {
        email = userData.email; 
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Az email cím formátuma helytelen!");
        return false;
    }

    if (firstname == '') {
        firstname = userData.first_name;   
    }
    if (lastname == '') {
        lastname = userData.last_name;
    }
    if (email == '') {
        email = userData.email;
    }
    if (phone == '') {
        phone = userData.phone;
    }



    fetch("http://p-project.hu/Backend/Controller/UserController.php",{

    method:"POST",
    headers:{
        "Content-Type": "application/json",
        "Accept": "application/json"
    },
            body: JSON.stringify({

                email: email,
                firstname: firstname,
                lastname: lastname,
                phone: phone,
                function: "updateUser",
                img: profilPic



            })
        }).then(data=>{
            return data.json();
        }).then(data=>{
            alert(data.message)
        }).catch(err=>{
            console.log(err);
        })



    
}