<?php

namespace Rpg\Enums;

use Rpg\Models\Enemies\Boss\Throngrim;
use Rpg\Models\Enemies\Enemy;
use Rpg\Models\Enemies\Low\Blob;
use Rpg\Models\Enemies\Low\Goblin;
use Rpg\Models\Enemies\Low\Rat;
use Rpg\Models\Enemies\Mid\Guard;
use Rpg\Models\Enemies\Mid\Master;
use Rpg\Models\Enemies\Mid\Vampire;

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

    public static function getEnemiesFromLevel(Levels $level){
        return match($level){
            self::OVERWORLD => [
                "low" => Blob::ENNEMY_CODE,
                "med" => Guard::ENNEMY_CODE,
                "boss" => Throngrim::ENNEMY_CODE
            ],
            self::MISTS => [
                "low" => Rat::ENNEMY_CODE,
                "med" => Master::ENNEMY_CODE,
                "boss" => Throngrim::ENNEMY_CODE
            ],
            self::CAVE => [
                "low" => Goblin::ENNEMY_CODE,
                "med" => Vampire::ENNEMY_CODE,
                "boos" => Throngrim::ENNEMY_CODE
            ],
            self::HELL => [
                "low" => Rat::ENNEMY_CODE,
                "med" => Vampire::ENNEMY_CODE,
                "boss" => Throngrim::ENNEMY_CODE
            ],

        };
    }
}
