<?php

namespace Rpg\Enums;

enum Levels: int
{
    case OVERWORLD = 1;
    case MISTS = 2;
    case CAVE = 3;
    case HELL = 4;

    public static function getLevelFromInt(int $query): Levels
    {
        return match($query) {
            Levels::OVERWORLD->value => Levels::OVERWORLD,
            Levels::MISTS->value => Levels::MISTS,
            Levels::CAVE->value => Levels::CAVE,
            Levels::HELL->value => Levels::HELL
        };
    }
}