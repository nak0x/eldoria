<?php

namespace Rpg;

use JetBrains\PhpStorm\NoReturn;
use Rpg\Models\Player;
use Rpg\Utils\Action;
use Rpg\Utils\Renderer;
use Rpg\Utils\GameContext;

class GameEngine {
    private SessionStorage $storage;
    private Renderer $render;
    private GameContext $gameContext;
    public ?Player $player;
    public array $logs;

    public function __construct(){
        // Initialisation des composant de base
        $this->storage = new SessionStorage();
        $this->render = new Renderer();
        $this->gameContext = new GameContext();;
    }

    // Accède à l'objet storage afin d'alimenter les attributs dans notre moteur
    private function retrieveDataFromSession() : void {
        $this->logs = $this->storage->get('logs') ?: [];
        $this->gameContext = $this->storage->get('GameContext') ?: new GameContext();
    }

    // Ajoute un message à la boîte de log en bas à droite
    private function logAction(mixed $action) : void {
        $message = date("H:i:s");
        if(gettype($action) == "string"){
            $message = $message . " : " . $action;
        }else{
            $message = $message . var_export($action, true);
        }
        $this->logs[] = $message;
        $this->storage->save('logs', $this->logs);
    }

    // Réinitialise le storage, associé au bouton en bas à droite
    private function resetStorage() : void {
        $this->storage->reset();
    }

    // Méthode appelée lorsqu'on fait soumet un formulaire,
    // utilise le champ caché "form" afin de rediriger sur la méthode associée
    #[NoReturn] private function handlePost(array $formData): void
    {
        $this->logAction("Peforming : " . $formData['form']);
        // Check if the action is a reset, if so perfom the reste othewise, call the action handler.
        if($formData['form'] == "reset-storage"){
            $this->resetStorage();
        }else{
            // Utilisation du gestionnaire d'actions pour call une action type
            Action::handleAction($formData['form'],$formData, $this->gameContext);
            // GameContext save
            $this->storage->save("GameContext", $this->gameContext);
        }
        // Redirection sur la page par défaut
        header('Location: /');
        exit;
    }

    // La fonction render fait un require du rendu à faire en fonction de l'état du jeu
    private function render(): void {
        require $this->render->render($this->gameContext->getState());
    }

    public function run() : void {
        // Récupération des données
        $this->retrieveDataFromSession();

        // Traitement des formulaires
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->handlePost($_POST);
        } else {
            $this->render();
        }
    }
}
