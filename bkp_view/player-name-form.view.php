<p class="lead">
    Soyez la bienvenue sur Gab Quest, entrez le nom de votre personnage pour commencer l'aventure.
</p>

<form method="POST">
    <div class="mb-3">
        <label class="form-label">Nom du personnage</label>
        <input type="text" name="player-name" class="form-control" />
    </div>
    
    <div class="form-check">
        <input 
          id="warrior"
          type="radio"
          name="class"
          value="warrior"
          class="form-check-input">
        <label
          class="form-check-label"
          for="warrior">
            Guerrier
        </label>
      </div>
      <div class="form-check">
        <input 
          id="mage"
          type="radio"
          name="class"
          value="mage"
          class="form-check-input">
        <label
          class="form-check-label"
          for="mage">
            Mage
        </label>
      </div>
      <div class="form-check">
        <input 
          id="priest"
          type="radio"
          name="class"
          value="priest"
          class="form-check-input">
        <label
          class="form-check-label"
          for="priest">
            Prêtre
        </label>
      </div>

    <input type="hidden" name="form" value="player-creation"/>

    <button type="submit" class="btn btn-primary">Créer</button>
</form>
