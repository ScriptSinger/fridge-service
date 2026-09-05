export default function reviewsIndexSort() {
    return {
        init() {
            this.bindPaginationLinks();
            this.scrollAfterNavigationIfNeeded();
        },

        scrollAfterNavigationIfNeeded() {
            try {
                if (sessionStorage.getItem("reviews:scrollAfterNav") !== "1") {
                    return;
                }
                sessionStorage.removeItem("reviews:scrollAfterNav");
            } catch (e) {
                return;
            }

            requestAnimationFrame(() => {
                this.scrollToResults();
            });
        },

        scrollToResults() {
            const section = this.$refs.section || this.$refs.grid;
            if (!section) return;

            section.scrollIntoView({
                behavior: "smooth",
                block: "start",
            });
        },

        bindPaginationLinks() {
            const section = this.$refs.section;
            if (!section) return;

            section.querySelectorAll('nav[role="navigation"] a[href]').forEach((link) => {
                if (link.dataset.scrollBound === "1") {
                    return;
                }

                link.dataset.scrollBound = "1";
                link.addEventListener("click", () => {
                    try {
                        sessionStorage.setItem("reviews:scrollAfterNav", "1");
                    } catch (e) {
                        // ignore storage issues
                    }
                });
            });
        },
    };
}
