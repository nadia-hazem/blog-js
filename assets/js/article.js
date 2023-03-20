// chargement du dom
document.addEventListener("DOMContentLoaded", function () {
  // récupération des éléments
  const voteDiv = document.querySelector(".vote");
  const idArticle = voteDiv.dataset.id;

  // fonction
  function displayVoteDiv() {
    fetch("assets/php/likes.php?id=" + idArticle)
      .then((response) => response.text())
      .then((data) => {
        voteDiv.innerHTML = data;
      });
    changeColor();
  }

  function like(id_article) {
    const data = new FormData();
    data.append("id_article", id_article);
    data.append("like", "like");
    fetch("assets/php/likes.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data == true) {
          // changement de couleur
          voteDiv.classList.remove("isDislike");
          voteDiv.classList.add("isLike");
          updateLike(id_article);
        } else if (data == "déconnecté") {
          alert("Vous devez être connecté pour voter !");
        }
      });
  }

  function dislike(id_article) {
    const data = new FormData();
    data.append("id_article", id_article);
    data.append("dislike", "dislike");
    fetch("assets/php/likes.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data == true) {
          // changement de couleur
          voteDiv.classList.remove("isLike");
          voteDiv.classList.add("isDislike");
          updateLike(id_article);
        } else if (data == "déconnecté") {
          alert("Vous devez être connecté pour voter !");
        }
      });
  }

  function updateLike(id_article) {
    const data = new FormData();
    data.append("id_article", id_article);
    data.append("update", "update");
    fetch("assets/php/likes.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data == true) {
          displayVoteDiv();
        }
      });
  }

  function changeColor() {
    const data = new FormData();
    data.append("id_article", idArticle);
    data.append("color", "color");
    fetch("assets/php/likes.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data == 1) {
          voteDiv.classList.remove("isDislike");
          voteDiv.classList.add("isLike");
        } else if (data == -1) {
          voteDiv.classList.remove("isLike");
          voteDiv.classList.add("isDislike");
        } else if (data == 0) {
          voteDiv.classList.remove("isLike");
          voteDiv.classList.remove("isDislike");
        }
      });
  }

  // appel des fonctions
  displayVoteDiv();

  // écoute des événements
  voteDiv.addEventListener("click", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("like")) {
      console.log("like");
      like(idArticle);
    } else if (e.target.classList.contains("dislike")) {
      console.log("dislike");
      dislike(idArticle);
    }
  });
});
