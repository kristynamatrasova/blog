<!DOCTYPE html>
<html lang="cs">
<head>
   <!-- Základní meta tag pro správné kódování -->
  <meta charset="UTF-8">
  <title>Bioinformatický blog</title>
  <!-- Načtení hlavního CSS souboru, dynamicky pomocí BASE_URL -->
  <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>
<body>

<header class="top-bar"> <!-- hlavní hlavička -->
  <div class="container top-bar-inner"> <!-- zarovnání obsahu -->
    <div class="logo">
      <a href="<?= BASE_URL ?>index.php">
        <img src="<?= BASE_URL ?>img/logo.png" alt="Logo" class="logo-img">
        <span class="logo-text">Bioinformatický blog</span>
      </a>
    </div>

    <nav class="main-nav">
  <ul class="nav-right">
    <li><a href="<?= BASE_URL ?>index.php?url=article/index">Domů</a></li>
    <?php if (isset($_SESSION['user'])): ?> <!-- pokud je přihlášen zobrazí se rozšířená navigace -->
      <li><a href="<?= BASE_URL ?>index.php?url=article/create">Přidat příspěvek</a></li>
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

<!-- sidebar -->
  <aside class="sidebar">
  <h3>Menu</h3>
  <ul>
    <li><a href="<?= BASE_URL ?>index.php?url=article/userPosts">Všechny příspěvky</a></li>
    <?php if (isset($_SESSION['user'])): ?> <!-- pokud přihlášen, rozšířené menu -->
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
