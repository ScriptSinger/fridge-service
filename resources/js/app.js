import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

import Cleave from "cleave.js";
import "cleave.js/dist/addons/cleave-phone.ru";
window.Cleave = Cleave;

import "./components/modalPhone";
