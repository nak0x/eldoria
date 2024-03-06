
<div class="d-flex flex-column justify-content-center align-items-center" style="background-color:#fff7; backdrop-filter: blur(15px); height: 80vh; width: 100%;">
    <h1>Bravo tu a fini le jeu</h1>
    <form method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir reprendre de 0 ?')">
        <div class="m-3">
            <input type="hidden" name="form" value="reset-storage"/>
            <button type="submit" class="btn btn-danger">Recomencer</button>
        </div>
    </form>
</div>
