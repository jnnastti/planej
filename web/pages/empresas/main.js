var empList = document.getElementsByClassName('emp');
var delay = 300;

for(var i=0; i < empList.length; i++) {
    ScrollReveal().reveal(`#emp${i}`, { delay: delay });
    delay += 200;
}

function selecionarEmpresa(id) {
    
}