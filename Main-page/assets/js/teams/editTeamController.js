window.addEventListener('load', function() {

var teamNameField = document.getElementById('teamNameField');

var fullName = '';

for (let i = 1; i < localStorage.getItem('teammIdAndName').split(' ').length; i++) {



    fullName += localStorage.getItem('teammIdAndName').split(' ')[i] + ' ';
    
}

teamNameField.innerText = fullName;

    
console.log(localStorage.getItem('teammIdAndName').split(' '));



})