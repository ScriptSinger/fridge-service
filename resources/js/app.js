import "./bootstrap";

import "./components/modalPhone";
import leadForm from "./components/leadForm";

import phoneMask from "./directives/phoneMask";
document.addEventListener("alpine:init", () => {
    Alpine.directive("phone", (el) => phoneMask(el));
});

import Alpine from "alpinejs";
window.Alpine = Alpine;
document.addEventListener("alpine:init", () => {
    Alpine.data("leadForm", leadForm);
});

Alpine.start();
