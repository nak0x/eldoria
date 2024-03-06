<?php

namespace Rpg\Utils;

use Rpg\Enums\Archetypes;
use Rpg\Enums\CombatActions;
use Rpg\Enums\Levels;
use Rpg\Models\Archetypes\Player;
use Rpg\Models\Archetypes\Warrior;
use Rpg\Models\Archetypes\Priest;
use Rpg\Models\Archetypes\Mage;
use Rpg\Models\Combat;
use Rpg\Models\Enemies\Enemy;
use Rpg\Models\Market;
use Rpg\Enums\GameState;
use Rpg\Models\Uuid;
use Rpg\Enums\LevelRange;

class GameContext{
    private array $data = [
        "player" => null,
        "combat" => null,
        "market" => null,
        "state" => GameState::NOT_STARTED,
        "level" => Levels::OVERWORLD
    ];

    public function __construct()
    {
        $this->data["market"] = new Market();
    }

    // Getters
    public function getFullData(): array
    {
        return $this->data;
    }
    public function getEnemies(): array
    {
        return $this->data["enemies"];
    }
    public function getState(): GameState{
        return $this->data["state"];
    }
    public function getPlayer(): Player{
        return $this->data["player"];
    }
    public function getMarket(): Market{
        return $this->data["market"];
    }
    public function getLevel(): Levels
    {
        return $this->data["level"];
    }
    public function getCombat(): Combat
    {
        return $this->data["combat"];
    }

    // Logics
    public function changeState(GameState $state): void{
        match($state){
            GameState::IDLE => $this->data["state"] = GameState::IDLE,
            GameState::COMBAT => $this->data["state"] = GameState::COMBAT,
            GameState::INVENTORY => $this->data["state"] = GameState::INVENTORY,
            GameState::MARKET => $this->data["state"] = GameState::MARKET,
            GameState::OVER => $this->data["state"] = GameState::OVER,
            GameState::WIN => $this->data["state"] = GameState::WIN,
            default => $this->data["state"] = GameState::NOT_STARTED
        };
    }

    public function definePlayer(string $name, string $className): void{
        //$this->data["player"] = new Player($name, $className);

        $this->data["player"] = match (Archetypes::getArchetypeFromString($className)) {
            Archetypes::WARRIOR => new Warrior($name),
            Archetypes::MAGE => new Mage($name),
            Archetypes::PRIEST => new Priest($name)
        };;
        $this->changeState(GameState::IDLE);
    }

    public function setLevel(Levels $level): void
    {
        $this->data["level"] = $level;
    }

    public function newCombat(): void{
        $this->changeState(GameState::COMBAT);
        $this->data["combat"] = new Combat($this->getLevel(), $this->getPlayer());
    }

    public function combatTurn(string $action, string|null $enemyIndex=null):void {
        $combat = $this->getCombat();
        // Run the turn
        $combat->turn(CombatActions::getCombatActionFromString($action), $enemyIndex);

        // Update depending on combat state
        if($combat->isOver){

            // Change le leveling en fonction du win
            if($this->data["combat"]->player->isAlive()){
                $this->getPlayer()->levelUp(1);
            }else{
                $this->getPlayer()->levelUp(0.5);
            }

            // Set le niveau global du jeu en fonction du niveau du joueur
            switch(LevelRange::getRangeFromLevel($this->data["combat"]->player->level)){
                case LevelRange::Low:
                    $this->setLevel(Levels::OVERWORLD);
                    break;
                case LevelRange::Med:
                    $this->setLevel(Levels::MISTS);
                    break;
                case LevelRange::High:
                    $this->setLevel(Levels::CAVE);
                    break;
            }
            // Si le level du joueur est 100 passage dans les enferts
            if($this->data["player"]->level == 100){
                $this->setLevel(Levels::HELL);
            }
            $this->changeState(GameState::IDLE);
        }
    }
}
