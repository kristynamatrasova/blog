<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <title>Bioinformatický blog</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>
<body>

<header class="top-bar">
  <div class="container">
    <div class="logo">
      <a href="<?= BASE_URL ?>index.php">
        <img src="<?= BASE_URL ?>img/logo.png" alt="Logo" class="logo-img">
        <span class="logo-text">Bioinformatický blog</span>
      </a>
    </div>

    <nav class="main-nav">
      <ul>
        <li><a href="<?= BASE_URL ?>index.php?url=article/index">Domů</a></li>
        <?php if (isset($_SESSION['user'])): ?>
          <li><a href="<?= BASE_URL ?>index.php?url=article/create">Přidat článek</a></li>
          <li><a href="<?= BASE_URL ?>index.php?url=auth/logout">Odhlásit se (<?= htmlspecialchars($_SESSION['user']['username']) ?>)</a></li>
        <?php else: ?>
          <li><a href="<?= BASE_URL ?>index.php?url=auth/login">Přihlásit se</a></li>
          <li><a href="<?= BASE_URL ?>index.php?url=auth/register">Registrovat</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</header>

<div class="layout">
  <aside class="sidebar">
  <h3>Menu</h3>
  <ul>
    <li><a href="<?= BASE_URL ?>index.php?url=article/index">Všechny příspěvky</a></li>
    <?php if (isset($_SESSION['user'])): ?>
      <li><a href="<?= BASE_URL ?>index.php?url=user/profile">Můj profil</a></li>
      <li><a href="<?= BASE_URL ?>index.php?url=user/myPosts">Moje příspěvky</a></li>
      <li><a href="<?= BASE_URL ?>index.php?url=user/myComments">Moje komentáře</a></li>
    <?php endif; ?>
  </ul>
</aside>


  <main class="main-content">
    <?php require $viewPath; ?>
  </main>
</div>

<footer>
  <p>&copy; <?= date('Y') ?> Bioinformatický blog – všechna práva vyhrazena</p>
</footer>

</body>
</html>
