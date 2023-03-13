// attente du chargement du DOM
document.addEventListener("DOMContentLoaded", function () {
  // création des variables
  let validation = false;
  let msg = document.querySelector("#msg");
  // partie login
  const loginSection = document.querySelector("#login");
  const loginForm = document.querySelector("#loginForm");
  let loginInput = loginForm.querySelector(".login");
  let passwordInput = loginForm.querySelector(".password");
  const loginButton = loginForm.querySelector("#btnModifLogin");
  // ancien login
  let user = loginInput.value;

  // partie password
  const passwordSection = document.querySelector("#password");
  const passwordForm = document.querySelector("#passwordForm");
  let oldPasswordInput = passwordForm.querySelector("#oldPassword");
  let newPasswordInput = passwordForm.querySelector("#newPassword");
  let newPasswordConfirmInput = passwordForm.querySelector("#newPassword2");
  const passwordButton = passwordForm.querySelector("#btnModifPass");

  /////////////////////////////////////
  // Function for login and password //
  ////////////////////////////////////

  // function to check if the login is valid
  function checkLogin() {
    let loginValue = loginInput.value;
    if (loginValue == "") {
      loginInput.nextElementSibling.innerHTML = "Veuillez remplir le login";
      // change border color and background
      loginInput.style.borderColor = "red";
      loginInput.style.backgroundColor = "#fde2e2";
      // loginInput.style.backgroundColor = "#ff000063";
      validation = false;
    } else if (loginValue == user) {
      loginInput.nextElementSibling.innerHTML = "";
      // change border color and background
      loginInput.style.borderColor = "initial";
      loginInput.style.backgroundColor = "fafafa";
      validation = false;
    } else {
      loginInput.nextElementSibling.innerHTML = "";
      // change border color and background
      loginInput.style.borderColor = "initial";
      let dataLogin = new FormData();
      dataLogin.append("verifLogin", loginValue);
      fetch("assets/php/verifProfil.php", {
        method: "POST",
        body: dataLogin,
      })
        .then((response) => response.text())
        .then((data) => {
          data = data.trim();
          if (data == "indispo") {
            loginInput.nextElementSibling.innerHTML = "Login indisponible";
            // change border color and background
            loginInput.style.borderColor = "red";
            loginInput.style.backgroundColor = "#fde2e2";
            validation = false;
          } else if (data == "dispo") {
            loginInput.nextElementSibling.innerHTML = "Login disponible";
            // change border color and background
            loginInput.style.borderColor = "initial";
            loginInput.style.backgroundColor = "fafafa";
            validation = true;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }
  }

  // function to check if the password is valid
  function checkPassword(pass) {
    let passwordValue = pass.value;
    if (passwordValue == "") {
      pass.nextElementSibling.innerHTML = "Veuillez remplir le mot de passe";
      // change border color and background
      pass.style.borderColor = "red";
      pass.style.backgroundColor = "#fde2e2";
      validation = false;
    } else {
      pass.nextElementSibling.innerHTML = "";
      // change border color and background
      pass.style.borderColor = "initial";
      pass.style.backgroundColor = "#fafafa";
      validation = true;
    }
  }

  // function to check if the new password confirm is valid
  function checkNewPasswordConfirm() {
    let newPasswordValue = newPasswordInput.value;
    let newPasswordConfirmValue = newPasswordConfirmInput.value;
    if (newPasswordConfirmValue == "") {
      newPasswordConfirmInput.nextElementSibling.innerHTML =
        "Veuillez remplir le mot de passe";
      // change border color and background
      newPasswordConfirmInput.style.borderColor = "red";
      newPasswordConfirmInput.style.backgroundColor = "#fde2e2";
      validation = false;
    } else if (newPasswordConfirmValue != newPasswordValue) {
      newPasswordConfirmInput.nextElementSibling.innerHTML =
        "Les mots de passe ne correspondent pas";
      // change border color and background
      newPasswordConfirmInput.style.borderColor = "red";
      newPasswordConfirmInput.style.backgroundColor = "#fde2e2";
      validation = false;
    } else {
      newPasswordConfirmInput.nextElementSibling.innerHTML = "";
      // change border color and background
      newPasswordConfirmInput.style.borderColor = "initial";
      newPasswordConfirmInput.style.backgroundColor = "#fafafa";
      validation = true;
    }
  }

  /////////////////////////////////
  // event for login             //
  /////////////////////////////////
  // login
  loginInput.addEventListener("blur", checkLogin);

  // password
  passwordInput.addEventListener("blur", function (e) {
    checkPassword(passwordInput);
  });

  // login form
  loginButton.addEventListener("click", function (e) {
    e.preventDefault();
    if (validation) {
      let data = new FormData(loginForm);
      data.append("oldLogin", user);
      data.append("modifLogin", "ok");
      fetch("assets/php/verifProfil.php", {
        method: "POST",
        body: data,
      })
        .then((response) => response.text())
        .then((response) => {
          response = response.trim();
          //   console.log(response);
          if (response === "ok") {
            loginButton.nextElementSibling.innerHTML = "Modification réussie!";
            loginInput.focus();
            // nouveau login qui remplace l'ancien
            user = loginInput.value;
            msg.textContent = user;
            // effaçage du form et des messages
            loginForm.reset();
            loginInput.nextElementSibling.innerHTML = "";
            passwordInput.nextElementSibling.innerHTML = "";
            // change border color and background
            loginInput.style.borderColor = "initial";
            passwordInput.style.borderColor = "initial";
            loginInput.style.backgroundColor = "fafafa";
            passwordInput.style.backgroundColor = "fafafa";
            validation = false;

            // mise en place du nouveau login
            loginInput.value = user;
          } else if (response === "incorrect") {
            passwordInput.nextElementSibling.innerHTML =
              "Mot de passe incorrect";
            passwordInput.style.borderColor = "red";
            passwordInput.style.backgroundColor = "#fde2e2";
          }
        })
        .catch((error) => console.log(error));
    }
  });

  /////////////////////////////////
  // event for password          //
  /////////////////////////////////

  // old password
  oldPasswordInput.addEventListener("blur", function (e) {
    checkPassword(oldPasswordInput);
  });

  // new password
  newPasswordInput.addEventListener("blur", function (e) {
    checkPassword(newPasswordInput);
  });

  // new password confirm
  newPasswordConfirmInput.addEventListener("keyup", checkNewPasswordConfirm);

  // password form
  passwordButton.addEventListener("click", function (e) {
    e.preventDefault();
    if (validation) {
      let data = new FormData(passwordForm);
      data.append("modifPass", "ok");
      fetch("assets/php/verifProfil.php", {
        method: "POST",
        body: data,
      })
        .then((response) => response.text())
        .then((response) => {
          response = response.trim();
          // console.log(response);
          if (response === "ok") {
            passwordButton.nextElementSibling.innerHTML =
              "Modification réussie!";
            // effaçage du form et des messages
            passwordForm.reset();
            oldPasswordInput.nextElementSibling.innerHTML = "";
            newPasswordInput.nextElementSibling.innerHTML = "";
            newPasswordConfirmInput.nextElementSibling.innerHTML = "";
          } else if (response === "incorrect") {
            oldPasswordInput.nextElementSibling.innerHTML =
              "Mot de passe incorrect";
            oldPasswordInput.style.borderColor = "red";
            oldPasswordInput.style.backgroundColor = "#fde2e2";
          }
        })
        .catch((error) => console.log(error));
    }
  });
});
