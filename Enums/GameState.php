<?php

namespace Rpg\Enums;
enum GameState: int
{
    case NOT_STARTED = 0;
    case IDLE = 1;
    case COMBAT = 2;
    case INVENTORY = 3;
    case MARKET = 4;
    case OVER = 5;
    case WIN = 6;

    public static function getStateFromInt(int $query): GameState
    {
        return match($query){
            self::NOT_STARTED->value => self::NOT_STARTED,
            self::IDLE->value => self::IDLE,
            self::COMBAT->value => self::COMBAT,
            self::INVENTORY->value => self::INVENTORY,
            self::MARKET->value => self::MARKET,
            self::OVER->value => self::OVER,
            self::WIN->value => self::WIN
        };
    }
}