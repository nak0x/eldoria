<div class="d-flex justify-content-center align-items-center flex-column g-2">
    <h3>Bonjour <?= $this->gameContext->getPlayer()->name ?> vous ètes un <?= $this->gameContext->getPlayer()->getClassName() ?></h3>
    <form method="POST">
        <input type="hidden" name="form" value="goto-combat"/>
        <button class="btn btn-primary">Lancer un combat</button>
    </form>
</div>