import Cleave from "cleave.js";
import "cleave.js/dist/addons/cleave-phone.ru";

export default (el) => {
    new Cleave(el, {
        phoneRegionCode: "ru",
        prefix: "+7",
        delimiter: "-",
        blocks: [2, 3, 3, 2, 2],
    });
};
