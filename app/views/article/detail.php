<?php $viewPath = __FILE__; ?>
<article>
    <h2><?= htmlspecialchars($article['title']) ?></h2>
    <p><small>Autor: <?= htmlspecialchars($article['username']) ?> | <?= $article['created_at'] ?></small></p>
    <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>

    <?php if (isset($_SESSION['user']) && ($_SESSION['user']['id'] === $article['user_id'] || $_SESSION['user']['role'] === 'admin')): ?>
        <p>
            <a href="/blog/public/index.php?url=article/edit/<?= $article['id'] ?>">🖊️ Upravit</a> |
            <a href="/blog/public/index.php?url=article/delete/<?= $article['id'] ?>" onclick="return confirm('Opravdu smazat?')">❌ Smazat</a>
        </p>
    <?php endif; ?>
</article>

<hr>
<h3>Komentáře</h3>

<?php
$comments = Comment::findByArticle($article['id']);
foreach ($comments as $comment): ?>
    <div style="margin-bottom: 15px;">
        <strong><?= htmlspecialchars($comment['username']) ?></strong> napsal(a):<br>
        <?= nl2br(htmlspecialchars($comment['content'])) ?><br>
        <small><?= $comment['created_at'] ?></small>
    </div>
<?php endforeach; ?>

<?php if (isset($_SESSION['user'])): ?>
    <form method="post" action="/blog/public/index.php?url=comment/create/<?= $article['id'] ?>">
        <textarea name="content" rows="5" cols="80" placeholder="Napiš komentář..." required></textarea><br>
        <button type="submit">Přidat komentář</button>
    </form>
<?php else: ?>
    <p><a href="/blog/public/index.php?url=auth/login">Přihlas se</a>, abys mohl komentovat.</p>
<?php endif; ?>
