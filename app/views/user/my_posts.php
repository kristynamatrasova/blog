<?php $viewPath = __FILE__; ?>
<h2>Moje příspěvky</h2>

<?php foreach ($articles as $article): ?>
    <div>
        <h3><a href="<?= BASE_URL ?>index.php?url=article/detail/<?= $article['id'] ?>">
            <?= htmlspecialchars($article['title']) ?></a></h3>
        <small><?= $article['created_at'] ?></small>
    </div>
<?php endforeach; ?>
