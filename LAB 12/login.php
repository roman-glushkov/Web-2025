<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Вход</title>
  <link rel="stylesheet" href="static/styles/menu_style.css" />
  <link rel="stylesheet" href="static/styles/login_style.css" />
</head>
<body class="page">
  <div class="page__container">
    <header class="header">
      <img src="static/images/men.png" alt="Иллюстрация" class="header__image" />
      <h1 class="header__title">Войти</h1>
    </header>
    <form class="form" id="loginForm">
      <div class="form__field">
        <label class="form__label">Электропочта</label>
        <input type="email" class="form__input" id="email" required />
        <p class="form__hint">Введите электропочту в формате *****@***.**</p>
      </div>
      <div class="form__field">
        <label class="form__label">Пароль</label>
        <input type="password" class="form__input" id="password" required />
        <button type="button" class="form__toggle-password">
          <img src="static/images/oko.png" alt="Показать пароль" class="form__toggle-icon" />
        </button>
      </div>
      <button type="submit" class="form__submit">Продолжить</button>
    </form>
  </div>
  <script src="static/scripts/login.js"></script>
</body>
</html>