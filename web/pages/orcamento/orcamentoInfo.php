<div class='orcamento itorc' id="orcamento">
         
    <a class="it hh" href="?id=<?= $orc['idproj'];?>&idorc=<?= $orc['destino']; ?>#historico">
        
        <fieldset>
            <input type='text' value='<?= $orc['destino']; ?>' name='descricao' readOnly>
        </fieldset>
        <fieldset>
            <input type='date' value='<?= $orc['data_registro']; ?>' name='date' readOnly>
        </fieldset>
        <fieldset>
            <input type='text' id='valor_recebido<?= $orc['destino']; ?>' value='R$ <?= $orc['soma']; ?>' name='valor_recebido' readOnly>
        </fieldset>
        <fieldset>
            <input type='text' id='valor_receber' value='R$ <?= $orc['receber']; ?>' name='valor_receber' readOnly>
        </fieldset>
    </a>
    
    
    <div class='item'>
        <a href="?id=<?= $_SESSION['projAtivo'];?>&idorc=<?= $orc['idorc'];?>#deletarModal">
            <div class="close-container">
                <div class="leftright"></div>
                <div class="rightleft"></div>
            </div>
        </a>
    </div> 
        
</div>