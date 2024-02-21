<?php

namespace Rpg\Utils;

use Rpg\Models\Player;
use Rpg\Models\Enemy;
use Rpg\Models\Market;
use Rpg\Enums\GAME_STATE;

class GameContext{
    private array $data = [
        "player" => null,
        "enemies" => [],
        "market" => null,
        "state" => GAME_STATE::NOT_STARTED
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
    public function getState(): GAME_STATE{
        return $this->data["state"];
    }
    public function getPlayer(): Player{
        return $this->data["player"];
    }
    public function getMarket(): Market{
        return $this->data["market"];
    }

    // Logics
    public function addEnemy(Enemy $enemy): void{
        $this->data["enemies"][] += $enemy;
    }
    public function changeState(GAME_STATE $state): void{
        match($state){
            GAME_STATE::NOT_STARTED => $this->data["state"] = GAME_STATE::NOT_STARTED,
            GAME_STATE::IDLE => $this->data["state"] = GAME_STATE::IDLE,
            GAME_STATE::COMBAT => $this->data["state"] = GAME_STATE::COMBAT,
            GAME_STATE::INVENTORY => $this->data["state"] = GAME_STATE::INVENTORY,
            GAME_STATE::MARKET => $this->data["state"] = GAME_STATE::MARKET,
            GAME_STATE::OVER => $this->data["state"] = GAME_STATE::OVER,
            GAME_STATE::WIN => $this->data["state"] = GAME_STATE::WIN
        };
    }
    public function definePlayer(string $name, string $className): void{
        $this->data["player"] = new Player($name, $className);
    }

}