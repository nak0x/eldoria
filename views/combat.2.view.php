<?php

use Rpg\Enums\Archetypes;
use Rpg\Enums\EnemyCode;

$combat = $this->gameContext->getCombat();

?>
<div class="combat main-frame p-3">
    <div class="player-profile-container">
        <img src="public/assets/gameassets/<?= Archetypes::getImagePath($this->gameContext->getPlayer()->archetype) ?>" alt="">
        <div class="player-infos-container">
            <div class="top d-flex justify-content-between">
                <div class="left">
                    <h3 class="player-name"><?= $combat->player->name ?></h3>
                    <p class="player-class"><?= $combat->player->getClassName() ?></p>
                </div>
                <div class="right">
                    <p class="level">Level : <?= $combat->player->level ?>/<?= 100 ?></p>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $combat->player->level?>%" aria-valuenow="<?= $combat->player->level ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <div class="life-container">
                    <p class="life">Vie : <?= $combat->player->life ?>/<?= $combat->player->getMaxLife() ?></p>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= (100 * $combat->player->life) / $combat->player->getMaxLife() ?>%" aria-valuenow="<?= (100 * $combat->player->life) / $combat->player->getMaxLife() ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="spell-container">
                    <form method="post">
                        <input type="hidden" name="form" value="combat-action">
                        <input type="hidden" name="action" value="heal">
                        <button class="btn btn-dark">Heal</button>
                    </form>
                    <form method="post">
                        <input type="hidden" name="form" value="combat-action">
                        <input type="hidden" name="action" value="buff">
                        <button class="btn btn-dark">Buff</button>
                    </form>
                    <form method="post">
                        <input type="hidden" name="form" value="combat-action">
                        <input type="hidden" name="action" value="ulti">
                        <button class="btn btn-dark">Ulti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row flex-wrap enemies-global-container" style="gap: 1rem;">
        <?php
            foreach ($combat->enemies as $uuid => $enemy):
        ?>
        <div class="enemy-container">                
            <img src="/public/assets/gameassets/enemies/<?= EnemyCode::getEnemyImage($enemy->getEnemyCode()) ?>" alt="">
            <div class="enemy-details-wraper">
                <div class="left">
                    <h3 class="enemy-name"><?= $enemy->getName() ?></h3>
                    <p style="font-size: .9em; opacity: 70%;">Niveau : <?= $enemy->level ?></p>
                </div>
                <div class="right">
                    <p>Points de vie : <?= $enemy->life ?></p>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= (100 * $enemy->life) / $enemy->getMaxLife() ?>%" aria-valuenow="<?= (100 * $enemy->life) / $enemy->getMaxLife() ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="enemy-action-container">
                <form method="post">
                    <input type="hidden" name="form" value="combat-action">
                    <input type="hidden" name="action" value="punch">
                    <input type="hidden" name="enemy" value="<?= $uuid ?>">
                    <button class="btn btn-dark">Punch</button>
                </form>
                <form method="post">
                    <input type="hidden" name="form" value="combat-action">
                    <input type="hidden" name="action" value="spell">
                    <input type="hidden" name="enemy" value="<?= $uuid ?>">
                    <button class="btn btn-danger">Spell</button>
                </form>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>