document.addEventListener("DOMContentLoaded", function () {
  const loginForm = document.getElementById("loginForm");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const togglePassword = document.querySelector(".form__toggle-password");

  loginForm.addEventListener("submit", async function (e) {
    e.preventDefault();
    emailInput.classList.remove("input-error");
    passwordInput.classList.remove("input-error");

    try {
      const response = await fetch("credentials.json");
      const users = await response.json();

      const user = users.find(
        (u) =>
          u.email === emailInput.value && u.password === passwordInput.value
      );

      if (!user) {
        emailInput.classList.add("input-error");
        passwordInput.classList.add("input-error");
        return;
      }

      window.location.href = "home.php";
    } catch (error) {
      console.error("Ошибка:", error);
      emailInput.classList.add("input-error");
      passwordInput.classList.add("input-error");
    }
  });
  togglePassword.addEventListener("click", function () {
    const icon = this.querySelector("img");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      icon.src = "static/images/oko_open.png";
    } else {
      passwordInput.type = "password";
      icon.src = "static/images/oko.png";
    }
  });
});
