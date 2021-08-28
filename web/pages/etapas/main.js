function onMostraSubEtapas(idetapa) {
    var subetapas = document.querySelector(`#collapse${idetapa}`);

    if(subetapas.style.height !== "0px" && subetapas.style.height !== "" && subetapas.style.height !== null) {
        subetapas.style.height = '0'
        subetapas.style.padding = '0'
    } else {
        subetapas.style.height = 'auto'
        subetapas.style.padding = '20px 35px 20px 20px'
    }
}