import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

import "./bootstrap";
import "./components/modalPhone";

import leadForm from "./components/leadForm";
import gallerySlider from "./components/gallerySlider";
import brandSelect from "./components/brandSelect";
import brandCarousel from "./components/brandCarousel";
import phoneMask from "./directives/phoneMask";
import reviewsSlider from "./components/reviewsSlider";
import reviewsIndexSort from "./components/reviewsIndexSort";
import galleryIndexSort from "./components/galleryIndexSort";

// делаем Alpine глобальным
window.Alpine = Alpine;

// подключаем плагины
Alpine.plugin(collapse);

// регистрируем компоненты напрямую (без alpine:init)
Alpine.data("leadForm", leadForm);
Alpine.data("gallerySlider", gallerySlider);
Alpine.data("brandSelect", brandSelect);
Alpine.data("brandCarousel", brandCarousel);
Alpine.data("reviewsSlider", reviewsSlider);
Alpine.data("reviewsIndexSort", reviewsIndexSort);
Alpine.data("galleryIndexSort", galleryIndexSort);

// регистрируем директиву
Alpine.directive("phone", (el) => phoneMask(el));

// запускаем Alpine
Alpine.start();
