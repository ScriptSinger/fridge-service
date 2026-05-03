export default () => ({
    open: false,
    src: null,
    alt: "",

    init() {
        // Делегирование клика по картинкам внутри контейнера (WYSIWYG HTML).
        this.$el.addEventListener("click", (event) => {
            const target = event.target;
            if (!(target instanceof Element)) return;

            const img = target.closest("img");
            if (!img || !this.$el.contains(img)) return;

            // Если img обёрнута в ссылку — не уходим со страницы.
            const link = img.closest("a");
            if (link && this.$el.contains(link)) {
                event.preventDefault();
            }

            const src = img.getAttribute("src");
            if (!src) return;

            this.src = src;
            this.alt = img.getAttribute("alt") || "";
            this.open = true;
            document.body.classList.add("overflow-hidden");
        });
    },

    close() {
        this.open = false;
        this.src = null;
        document.body.classList.remove("overflow-hidden");
    },
});

