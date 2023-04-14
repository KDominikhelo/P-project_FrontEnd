
    const searchInput = document.getElementById("searchRewiever");
    const searchField = document.getElementById("rewieverList");

    searchInput.addEventListener('input', () => {

    searchField.innerHTML = "";    

    var searchValue = searchInput.value;
    var func = "searchByEmail";
    const url = 'http://p-project.hu/Backend/Controller/UserController.php';
    

    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 201) {

        var response = JSON.parse(this.responseText);

        console.log();

    response.user.forEach(user => {
     
       
        searchField.innerHTML += `<a class="dropdown-item" onclick="userSave('${user.email}')" id="${user.id}">${user.first_name + " " + user.last_name + " | " + user.email}</a> <div class="dropdown-divider"></div>`;
  



    });

    }
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.setRequestHeader("Accept", "application/json");
    xhttp.withCredentials = true;
    xhttp.send(JSON.stringify({
    email: searchValue,
    function: func 
    }));

      });


 function userSave(userEmail) {
    

    var resultList = document.getElementById("resultList");

    var searchValue = userEmail;
    var func = "searchByEmail";
    const url = 'http://p-project.hu/Backend/Controller/UserController.php';
    

    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 201) {

        var response = JSON.parse(this.responseText);


     response.user.forEach(user => {
     
       
        resultList.innerHTML += `<li id="${user.id}" class="list-group-item rewiever">${user.first_name + " " + user.last_name + " | " + user.email}</li>`;
  



    });

    }
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.setRequestHeader("Accept", "application/json");
    xhttp.withCredentials = true;
    xhttp.send(JSON.stringify({
    email: searchValue,
    function: func 
    }));


 }     