<?php $viewPath = __FILE__; ?>
<div class="form-box">
    <h2>Registrace</h2>

    <form method="post">
        <label for="username">Uživatelské jméno</label>
        <input type="text" name="username" id="username" required>

        <label for="email">E-mail (nepovinné)</label>
        <input type="email" name="email" id="email">

        <label for="password">Heslo</label>
        <input type="password" name="password" id="password" required>

        <label for="confirm">Potvrď heslo</label>
        <input type="password" name="confirm" id="confirm" required>

        <button type="submit">Registrovat</button>
    </form>
</div>
