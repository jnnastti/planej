<div class='proj items' id="proj<?php echo $contador; ?>">
    <div class='item'>
        <fieldset>
            <a href="./formulario/index.php?id<?php echo $proj['idproj']; ?>">
                <button type='button' title='Editar' onclick='editarProjeto();'> ✎ </button>
            </a>
        </fieldset>
    </div>
    <div class='item'>
        <fieldset>
            <input type='text' value='<?php echo $proj['nome']; ?>' name='nome' readOnly>
        </fieldset>
    </div>
    <div class='item'>
        <fieldset>
            <input type='text' value='<?php echo $proj['nome_proprietario']; ?>' name='nomeProp' readOnly>
        </fieldset>
    </div>
    <div class='item'>
        <fieldset>
            <input type='text' id='valor_inicial' value='R$ <?php echo number_format($proj['valor_inicial'], 2, ',', ''); ?>' name='valor_inicial' readOnly>
        </fieldset>
    </div>
    <div class='item'>
        <fieldset>
            <button type='button' title='Etapas' onclick='etapaProjeto();'> ✓ </button>
        </fieldset>
    </div>
    <div class='item'> 
        <fieldset>
            <button type='button' class='btnOrcamento' title='Orçamento' onclick='orcamentoProjeto();'> $ </button>
        </fieldset>
    </div>
    <div class='item'>
        <a href="?id=<?php echo $proj['idproj']; ?>#deletarModal">
            <div class="close-container">
                <div class="leftright"></div>
                <div class="rightleft"></div>
            </div>
        </a>
    </div>   
</div>