<form method="POST">
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
  <input type="hidden" name="form" value="class-selector">
  <button type="submit" class="btn btn-primary">Valider</button>
</form>
