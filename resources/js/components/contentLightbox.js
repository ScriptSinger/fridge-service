export default () => ({
    open: false,
    src: null,
    alt: "",
    previousFocus: null,

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
            this.previousFocus = document.activeElement instanceof HTMLElement ? document.activeElement : null;
            this.open = true;
            document.body.classList.add("overflow-hidden");

            this.$nextTick(() => {
                this.$refs.dialog?.focus?.();
            });
        });

        this.$watch("open", (value) => {
            if (value) return;

            document.body.classList.remove("overflow-hidden");

            if (this.previousFocus && typeof this.previousFocus.focus === "function") {
                this.previousFocus.focus();
            }
        });
    },

    close() {
        this.open = false;
    },

    handleKeydown(event) {
        if (!this.open) return;

        if (event.key === "Escape") {
            event.preventDefault();
            this.close();
            return;
        }

        if (event.key !== "Tab") return;

        const dialog = this.$refs.dialog;
        if (!dialog) return;

        const focusable = Array.from(
            dialog.querySelectorAll(
                'button,[href],input,select,textarea,[tabindex]:not([tabindex="-1"])',
            ),
        ).filter((element) => !element.hasAttribute("disabled"));

        if (!focusable.length) {
            event.preventDefault();
            dialog.focus();
            return;
        }

        const first = focusable[0];
        const last = focusable[focusable.length - 1];
        const active = document.activeElement;

        if (event.shiftKey && active === first) {
            event.preventDefault();
            last.focus();
            return;
        }

        if (!event.shiftKey && active === last) {
            event.preventDefault();
            first.focus();
        }
    },
});
