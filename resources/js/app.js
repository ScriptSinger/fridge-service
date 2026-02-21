import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

import "./bootstrap";
import "./components/modalPhone";

import leadForm from "./components/leadForm";
import gallerySlider from "./components/gallerySlider";
import phoneMask from "./directives/phoneMask";

// делаем Alpine глобальным
window.Alpine = Alpine;

// подключаем плагины
Alpine.plugin(collapse);

// регистрируем компоненты напрямую (без alpine:init)
Alpine.data("leadForm", leadForm);
Alpine.data("gallerySlider", gallerySlider);

// регистрируем директиву
Alpine.directive("phone", (el) => phoneMask(el));

// запускаем Alpine
Alpine.start();
