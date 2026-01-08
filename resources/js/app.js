import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

import Cleave from "cleave.js";
import "cleave.js/dist/addons/cleave-phone.ru";
window.Cleave = Cleave;

import "./components/modalPhone";

document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        if (target)
            target.scrollIntoView({ behavior: "smooth", block: "start" });
    });
});
