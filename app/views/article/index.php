<?php $viewPath = __FILE__; ?>
<h1>Bioinformatický portál</h1>

<!-- Seznam statických článků  -->
<section class="static-list">
  <h2>Články</h2>
  <article>
    <h3><a href="<?= BASE_URL ?>index.php?url=page/stat1">Úvod do bioinformatiky</a></h3>
    <p>Základní přehled o tom, co je bioinformatika a proč je důležitá...</p>
  </article>

  <article>
    <h3><a href="<?= BASE_URL ?>index.php?url=page/stat2">Sekvenování DNA</a></h3>
    <p>Jak se získávají genetická data a jak je bioinformatika zpracovává...</p>
  </article>

  <article>
    <h3><a href="<?= BASE_URL ?>index.php?url=page/stat3">Proteinová struktura</a></h3>
    <p>Přehled přístupů k predikci a modelování proteinů...</p>
  </article>

  <article>
    <h3><a href="<?= BASE_URL ?>index.php?url=page/stat4">Nástroje v bioinformatice</a></h3>
    <p>Přehled běžně používaných nástrojů a databází...</p>
  </article>
</section>

<hr>


<!-- nejnovější příspěvky -->
<h2>Nejnovější příspěvky</h2>

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
