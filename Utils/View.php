<?php

namespace Rpg\Utils;

use Rpg\Enums\GAME_STATE;

class View{

    public string $name;
    public GAME_STATE $game_state;
    public string $path;

    public function __construct(string $name,GAME_STATE $game_state,string $path){
        $this->name = $name;
        $this->game_state = $game_state;
        $this->path = $path;
    }

    // return true if the view file name is a real game view
    static function isValidViewName(string $fn): bool{
        return (
            file_exists("./views/$fn")
            && $fn != "."
            && $fn != ".."
            && $fn != "game.view.php"
            && $fn != "default.view.php"
        );
    }
}
