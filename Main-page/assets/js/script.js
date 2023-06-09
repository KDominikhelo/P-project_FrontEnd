const columns = document.querySelectorAll(".column");
var oldposition;

document.addEventListener("dragstart", (e) => {
  e.target.classList.add("dragging");
});

document.addEventListener("dragend", (e) => {
  e.target.classList.remove("dragging");

});

columns.forEach((item) => {
  item.addEventListener("dragover", (e) => {
    const dragging = document.querySelector(".dragging");
    const applyAfter = getNewPosition(item, e.clientY);

    if (applyAfter) {
      applyAfter.insertAdjacentElement("afterend", dragging);
    } else {
      item.prepend(dragging);
    }
  });
});

function getNewPosition(column, posY) {

  if (oldposition !== column) {
    oldposition = column;
   
    const task = {
      function:"moveTask",
      id:parseInt(localStorage.getItem("movingTask")),
      column: parseInt(column.id)
    }
    
    console.log(task);

    fetch("http://p-project.hu/Backend/Controller/TaskController.php",{
        method:"POST",
        headers:{
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify(task)
    }).then(data=>{
        return data.json();
    }).then(data=>{
        console.log(data.message);
    }).catch(err=>{
        console.log(err);
    })
   
  }
  
  const cards = column.querySelectorAll(".item:not(.dragging)");
  let result;

  for (let refer_card of cards) {
    const box = refer_card.getBoundingClientRect();
    const boxCenterY = box.y + box.height / 2;

    if (posY >= boxCenterY) result = refer_card;
  }

  return result;
}





const body = document.querySelector('body');
const sidebar = body.querySelector('nav');
const toggle = body.querySelector(".toggle");
const toggle2 = body.querySelector(".toggle2");
const searchBtn = body.querySelector(".search-box");
const modeSwitch = body.querySelector(".toggle-switch");
const modeText = body.querySelector(".mode-text");


toggle.addEventListener("click" , () =>{
toggleNav();  

});


toggle2.addEventListener("click" , () =>{
  toggleNav();  
  });
  
    
  

modeSwitch.addEventListener('click' , () =>{
toggleMode();
});

function toggleNav() {

  sidebar.classList.toggle("close");
  const navmode = sidebar.classList.contains("close");
  localStorage.setItem('navMode', navmode);  

 
}

function toggleMode() {
  body.classList.toggle("dark");

  const currentMode = body.classList.contains('dark') ? 'dark' : 'light';
  localStorage.setItem('mode', currentMode);
  

  if(body.classList.contains("dark")){
    modeText.innerText = "Light mode";
  }else{
    modeText.innerText = "Dark mode";
    
  }

}




const saveNav = localStorage.getItem('navMode');
if (saveNav === 'close') {
 console.log("itt valami baj van!")
  toggleNav();
}


const savedMode = localStorage.getItem('mode');
if (savedMode === 'dark') {
  toggleMode();
}




