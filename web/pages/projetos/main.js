var empList = document.getElementsByClassName('proj');
var delay = 300;

for(var i=0; i < empList.length; i++) {
    ScrollReveal().reveal(`#proj${i}`, { delay: delay });
    delay += 200;
}
