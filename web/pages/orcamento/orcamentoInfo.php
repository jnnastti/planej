<div class='orcamento items' id="orcamento">
                        
    <div class='item'>
        <fieldset>
            <input type='text' value='<?= $orc['destino']; ?>' name='descricao' readOnly>
        </fieldset>
    </div>
    <div class='item'>
        <fieldset>
            <input type='date' value='<?= $orc['data_registro']; ?>' name='date' readOnly>
        </fieldset>
    </div>
    <div class='item'>
        <fieldset>
            <input type='text' id='valor_recebido' value='R$ <?= $orc['valor']; ?>' name='valor_recebido' readOnly>
        </fieldset>
    </div>
    <div class='item'>
        <fieldset>
            <input type='text' id='valor_receber' value='R$ <?= $orc['receber']; ?>' name='valor_receber' readOnly>
        </fieldset>
    </div>
    
    
    <div class='item'>
        <a href="?idorc=<?= $orc['idorc'];?>#deletarModal">
            <div class="close-container">
                <div class="leftright"></div>
                <div class="rightleft"></div>
            </div>
        </a>
    </div> 
        
</div>