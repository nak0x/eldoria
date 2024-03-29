<?php

namespace Rpg\Utils;

use Rpg\Enums\GameState;

abstract class Action {
    static function handleAction(string $actionName,array &$formData, GameContext &$gameContext): void
    {
        foreach (self::getActionList() as $actionKey => $action) {
            if ($actionKey == $actionName) {
                $action($formData, $gameContext);
            }
        }

        // Free memory space at right CPU cycle
        unset($formData);
    }

    static function getActionList(): array{
        return [
            "player-creation" => function(array &$formData, GameContext &$gameContext): void{
                $gameContext->definePlayer($formData["name"], $formData["class"]);
            },
            "goto-combat" => function(array &$formData, GameContext &$gameContext): void{
                $gameContext->newCombat();
            },
            "combat-action" => function(array &$formData, GameContext &$gameContext): void{
                if($gameContext->getState() == GameState::COMBAT){
                    $gameContext->combatTurn($formData["action"], $formData["enemy"]);
                }
            }
        ];
    }
}