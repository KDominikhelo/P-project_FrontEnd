var forgotPwForm = document.getElementById('forgotPwForm');



forgotPwForm.addEventListener("submit", (e) => {



    const emailInput = document.getElementById('forgotPwEmail').value;

    const url = "http://p-project.hu/Backend/Controller/UserController.php";

    const data = {
      function: "forgotPassword",
      email: emailInput,
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
    
        
    
      })
      .catch(error => {
        console.error(error);
      });
    
    
      var myTaskModal = new bootstrap.Modal(`#makeNewPwModal`);

      myTaskModal.show();



})