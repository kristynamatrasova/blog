<?php $viewPath = __FILE__; ?>
<h2>Upravit příspěvek</h2>

<form method="post">
    <label>Nadpis příspěvku:</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($article['title']) ?>" required><br><br>

    <label>Obsah:</label><br>
    <textarea name="content" rows="10" cols="80" required><?= htmlspecialchars($article['content']) ?></textarea><br><br>

    <button type="submit">Uložit změny</button>
</form>
