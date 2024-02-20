<?php

namespace Rpg;

class Renderer{

    public ?array $views;

    public function __construct(){
        // Fetch all my view
        $raw_views = scandir("./views");

        // loop throw all the views
        foreach($raw_views as $fp){
            if(View::isValidViewName($fp)){
                $exploded_fn = explode(".", $fp);
                // Naming convention : viewname.gamestep.view.php => [name, step, view, php]
                $this->views[] = new View($exploded_fn[0], intval($exploded_fn[1]), "views/$fp");
            }
        }
    }
    
    // Loop throw all View in $views and return it path if the gameState match 
    public function render(?int $gameState): string{
        foreach($this->views as $view){
            if($view->game_state === $gameState){
                return $view->path;
            }
        }
        return "views/default.view.php";   
    }
}

class View{

    public string $name;
    public int $game_state;
    public string $path;

    public function __construct(string $name,int $game_state,string $path){
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
