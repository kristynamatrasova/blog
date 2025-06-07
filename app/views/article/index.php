<?php $viewPath = __FILE__; ?>
<h1>Nejnovější příspěvky</h1>

<?php foreach ($articles as $article): ?>
    <article style="margin-bottom: 30px;">
        <h2>
            <a href="/blog/public/index.php?url=article/detail/<?= $article['id'] ?>">
                <?= htmlspecialchars($article['title']) ?>
            </a>
        </h2>
        <p><small>Autor: <?= htmlspecialchars($article['username']) ?> | <?= $article['created_at'] ?></small></p>
    </article>
<?php endforeach; ?>
