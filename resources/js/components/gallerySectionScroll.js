export default function gallerySectionScroll() {
    return {
        onPaginationClick: null,

        init() {
            this.bindPaginationLinks();
            this.scrollAfterNavigationIfNeeded();
        },

        scrollAfterNavigationIfNeeded() {
            try {
                if (sessionStorage.getItem("gallery:scrollAfterNav") !== "1") {
                    return;
                }
                sessionStorage.removeItem("gallery:scrollAfterNav");
            } catch (e) {
                return;
            }

            requestAnimationFrame(() => {
                this.scrollToResults();
            });
        },

        scrollToResults() {
            const section = document.getElementById("gallery-index-section") || this.$refs.section;
            if (!section) return;

            section.scrollIntoView({
                behavior: "smooth",
                block: "start",
            });
        },

        bindPaginationLinks() {
            const section = this.$refs.section;
            if (!section) return;

            this.onPaginationClick = (event) => {
                const target = event.target;
                if (!(target instanceof Element)) return;

                const link = target.closest('nav[role="navigation"] a[href]');
                if (!link) return;

                try {
                    sessionStorage.setItem("gallery:scrollAfterNav", "1");
                } catch (e) {
                    // ignore storage issues
                }
            };

            section.addEventListener("click", this.onPaginationClick, true);
        },

        destroy() {
            if (this.onPaginationClick && this.$refs.section) {
                this.$refs.section.removeEventListener("click", this.onPaginationClick, true);
            }
        },
    };
}
