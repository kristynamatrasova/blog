<?php $viewPath = __FILE__; ?>
<h2>Můj profil</h2>
<p><strong>Uživatelské jméno:</strong> <?= htmlspecialchars($user['username']) ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
<p><strong>Role:</strong> <?= htmlspecialchars($user['role']) ?></p>

