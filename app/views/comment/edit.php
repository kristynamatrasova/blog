<?php $viewPath = __FILE__; ?>
<h2>Upravit komentář</h2>

<form method="post">
    <textarea name="content" rows="6" cols="80" required><?= htmlspecialchars($comment['content']) ?></textarea><br>
    <button type="submit">Uložit změny</button>
</form>

<p><a href="<?= BASE_URL ?>index.php?url=article/detail/<?= $comment['article_id'] ?>">Zpět na článek</a></p>
