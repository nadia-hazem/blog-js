document.addEventListener("DOMContentLoaded", function () {
  const currentUser = document.querySelector("#currentUser").textContent;
  const users = document.querySelector("#users");
  const articles = document.querySelector("#articles");
  const categories = document.querySelector("#categories");

  const gestion = document.querySelector("#gestion");

  const articleSection = document.querySelector("#article");
  const commentairesSection = document.querySelector("#commentaires");

  let idUsed = null;

  // fonctions
  // USERS
  function showUsers() {
    gestion.innerHTML = "";
    articleSection.innerHTML = "";
    commentairesSection.innerHTML = "";
    //fetch
    fetch("assets/php/adminGestion.php?users")
      .then((response) => response.json())
      .then((data) => {
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

  // ARTICLES
  function showArticles() {
    gestion.innerHTML = "";
    articleSection.innerHTML = "";
    commentairesSection.innerHTML = "";
    //fetch
    fetch("assets/php/adminGestion.php?articles")
      .then((response) => response.json())
      .then((data) => {
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
          btnModif.classList.add("fas", "fa-pen", "btnModifArticle");
          tdGestion.appendChild(btnModif);
          const btnDelete = document.createElement("button");
          btnDelete.setAttribute("data-id", article.id);
          btnDelete.classList.add("fas", "fa-trash", "btnDeleteArticle");
          tdGestion.appendChild(btnDelete);
          const btnComments = document.createElement("button");
          btnComments.setAttribute("data-id", article.id);
          btnComments.classList.add("fas", "fa-comment-dots", "btnComments");
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
        commentairesSection.innerHTML = "";
        // création d'un formulaire
        const form = document.createElement("form");
        form.setAttribute("enctype", "multipart/form-data");
        form.classList.add("w-50");
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
        textareaDescription.setAttribute("cols", "30");
        textareaDescription.setAttribute("rows", "10");
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

  // COMMENTAIRES
  function showComments(id) {
    fetch("assets/php/adminGestion.php?showComments=" + id)
      .then((response) => response.json())
      .then((data) => {
        articleSection.innerHTML = "";
        if (data == "noComments") {
          console.log("aucun commentaire");
          const p = document.createElement("p");
          p.textContent = "Aucun commentaire";
          articleSection.appendChild(p);
        } else {
          const table = document.createElement("table");
          const thead = document.createElement("thead");
          const tr = document.createElement("tr");
          // titre
          const th = document.createElement("th");
          th.textContent = "Titre";
          // commentaire
          const thComment = document.createElement("th");
          thComment.textContent = "Commentaire";
          // author
          const thAuthor = document.createElement("th");
          thAuthor.textContent = "Auteur";
          // date
          const thDate = document.createElement("th");
          thDate.textContent = "Date";
          // gestion
          const thGestion = document.createElement("th");
          thGestion.setAttribute("colspan", "2");
          thGestion.textContent = "Gestion";
          tr.appendChild(th);
          tr.appendChild(thComment);
          tr.appendChild(thAuthor);
          tr.appendChild(thDate);
          tr.appendChild(thGestion);
          thead.appendChild(tr);
          table.appendChild(thead);
          data.forEach((comment) => {
            const tr = document.createElement("tr");
            const td = document.createElement("td");
            const tdComment = document.createElement("td");
            const tdAuthor = document.createElement("td");
            const tdDate = document.createElement("td");
            const tdGestion = document.createElement("td");
            // contenue
            td.textContent = comment.sujet;
            tdComment.textContent = comment.commentaire;
            tdAuthor.textContent = comment.auteur;
            tdDate.textContent = comment.date;
            // bouton modifier
            const btnModif = document.createElement("button");
            btnModif.setAttribute("data-id", comment.id);
            btnModif.classList.add("fas", "fa-pen", "btnModifComment");
            tdGestion.appendChild(btnModif);
            // bouton delete
            const btnDelete = document.createElement("button");
            btnDelete.setAttribute("data-id", comment.id);
            btnDelete.classList.add("fas", "fa-trash", "btnDeleteComment");
            tdGestion.appendChild(btnDelete);
            tr.appendChild(td);
            tr.appendChild(tdComment);
            tr.appendChild(tdAuthor);
            tr.appendChild(tdDate);
            tr.appendChild(tdGestion);
            table.appendChild(tr);
          });
          articleSection.appendChild(table);
        }
      })
      .catch((error) => console.log(error));
  }

  function deleteComment(id) {
    fetch("assets/php/adminGestion.php?deleteComment=" + id)
      .then((response) => response.text())
      .then((data) => {
        // trim
        data = data.trim();
        if (data == "ok") {
          showComments(idUsed);
        }
      })
      .catch((error) => console.log(error));
  }

  function modifComment(id) {
    fetch("assets/php/adminGestion.php?modifComment=" + id)
      .then((response) => response.json())
      .then((data) => {
        commentairesSection.innerHTML = "";
        const form = document.createElement("form");
        form.setAttribute("id", "formModifComment");
        form.classList.add("w-50" );
        // titre
        const labelTitre = document.createElement("label");
        labelTitre.setAttribute("for", "sujet");
        labelTitre.textContent = "Sujet";
        const inputTitre = document.createElement("input");
        inputTitre.setAttribute("type", "text");
        inputTitre.setAttribute("name", "sujet");
        inputTitre.setAttribute("id", "sujet");
        inputTitre.setAttribute("value", data.sujet);
        // description
        const labelDescription = document.createElement("label");
        labelDescription.setAttribute("for", "commentaire");
        labelDescription.textContent = "Commentaire";
        const textarea = document.createElement("textarea");
        textarea.setAttribute("name", "commentaire");
        textarea.setAttribute("id", "commentaire");
        textarea.textContent = data.commentaire;
        // bouton
        const btn = document.createElement("button");
        btn.setAttribute("type", "submit");
        btn.setAttribute("data-id", data.id);
        btn.classList.add("updateComment");
        btn.textContent = "Modifier";
        form.appendChild(labelTitre);
        form.appendChild(inputTitre);
        form.appendChild(labelDescription);
        form.appendChild(textarea);
        form.appendChild(btn);
        commentairesSection.appendChild(form);
      })
      .catch((error) => console.log(error));
  }

  function updateComment(target, id) {
    const form = new FormData(target);
    if (form.get("sujet") == "" || form.get("commentaire") == "") {
      alert("Veuillez remplir tout les champs");
    }
    fetch("assets/php/adminGestion.php?updateComment=" + id, {
      method: "POST",
      body: form,
    })
      .then((response) => response.text())
      .then((data) => {
        // trim
        data = data.trim();
        if (data == "ok") {
          commentairesSection.innerHTML = "";
          showComments(idUsed);
        }
      })
      .catch((error) => console.log(error));
  }

  // CATEGORIES
  function showCategories() {
    gestion.innerHTML = "";
    articleSection.innerHTML = "";
    commentairesSection.innerHTML = "";
    fetch("assets/php/adminGestion.php?showCategories")
      .then((response) => response.json())
      .then((data) => {
        const table = document.createElement("table");
        const thead = document.createElement("thead");
        const tr = document.createElement("tr");
        // titre
        const th = document.createElement("th");
        th.textContent = "Nom";
        // gestion
        const thGestion = document.createElement("th");
        thGestion.setAttribute("colspan", "2");
        thGestion.textContent = "Gestion";
        tr.appendChild(th);
        tr.appendChild(thGestion);
        thead.appendChild(tr);
        table.appendChild(thead);
        data.forEach((categorie) => {
          const tr = document.createElement("tr");
          const td = document.createElement("td");
          const tdGestion = document.createElement("td");
          // contenue
          td.textContent = categorie.categorie;
          // bouton modifier
          const btnModif = document.createElement("button");
          btnModif.setAttribute("data-id", categorie.id);
          btnModif.classList.add("fas", "fa-pen", "btnModifCategorie");
          tdGestion.appendChild(btnModif);
          // bouton delete
          const btnDelete = document.createElement("button");
          btnDelete.setAttribute("data-id", categorie.id);
          btnDelete.classList.add("fas", "fa-trash", "btnDeleteCategorie");
          tdGestion.appendChild(btnDelete);
          tr.appendChild(td);
          tr.appendChild(tdGestion);
          table.appendChild(tr);
        });
        // dernière ligne pour ajouter une catégorie
        const trLast = document.createElement("tr");
        const tdForm = document.createElement("td");
        tdForm.setAttribute("colspan", "2");
        const formCateg = document.createElement("form");
        formCateg.setAttribute("id", "formAddCategorie");
        formCateg.classList.add("my-2", "formcateg");
        tdForm.appendChild(formCateg);
        const h2 = document.createElement("h2");
        h2.textContent = "Ajouter une catégorie";
        h2.classList.add("py-1");
        formCateg.appendChild(h2);
        const input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name", "category");
        input.setAttribute("id", "categorie");
        input.classList.add("my-1", "py-1");
        const btn = document.createElement("button");
        btn.setAttribute("type", "submit");
        btn.classList.add("fas", "fa-plus", "btnAddCategorie", "py-1");
        formCateg.appendChild(input);
        formCateg.appendChild(btn);
        trLast.appendChild(tdForm);
        table.appendChild(trLast);
        gestion.appendChild(table);
      })
      .catch((error) => console.log(error));
  }

  function addCategorie(target) {
    const form = new FormData(target);
    if (form.get("category") == "") {
      alert("Veuillez remplir tout les champs");
    }
    fetch("assets/php/adminGestion.php?addCategorie", {
      method: "POST",
      body: form,
    })
      .then((response) => response.text())
      .then((data) => {
        // trim
        data = data.trim();
        if (data == "ok") {
          showCategories();
        }
      })
      .catch((error) => console.log(error));
  }

  function deleteCategorie(id) {
    fetch("assets/php/adminGestion.php?deleteCategory=" + id)
      .then((response) => response.text())
      .then((data) => {
        // trim
        data = data.trim();
        if (data == "ok") {
          showCategories();
        }
      })
      .catch((error) => console.log(error));
  }

  function modifCategorie(id) {
    fetch("assets/php/adminGestion.php?modifCategory=" + id)
      .then((response) => response.json())
      .then((data) => {
        articleSection.innerHTML = "";
        commentairesSection.innerHTML = "";
        const form = document.createElement("form");
        form.classList.add("w-50");
        // titre
        const labelTitre = document.createElement("label");
        labelTitre.setAttribute("for", "categorie");
        labelTitre.textContent = "Nom";
        const inputTitre = document.createElement("input");
        inputTitre.setAttribute("type", "text");
        inputTitre.setAttribute("name", "category");
        inputTitre.setAttribute("id", "categorie");
        inputTitre.setAttribute("value", data.categorie);
        // bouton
        const btn = document.createElement("button");
        btn.setAttribute("type", "submit");
        btn.setAttribute("data-id", data.id);
        btn.classList.add("updateCategorie");
        btn.textContent = "Modifier";
        form.appendChild(labelTitre);
        form.appendChild(inputTitre);
        form.appendChild(btn);
        articleSection.appendChild(form);
      })
      .catch((error) => console.log(error));
  }

  function updateCategorie(target, id) {
    const form = new FormData(target);
    if (form.get("category") == "") {
      alert("Veuillez remplir tous les champs");
    }
    fetch("assets/php/adminGestion.php?updateCategory=" + id, {
      method: "POST",
      body: form,
    })
      .then((response) => response.text())
      .then((data) => {
        // trim
        data = data.trim();
        if (data == "ok") {
          articleSection.innerHTML = "";
          showCategories();
        }
      })
      .catch((error) => console.log(error));
  }

  // events ///////////////////////////////////////////////////////////////////////////////////////
  // affichage des users
  users.addEventListener("click", function (e) {
    e.preventDefault();
    showUsers();
    // ajouter une bordure sur le lien cliqué
    users.classList.add("active");
    articles.classList.remove("active");
    categories.classList.remove("active");
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
    categories.classList.remove("active");
  });

  // suppression d'un article ou modification ou affichage des commentaires
  gestion.addEventListener("click", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("btnDeleteArticle")) {
      const id = e.target.getAttribute("data-id");
      deleteArticle(id);
    } else if (e.target.classList.contains("btnModifArticle")) {
      const id = e.target.getAttribute("data-id");
      modifArticle(id);
    } else if (e.target.classList.contains("btnComments")) {
      const id = e.target.getAttribute("data-id");
      idUsed = id;
      showComments(id);
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

  // suppression ou modification d'un commentaire
  articleSection.addEventListener("click", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("btnDeleteComment")) {
      const id = e.target.getAttribute("data-id");
      deleteComment(id);
    } else if (e.target.classList.contains("btnModifComment")) {
      const id = e.target.getAttribute("data-id");
      modifComment(id);
    }
  });

  // update d'un commentaire
  commentairesSection.addEventListener("click", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("updateComment")) {
      const id = e.target.getAttribute("data-id");
      const parent = e.target.parentElement;
      updateComment(parent, id);
    }
  });

  // affichage des catégories
  categories.addEventListener("click", function (e) {
    e.preventDefault();
    showCategories();
    // ajouter une bordure sur le lien cliqué
    categories.classList.add("active");
    users.classList.remove("active");
    articles.classList.remove("active");
  });

  // ajout, suppression ou modification d'une catégorie
  gestion.addEventListener("click", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("btnAddCategorie")) {
      const input = e.target.parentElement;
      addCategorie(input);
    } else if (e.target.classList.contains("btnDeleteCategorie")) {
      const id = e.target.getAttribute("data-id");
      deleteCategorie(id);
    } else if (e.target.classList.contains("btnModifCategorie")) {
      const id = e.target.getAttribute("data-id");
      modifCategorie(id);
    }
  });

  // update d'une catégorie
  articleSection.addEventListener("click", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("updateCategorie")) {
      const id = e.target.getAttribute("data-id");
      const parent = e.target.parentElement;
      updateCategorie(parent, id);
    }
  });
});
