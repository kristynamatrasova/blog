<?php $viewPath = __FILE__; ?>
<h1>Všechny příspěvky od uživatelů</h1>

<?php if (empty($articles)): ?>
    <p>Žádné příspěvky zatím nebyly přidány.</p>
<?php else: ?>
    <?php foreach ($articles as $article): ?>
        <div class="article-preview">
            <h3>
                <a href="<?= BASE_URL ?>index.php?url=article/detail/<?= $article['id'] ?>">
                    <?= htmlspecialchars($article['title']) ?>
                </a>
            </h3>
            <p><small>Autor: <?= htmlspecialchars($article['username']) ?> | <?= $article['created_at'] ?></small></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
