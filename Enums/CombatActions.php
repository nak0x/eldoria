<?php

namespace Rpg\Enums;

use Rpg\Models\Combat;

enum CombatActions : int
{
    case PUNCH = 0;
    case HEAL = 1;
    case BUFF = 2;
    case SPELL = 3;
    case ULTI = 4;

    public static function getCombatActionFromString(string $query): CombatActions
    {
        return match (strtoupper($query)){
            CombatActions::PUNCH->name => CombatActions::PUNCH,
            CombatActions::HEAL->name => CombatActions::HEAL,
            CombatActions::BUFF->name => CombatActions::BUFF,
            CombatActions::SPELL->name => CombatActions::SPELL,
            CombatActions::ULTI->name => CombatActions::ULTI
        };
    }
}