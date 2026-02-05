import IMask from "imask";

export default (el) => {
    IMask(el, {
        mask: "+{7} (000) 000-00-00",
        lazy: false, // ← показывает маску сразу
    });
};
