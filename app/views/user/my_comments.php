<?php $viewPath = __FILE__; ?>
<h2>Moje komentáře</h2>

<?php foreach ($comments as $comment): ?>
    <div>
        <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
        <small>
            K článku: <a href="<?= BASE_URL ?>index.php?url=article/detail/<?= $comment['article_id'] ?>">
                <?= htmlspecialchars($comment['title']) ?></a> |
            <?= $comment['created_at'] ?>
        </small>
        <hr>
    </div>
<?php endforeach; ?>
