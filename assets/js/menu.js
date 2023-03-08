// fonction pour changer le style du bouton burger
function burgerSwitch(nav) {
    if (nav.className == "open") {
        nav.className = "close";
    } else {
        nav.className = "open";
    }

}
