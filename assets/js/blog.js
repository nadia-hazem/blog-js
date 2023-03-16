// attente du chargement du DOM
document.addEventListener("DOMContentLoaded", function () {
  const selectCateg = document.querySelector("#selectCategory");

  function getCateg() {
    // fetch vers blogGestion.php?value=ok
    fetch("assets/php/blogGestion.php?value=ok")
      .then((response) => response.json())
      .then((data) => {
        // récupération des données
        const categ = data.Categ;
        const categInt = data.categInt;
        //création de l'option pour toutes les catégories
        const optionAll = document.createElement("option");
        optionAll.setAttribute("value", 0);
        optionAll.textContent = "Toutes les catégories";
        if (categInt == 0) {
          optionAll.setAttribute("selected", "selected");
        }
        selectCateg.appendChild(optionAll);
        // création des options, avec l'attribut selected si la valeur de categInt correspond à la valeur de l'option à l'aide d'une boucle foreach
        categ.forEach((element) => {
          const option = document.createElement("option");
          option.setAttribute("value", element.id);
          option.textContent = element.categorie;
          if (categInt == element.id) {
            option.setAttribute("selected", "selected");
          }
          selectCateg.appendChild(option);
        });
      });
  }

  // appel de la fonction
  getCateg();

  // attente du changement de valeur de la liste déroulante
  selectCateg.addEventListener("change", function () {
    // recup de la valeur
    const value = selectCateg.value;
    console.log(value);
    // fetch vers blogGestion.php?categ=value
    fetch(`assets/php/blogGestion.php?categ=${value}`)
      .then((response) => response.text())
      .then((response) => {
        // trim
        const responseTrim = response.trim();
        if (responseTrim !== "") {
          // reload la page
          window.location.reload();
        }
      })
      .catch((error) => {
        console.log(error);
      });
  });
});
