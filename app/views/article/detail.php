<?php $viewPath = __FILE__; ?>

<!-- Zobrazení jednoho článku -->
<div class="article-full">
    <h2><?= htmlspecialchars($article['title']) ?></h2>
    <p><small>Autor: <?= htmlspecialchars($article['username']) ?> | <?= $article['created_at'] ?></small></p>
    <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>

    <?php if (isset($_SESSION['user']) && ($_SESSION['user']['id'] === $article['user_id'] || $_SESSION['user']['role'] === 'admin')): ?>
        <p>
            <a href="<?= BASE_URL ?>index.php?url=article/edit/<?= $article['id'] ?>">🖊️ Upravit</a> |
            <a href="<?= BASE_URL ?>index.php?url=article/delete/<?= $article['id'] ?>" onclick="return confirm('Opravdu smazat tento článek?')">❌ Smazat</a>
        </p>
    <?php endif; ?>
</div>

<hr>

<!-- Komentáře -->
<h3>Komentáře</h3>

<?php
$comments = Comment::findByArticle($article['id']);
foreach ($comments as $comment): ?>
    <div class="comment-box">
        <strong><?= htmlspecialchars($comment['username']) ?></strong><br>
        <?= nl2br(htmlspecialchars($comment['content'])) ?><br>
        <small><?= $comment['created_at'] ?></small>

        <?php if (
            isset($_SESSION['user']) &&
            ($_SESSION['user']['id'] === $comment['user_id'] || $_SESSION['user']['role'] === 'admin')
        ): ?>
            <p style="margin-top: 5px;">
                <a href="<?= BASE_URL ?>index.php?url=comment/edit/<?= $comment['id'] ?>">🖊️ Upravit</a> |
                <a href="<?= BASE_URL ?>index.php?url=comment/delete/<?= $comment['id'] ?>" onclick="return confirm('Opravdu smazat komentář?')">❌ Smazat</a>
            </p>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<!-- Formulář pro přidání komentáře -->
<?php if (isset($_SESSION['user'])): ?>
    <div class="form-box" style="margin-top: 30px;">
        <h4>Napiš komentář</h4>
        <form method="post" action="<?= BASE_URL ?>index.php?url=comment/create/<?= $article['id'] ?>">
            <textarea name="content" rows="5" placeholder="Napiš komentář..." required></textarea>
            <button type="submit">Přidat komentář</button>
        </form>
    </div>
<?php else: ?>
    <p><a href="<?= BASE_URL ?>index.php?url=auth/login">Přihlas se</a>, abys mohl komentovat.</p>
<?php endif; ?>
