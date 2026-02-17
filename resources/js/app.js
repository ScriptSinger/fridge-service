import "./bootstrap";

import "./components/modalPhone";
import leadForm from "./components/leadForm";
import gallerySlider from "./components/gallerySlider";
import collapse from "@alpinejs/collapse";

import phoneMask from "./directives/phoneMask";
document.addEventListener("alpine:init", () => {
    Alpine.directive("phone", (el) => phoneMask(el));
});

import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.plugin(collapse);
document.addEventListener("alpine:init", () => {
    Alpine.data("leadForm", leadForm);
    Alpine.data("gallerySlider", gallerySlider);
});

Alpine.start();
