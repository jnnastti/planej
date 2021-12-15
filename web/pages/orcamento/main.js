var timerDataList = {};//Para usar com multiplos datalist

function qs(query, context) {
    return (context || document).querySelector(query);
 }
 function qsa(query, context) {
    return (context || document).querySelectorAll(query);
 }
   
qs("#obs").addEventListener('input', function (e) {
    var listAttr = e.target.getAttribute('list');
      
    if (timerDataList[listAttr]) 
        clearTimeout(timerDataList[listAttr]);
   
    timerDataList[listAttr] = setTimeout(executeCheckin, 100, e.target, listAttr);
 });
   
function executeCheckin(target, listAttr) {
    var options = qsa( 'option', qs('#' + listAttr) ),
        values = [];
     
    [].forEach.call(options, function (option) {
        values.push(option.value)
    });

    var currentValue = target.value;
    var inValorTotal = document.querySelector('#valorTotal');

    
    if (values.indexOf(currentValue) !== -1) {
        var valorTotal = document.getElementById(currentValue).textContent;
        
        inValorTotal.value = valorTotal.substr(valorTotal.indexOf('R$') + 2).trim()

        isSelecionado = true
    } else {
        inValorTotal.value = "";

        isSelecionado = false
    }
 }


function calculaValorFaltante() {
    var valorTotal = document.getElementById('valorTotal')
    var valorRecebido = document.getElementById('valorRecebido')
    var valorFaltante = document.getElementById('valorFaltante')
    
    if(isSelecionado) {
        var nome = document.getElementById('obs').value;
        var valorAnterior = document.getElementById(`valor_recebido${nome}`)

        valorAnterior = valorAnterior.value.substr(2).trim()
    } else {
        var valorAnterior = 0
    }
    
    valorFaltante.value = valorTotal.value - (parseInt(valorRecebido.value) + parseInt(valorAnterior));
}