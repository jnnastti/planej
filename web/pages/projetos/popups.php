<!-- popup de deletar -->
<div id="deletarModal" class="modalDialog">
    <div>
        <a href="#" title="Close" class="close">
            <div class="close-container">
                <div class="leftright"></div>
                <div class="rightleft"></div>
            </div>
        </a>
        <h2>Deseja excluir esse projeto?</h2>
        <p>Uma vez deletado, todos os dados relacionados ao mesmo serão apagados e não poderão mais ser recuperados.</p>

        <form method="POST" action="./index.php?action=deletar">
            <fieldset class="btn">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <a href="#"><button type="button"> Cancelar </button></a>
                <button type="submit"> Deletar </button>
            </fieldset>
        </form>
    </div>
</div>