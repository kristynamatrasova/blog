<?php $viewPath = __FILE__; ?> <!--pomocná proměnná (debug/logivání cesty k view) -->
<div class="form-box">
    <h2>Přidat nový článek</h2>

<!--Formulář pro vytvoření článku -->
    <form method="post">
        <label for="title">Název článku</label>
        <input type="text" name="title" id="title" required>

        <label for="content">Obsah</label>
        <textarea name="content" id="content" rows="10" required></textarea>

        <button type="submit">Publikovat</button>
    </form>
</div>
