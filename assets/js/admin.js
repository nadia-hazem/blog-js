document.addEventListener("DOMContentLoaded", function () {
  const currentUser = document.querySelector("#currentUser").textContent;
  const users = document.querySelector("#users");
  const articles = document.querySelector("#articles");

  const gestion = document.querySelector("#gestion");

  const articleSection = document.querySelector("#article");
  const commentairesSection = document.querySelector("#commentaires");

  // fonctions
  function showUsers() {
    gestion.innerHTML = "";
    articleSection.innerHTML = "";
    commentairesSection.innerHTML = "";
    //fetch
    fetch("assets/php/adminGestion.php?users")
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        // création d'un tableau
        const table = document.createElement("table");
        const tr = document.createElement("tr");
        const thLogin = document.createElement("th");
        const thDroit = document.createElement("th");
        const thGestion = document.createElement("th");
        // thGestion doit contenir 2 td
        thGestion.setAttribute("colspan", "2");

        thLogin.textContent = "Login";
        thDroit.textContent = "Rôle";
        thGestion.textContent = "Gestion";
        tr.appendChild(thLogin);
        tr.appendChild(thDroit);
        tr.appendChild(thGestion);
        table.appendChild(tr);
        // ajout d'une ligne pour chaque user
        data.forEach((user) => {
          const tr = document.createElement("tr");
          const tdLogin = document.createElement("td");
          const tdDroit = document.createElement("td");
          const tdDelete = document.createElement("td");
          const tdChangeDroit = document.createElement("td");
          const btnDelete = document.createElement("button");
          btnDelete.setAttribute("data-id", user.id);
          btnDelete.classList.add("btnDelete");
          btnDelete.textContent = "❌";
          tdDelete.appendChild(btnDelete);
          // création d'un select avec comme option user, mode et admin
          const select = document.createElement("select");
          select.setAttribute("name", "droit");
          select.setAttribute("id", "droit");
          select.setAttribute("data-id", user.id);
          select.classList.add("select");
          const optionUser = document.createElement("option");
          const optionMode = document.createElement("option");
          const optionAdmin = document.createElement("option");
          optionUser.setAttribute("value", "user");
          optionMode.setAttribute("value", "mode");
          optionAdmin.setAttribute("value", "admin");
          optionUser.textContent = "user";
          optionMode.textContent = "modérateur";
          optionAdmin.textContent = "admin";
          select.appendChild(optionUser);
          select.appendChild(optionMode);
          select.appendChild(optionAdmin);
          // input de type submit
          const input = document.createElement("input");
          input.setAttribute("type", "submit");
          input.setAttribute("value", "Changer");
          input.setAttribute("data-id", user.id);
          input.classList.add("changeDroit");
          tdChangeDroit.appendChild(select);
          tdChangeDroit.appendChild(input);
          // // //
          tdLogin.textContent = user.login;
          tdDroit.textContent = user.droit;
          tr.appendChild(tdLogin);
          tr.appendChild(tdDroit);
          // si l'utilisateur est connecté, ne met pas les td
          if (user.login != currentUser) {
            tr.appendChild(tdChangeDroit);
            tr.appendChild(tdDelete);
          } else {
            const td = document.createElement("td");
            td.setAttribute("colspan", "2");
            td.textContent = "Current user";
            tr.appendChild(td);
          }

          table.appendChild(tr);
        });
        gestion.appendChild(table);
      });
  }

  function deleteUser(id) {
    fetch("assets/php/adminGestion.php?deleteUser=" + id)
      .then((response) => response.text())
      .then((data) => {
        // trim
        data = data.trim();
        if (data == "ok") {
          showUsers();
        }
      })
      .catch((error) => console.log(error));
  }

  function changeDroit(id, droit) {
    fetch("assets/php/adminGestion.php?changeDroit=" + id + "&droit=" + droit)
      .then((response) => response.text())
      .then((data) => {
        // trim
        data = data.trim();
        if (data == "ok") {
          showUsers();
        }
      })
      .catch((error) => console.log(error));
  }

  function showArticles() {
    gestion.innerHTML = "";
    articleSection.innerHTML = "";
    commentairesSection.innerHTML = "";
    //fetch
    fetch("assets/php/adminGestion.php?articles")
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        // création d'un tableau
        const table = document.createElement("table");
        const tr = document.createElement("tr");
        const thTitre = document.createElement("th");
        const thAuteur = document.createElement("th");
        const thDate = document.createElement("th");
        const thGestion = document.createElement("th");
        // thGestion doit contenir 2 td
        thGestion.setAttribute("colspan", "2");

        thTitre.textContent = "Titre";
        thAuteur.textContent = "Auteur";
        thDate.textContent = "Date";
        thGestion.textContent = "Gestion";
        tr.appendChild(thTitre);
        tr.appendChild(thAuteur);
        tr.appendChild(thDate);
        tr.appendChild(thGestion);
        table.appendChild(tr);
        // ajout d'une ligne pour chaque user
        data.forEach((article) => {
          const tr = document.createElement("tr");
          const tdTitre = document.createElement("td");
          const tdAuteur = document.createElement("td");
          const tdDate = document.createElement("td");
          const tdGestion = document.createElement("td");
          tdGestion.setAttribute("colspan", "2");
          // bouton modifier Delete et commentaire
          const btnModif = document.createElement("button");
          btnModif.setAttribute("data-id", article.id);
          btnModif.classList.add("btnModifArticle");
          btnModif.textContent = "🖉";
          tdGestion.appendChild(btnModif);
          const btnDelete = document.createElement("button");
          btnDelete.setAttribute("data-id", article.id);
          btnDelete.classList.add("btnDeleteArticle");
          btnDelete.textContent = "🗑";
          tdGestion.appendChild(btnDelete);
          const btnComments = document.createElement("button");
          btnComments.setAttribute("data-id", data.id);
          btnComments.classList.add("btnComments");
          btnComments.textContent = "💬";
          tdGestion.appendChild(btnComments);
          // // //
          tdTitre.textContent = article.titre;
          tdAuteur.textContent = article.auteur;
          tdDate.textContent = article.date;
          tr.appendChild(tdTitre);
          tr.appendChild(tdAuteur);
          tr.appendChild(tdDate);
          tr.appendChild(tdGestion);
          table.appendChild(tr);
        });
        gestion.appendChild(table);
      });
  }

  function deleteArticle(id) {
    fetch("assets/php/adminGestion.php?deleteArticle=" + id)
      .then((response) => response.text())
      .then((data) => {
        // trim
        data = data.trim();
        if (data == "ok") {
          showArticles();
        }
      })
      .catch((error) => console.log(error));
  }

  function modifArticle(id) {
    fetch("assets/php/adminGestion.php?modifArticle=" + id)
      .then((response) => response.json())
      .then((data) => {
        articleSection.innerHTML = "";
        // création d'un formulaire
        const form = document.createElement("form");
        form.setAttribute("enctype", "multipart/form-data");
        // titre
        const labelTitre = document.createElement("label");
        labelTitre.setAttribute("for", "titre");
        labelTitre.textContent = "Titre";
        const inputTitre = document.createElement("input");
        inputTitre.setAttribute("type", "text");
        inputTitre.setAttribute("name", "titre");
        inputTitre.setAttribute("id", "titre");
        inputTitre.setAttribute("value", data.titre);
        inputTitre.setAttribute("required", "");
        // Description
        const labelDescription = document.createElement("label");
        labelDescription.setAttribute("for", "description");
        labelDescription.textContent = "Description";
        const textareaDescription = document.createElement("textarea");
        textareaDescription.setAttribute("name", "description");
        textareaDescription.setAttribute("id", "description");
        textareaDescription.setAttribute("required", "");
        textareaDescription.textContent = data.description;
        // image
        const labelImage = document.createElement("label");
        labelImage.setAttribute("for", "image");
        labelImage.textContent = "Image";
        const inputImage = document.createElement("input");
        inputImage.setAttribute("type", "file");
        inputImage.setAttribute("name", "image");
        inputImage.setAttribute("id", "image");
        const imgDisplay = document.createElement("img");
        imgDisplay.setAttribute("src", "assets/uploads/" + data.image);
        imgDisplay.setAttribute("alt", data.titre);
        imgDisplay.style.width = "100%";
        const p = document.createElement("p");
        p.textContent = "Image actuelle";
        // bouton
        const btn = document.createElement("button");
        btn.setAttribute("type", "submit");
        btn.setAttribute("data-id", data.id);
        btn.classList.add("updateArticle");
        btn.textContent = "Modifier";
        // ajout des éléments
        form.appendChild(labelTitre);
        form.appendChild(inputTitre);
        form.appendChild(labelDescription);
        form.appendChild(textareaDescription);
        form.appendChild(labelImage);
        form.appendChild(inputImage);
        form.appendChild(btn);
        articleSection.appendChild(form);
        articleSection.appendChild(p);
        articleSection.appendChild(imgDisplay);
      });
  }

  function updateArticle(target, id) {
    const form = new FormData(target);
    // verif que les champs sont bien remplis
    if (form.get("titre") == "" || form.get("description") == "") {
      alert("Veuillez remplir tous les champs");
      return;
    } else {
      fetch("assets/php/adminGestion.php?updateArticle=" + id, {
        method: "POST",
        body: form,
      })
        .then((response) => response.text())
        .then((data) => {
          // trim
          data = data.trim();
          if (data == "ok") {
            showArticles();
            modifArticle(id);
          }
        })
        .catch((error) => console.log(error));
    }
  }

  // events
  // affichage des users
  users.addEventListener("click", function (e) {
    e.preventDefault();
    showUsers();
    // ajouter une bordure sur le lien cliqué
    users.classList.add("active");
    articles.classList.remove("active");
  });

  // suppression d'un utilisateur ou changer les droits
  gestion.addEventListener("click", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("btnDelete")) {
      const id = e.target.getAttribute("data-id");
      deleteUser(id);
    } else if (e.target.classList.contains("changeDroit")) {
      const id = e.target.getAttribute("data-id");
      const select = e.target.previousElementSibling;
      const droit = select.options[select.selectedIndex].value;
      changeDroit(id, droit);
    }
  });

  // affichage des articles
  articles.addEventListener("click", function (e) {
    e.preventDefault();
    showArticles();
    // ajouter une bordure sur le lien cliqué
    articles.classList.add("active");
    users.classList.remove("active");
  });

  // suppression d'un article ou modification
  gestion.addEventListener("click", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("btnDeleteArticle")) {
      const id = e.target.getAttribute("data-id");
      deleteArticle(id);
    } else if (e.target.classList.contains("btnModifArticle")) {
      const id = e.target.getAttribute("data-id");
      modifArticle(id);
    }
  });

  // update d'un article
  articleSection.addEventListener("click", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("updateArticle")) {
      const id = e.target.getAttribute("data-id");
      const parent = e.target.parentElement;
      updateArticle(parent, id);
    }
  });
});
