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

function onCheckEtapa(idproj, idetapa) {
    var check = document.getElementById(idetapa).checked;

    var situacao = check ? 'F' : 'A';
    
    var dados = {
        id: idetapa,
        situacao: situacao,
        subetapa: '0',
        projeto: idproj
    };

    $.ajax({
        url: `?id=${idproj}&action=atualizar`,
        type: 'POST',
        data: {data: JSON.stringify(dados)},
        success: function(response){

        //     $.get(`?id=${idproj}&action=atualizar`, function(data, status, xhr) {
        //         console.log(data)
        //     })
        //     // Retorno se tudo ocorreu normalmente
        //    this.onCheckSubEtapas(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
        // Retorno caso algum erro ocorra
            console.log(errorThrown)
        }
    });
}

function onCheckSubEtapas(idsubetapas) {

}