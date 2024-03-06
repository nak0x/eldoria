<?php

namespace Rpg\Models;

use Rpg\Enums\CombatActions;
use Rpg\Enums\EnemyCode;
use Rpg\Enums\LevelRange;
use Rpg\Enums\Levels;
use Rpg\Models\Archetypes\Player;
use Rpg\Models\Enemies\Enemy;

// TODO : Add an XP system for leveling

class Combat
{
    public array $enemies;
    public Player $player;
    public int $turn = 0;
    public bool $isOver = false;
    public bool $is_boss_fight = false;

    public function __construct(public Levels $level, Player &$player)
    {
        $this->enemies = [];
        // Utilisation de clone pour duppliquer mon joueur et ne pas toucher à l'objet généric
        $this->player = clone $player;

        $availableEnemies = Levels::getEnemiesFromLevel($this->level);
        $enemyLevel = round($this->player->level / 2);

        // Fill the combat enemies depending on the level of the combat and the level of the player
        switch(LevelRange::getRangeFromLevel($this->player->level)) {
        case LevelRange::Low:
            // Get only low level enemie - the amount is define by the player level / 4
            for($i = 0; $i < max(round($this->player->level / 8), 1); $i++) {
                $enemy = EnemyCode::createEnemyFromEnemyCode(EnemyCode::tryFrom($availableEnemies["low"]), $enemyLevel);
                $this->enemies[$enemy->uuid->value()] = $enemy;
            }
            break;
        case LevelRange::Med:
            // Get low lovel enemy - the amount is define by the player level / 2
            for($i = 0; $i < max(round($this->player->level / 4), 1); $i++) {
                $enemy= EnemyCode::createEnemyFromEnemyCode(EnemyCode::tryFrom($availableEnemies["low"]), $enemyLevel);
                $this->enemies[$enemy->uuid->value()] = $enemy;
            }
            // Get med level enemy - the amount is define by the player level / 4
            for($i = 0; $i < max(round($this->player->level / 8), 1); $i++) {
                $enemy = EnemyCode::createEnemyFromEnemyCode(EnemyCode::tryFrom($availableEnemies["med"]), $enemyLevel);
                $this->enemies[$enemy->uuid->value()] = $enemy;
            }
            break;
        case LevelRange::High:
            // Get only med level enemies - the amount is define by player level / 2
            for($i = 0; $i < max(round($this->player->level / 3), 1); $i++) {
                $enemy = EnemyCode::createEnemyFromEnemyCode(EnemyCode::tryFrom($availableEnemies["med"]), $enemyLevel);
                $this->enemies[$enemy->uuid->value()] = $enemy;
            }
            break;
        }

        // If player is level 100 -> boss fight
        if($this->player->level >= 100){
            $this->enemies = [
                EnemyCode::createEnemyFromEnemyCode(EnemyCode::tryFrom($availableEnemies["boss"]), $enemyLevel)
            ];
            $this->is_boss_fight = true;
        }
    }

    public function turn(CombatActions $action, string|null $enemyIndex=null): void
    {
        // TODO : AoE

        // Do the player action
        if(array_key_exists($enemyIndex, $this->enemies)) {
            switch($action) {
            case CombatActions::PUNCH:
                $this->player->punch($this->enemies[$enemyIndex]);
                break;
            case CombatActions::HEAL:
                $this->player->heal();
                break;
            case CombatActions::BUFF:
                $this->player->buff();
                break;
            case CombatActions::SPELL:
                $this->player->spell($this->enemies[$enemyIndex]);
                break;
            case CombatActions::ULTI:
                $this->player->ulti();
                break;
            }
        }else {
            throw new \Exception("Not valid player action");
        }

        // Delete killed enemies
        $this->enemies = array_filter($this->enemies, function ($enemy){
            return $enemy->isAlive;
        });

        // Loop throw enemies for the actions
        foreach($this->enemies as $enemy) {
            $enemy->runAi($this->player, $this->turn, $this->level);
        }

        // Resets player
        if($this->turn % 2 == 0) {
            $this->player->resetFactors();
        }

        // Turn validation && increments
        if(!$this->player->isAlive || count($this->enemies) == 0) {
            $this->isOver = true;
            return;
        }
        $this->turn++;
    }
}
