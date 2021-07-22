 <!-- popup de editar -->
 <div id="editarModal" class="modalDialog">
    <div>
        <a href="#" title="Close" class="close">
            <div class="close-container">
                <div class="leftright"></div>
                <div class="rightleft"></div>
            </div>
        </a>
        <h2>Editar empresa</h2>
        <p>Altere as informações da sua empresa e mantenha seus dados sempre atualizados.</p>

        <form method="POST" action="./index.php?action=editar">
            <fieldset>
                <input type="text" name="nome" placeholder="Nome da empresa" />
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
            </fieldset>
            <fieldset class="btn">
                <a href="#"><button type="button" class="btnSecundario"> Cancelar </button></a>
                <button type="submit" class="btnPrincipal"> Salvar </button>
            </fieldset>
        </form>
    </div>
</div>

<!-- popup de cadastrar -->
<div id="cadastrarModal" class="modalDialog">
    <div>
        <a href="#" title="Close" class="close">
            <div class="close-container">
                <div class="leftright"></div>
                <div class="rightleft"></div>
            </div>
        </a>
        <h2>Cadastrar empresa</h2>
        <p>Registre uma nova empresa que você esteja associado e comece já seus projetos.</p>

        <form method="POST" action="./index.php?action=cadastrar">
            <fieldset>
                <input type="text" name="nome" placeholder="Nome da empresa" />
            </fieldset>
            <fieldset class="btn">
                <a href="#"><button type="button" class="btnSecundario"> Cancelar </button></a>
                <button type="submit" class="btnPrincipal"> Cadastrar </button>
            </fieldset>
        </form>
    </div>
</div>

<!-- popup de deletar -->
<div id="deletarModal" class="modalDialog">
    <div>
        <a href="#" title="Close" class="close">
            <div class="close-container">
                <div class="leftright"></div>
                <div class="rightleft"></div>
            </div>
        </a>
        <h2>Deseja excluir essa empresa?</h2>
        <p>Uma vez deletada, todos os dados relacionados a mesma serão apagados e não poderão mais ser recuperados.</p>

        <form method="POST" action="./index.php?action=deletar">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <fieldset class="btn">
                <a href="#"><button type="button" class="btnSecundario"> Cancelar </button></a>
                <button type="submit" class="btnPrincipal"> Deletar </button>
            </fieldset>
        </form>
    </div>
</div>