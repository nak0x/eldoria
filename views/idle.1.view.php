<?php
use Rpg\Enums\Archetypes;

$player = $this->gameContext->getPlayer();
?>

<div class="idle main-frame d-flex p-3 h-100">
    <div class="player-profile-container">
        <img src="public/assets/gameassets/<?= Archetypes::getImagePath($this->gameContext->getPlayer()->archetype) ?>" alt="">
        <div class="player-infos-container">
            <div class="top d-flex justify-content-between">
                <div class="left">
                    <h3 class="player-name"><?= $player->name ?></h3>
                    <p class="player-class"><?= $player->getClassName() ?></p>
                </div>
                <div class="right">
                    <p class="life">Vie : <?= $player->life ?>/<?= $player->getMaxLife() ?></p>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= (100 * $player->life) / $player->getMaxLife() ?>%" aria-valuenow="<?= (100 * $player->life) / $player->getMaxLife() ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <p class="level">Level : <?= $player->level ?>/<?= 100 ?></p>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= $player->level?>%" aria-valuenow="<?= $player->level ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="action-container">
        <h2 class="actions">Que veux-tu faire <?= $player->getClassName() ?></h2>
        <div class="action-wraper">
            <form method="POST">
                <input type="hidden" name="form" value="goto-combat">
                <button class="btn btn-danger">Partire au combat</button>
            </form>
        </div>
    </div>
</div>
