<?php

namespace Rpg\Enums;

enum Archetypes: string
{
    case WARRIOR = "warrior";
    case MAGE = "mage";
    case PRIEST = "priest";

    public static function getArchetypeFromString(string $query): Archetypes{
        return match ($query){
            Archetypes::WARRIOR->value => Archetypes::WARRIOR,
            Archetypes::MAGE->value => Archetypes::MAGE,
            Archetypes::PRIEST->value => Archetypes::PRIEST
        };
    }

    public static function getImagePath(Archetypes $query): string{
        return match($query){
            Archetypes::WARRIOR => 'warrior.jpg',
            Archetypes::MAGE => 'mage.jpg',
            Archetypes::PRIEST => 'priest.jpg'
        };
    }
}