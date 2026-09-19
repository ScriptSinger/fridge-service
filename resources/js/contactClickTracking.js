// Делегирование на document: чтобы отследить клик по новой ссылке "позвонить"/
// написать в мессенджер, достаточно добавить data-contact-channel, без
// дополнительной разводки JS. sendBeacon переживает уход со страницы
// (tel:/wa.me/t.me навигация), поэтому preventDefault не нужен.
export default function initContactClickTracking() {
    document.addEventListener("click", (event) => {
        const el = event.target.closest("[data-contact-channel]");
        if (!el || typeof navigator.sendBeacon !== "function") {
            return;
        }

        const payload = JSON.stringify({ channel: el.dataset.contactChannel });
        navigator.sendBeacon(
            "/api/contact-clicks",
            new Blob([payload], { type: "application/json" }),
        );
    });
}
