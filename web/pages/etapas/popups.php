<!-- popup de deletar -->
<div id="deletarModal" class="modalDialog">
    <div>
        <a href="#" title="Close" class="close">
            <div class="close-container">
                <div class="leftright"></div>
                <div class="rightleft"></div>
            </div>
        </a>
        <h2>Deseja excluir essa etapa?</h2>
        <p>Uma vez deletada, todos os dados relacionados a mesma serão apagados e não poderão mais ser recuperados.</p>

        <form method="POST" action="./index.php?action=deletar">
            <input type="hidden" name="id" value="<?php echo $_GET['idetapa']; ?>">
            <input type="hidden" name="idproj" value="<?php echo $_GET['id']; ?>">
            <fieldset class="btn">
                <a href="?id=<?php echo $_GET['id']; ?>"><button type="button" class="btnSecundario"> Cancelar </button></a>
                <button type="submit" class="btnPrincipal"> Deletar </button>
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
        <h2>Cadastrar etapa</h2>

        <form method="POST" action="./index.php?action=cadastrar">
            <input type="hidden" name="projeto" value="<?php echo $_GET['id']; ?>">
            <fieldset>
                <input type="text" name="descricao" placeholder="Etapa" />
            </fieldset>
            <fieldset>
                <select name="subetapa">
                    <option value="0" selected> Etapa principal </option>
                    <?php while($etp = $etapas->fetchArray()) : ?>
                        <option value="<?php echo $etp['idetapa']?>">
                            <?php echo $etp['descricao']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </fieldset>
            
            <fieldset>
                <input type="text" name="responsavel" placeholder="Responsável" />
            </fieldset>

            <div class="items">
                <div class="item">
                    <fieldset>
                        <label> Início: </label>
                        <input type="date" name="dataini" />
                    </fieldset>
                </div>
                <div class="item">
                    <fieldset>
                    <label> Fim: </label>
                        <input type="date" name="datafim" />
                    </fieldset>
                </div>
            </div>

            <fieldset class="btn">
                <a href="#"><button type="button" class="btnSecundario"> Cancelar </button></a>
                <button type="submit" class="btnPrincipal"> Cadastrar </button>
            </fieldset>
        </form>
    </div>
</div>
