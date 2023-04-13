// Definiáljuk az URL-t, amelyen keresztül elérhetőek a projektadatok
const url = "http://p-project.hu/Backend/Controller/ProjectController.php";
var projects_field = document.getElementById('projects');
// Definiáljuk az elküldendő adatokat, a function-t és az ID-t
const data = {
  function: "getProjectByUser",
  id: 26,
};

function imageChecker(image) {
    var image2 = "https://images.unsplash.com/photo-1542626991-cbc4e32524cc?crop=faces%2Cedges&cs=tinysrgb&fit=crop&fm=jpg&ixid=MnwxMjA3fDB8MXxhbGx8fHx8fHx8fHwxNjgwODgwNjIx&ixlib=rb-4.0.3&q=60&w=1200&auto=format&h=630&mark-w=64&mark-align=top%2Cleft&mark-pad=50&blend-mode=normal&blend-alpha=10&blend-w=1&mark=https%3A%2F%2Fimages.unsplash.com%2Fopengraph%2Flogo.png&blend=000000";
    
    if (image === "default") {
        return image2;
    }

    else{
        return image;
    }
}


// Definiáljuk a fetch kérés paramétereit
const options = {
  method: "POST",
  headers: {
    "Content-Type": "application/json",
  },
  body: JSON.stringify(data),
};

// Lekérdezzük a projektadatokat a fetch API segítségével
fetch(url, options)
  .then(response => {
    // A választ JSON formátumban parsoljuk
    return response.json();
  })
  .then(data => {
    // Az adatokat elmentjük egy változóba
    const projects = data.Result;

    var projectNumber = 1;

    // Végigmegyünk a projektek tömbjén egy for each ciklussal
    projects.forEach(project => {
     
       
        projects_field.innerHTML += `<div id="${projectNumber + "asd"}" class="col-md-4 mb-2">
        <div class="project_card card">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="project_number">
                            <p>${projectNumber + "."}</p>
                        </div>
                        <img class="project_image mt-4"
                            src="${imageChecker(project.img)}"
                            alt="">
                        <div class="project_owner">
                            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="">
                            <p class="project_owner_name">${project.name}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p class="description">${project.description}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="collabs">
                            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="">
                            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="">
                            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="">
                        </div>
                        <p>@02-user és további 2 ember társaságában.</p>
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-6 ">
                        ${project.start_date}
                    </div>
                    <div class="col-6 ">
                        <div class="btn btn-info p-button">Project megnyitása</div>
                    </div>
                </div>
            </div>
        </div>
    </div>`;
  
    projectNumber++;


    });
  })
  .catch(error => {
    console.error(error);
  });
