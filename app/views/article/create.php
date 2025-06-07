<?php $viewPath = __FILE__; ?>
<h2>Přidat nový článek</h2>

<form method="post">
    <label>Název článku:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Obsah:</label><br>
    <textarea name="content" rows="10" cols="80" required></textarea><br><br>

    <button type="submit">Publikovat</button>
</form>
