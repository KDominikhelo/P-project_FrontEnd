window.addEventListener('load', function() {

var teamNameField = document.getElementById('teamNameField');


teamNameField.innerHTML = localStorage.getItem('teammIdAndName').split('')[1];

    




})