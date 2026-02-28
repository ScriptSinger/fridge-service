export default function reviewsIndexSort(
    initialSort = "newest",
    initialOnlyWithPhoto = false,
    initialSource = "all"
) {
    return {
        sort: initialSort || "newest",
        onlyWithPhoto: Boolean(initialOnlyWithPhoto),
        source: initialSource || "all",

        init() {
            this.sortCards(this.sort);
            this.applyFilters();

            window.addEventListener("reviews-sort-change", (event) => {
                this.sort = event.detail?.sort ?? "newest";
                this.sortCards(this.sort);
                this.applyFilters();
            });

            window.addEventListener("reviews-source-change", (event) => {
                this.source = event.detail?.source ?? "all";
                this.applyFilters();
            });
        },

        toggleOnlyWithPhoto() {
            this.onlyWithPhoto = !this.onlyWithPhoto;
            this.applyFilters();
        },

        sortCards(sort) {
            const container = this.$refs.grid;
            if (!container) return;

            const cards = Array.from(container.children);
            const dateOf = (el) => Number(el.dataset.publishedTs || 0);
            const ratingOf = (el) => Number(el.dataset.rating || 0);

            cards.sort((a, b) => {
                if (sort === "oldest") {
                    return dateOf(a) - dateOf(b);
                }

                if (sort === "positive") {
                    if (ratingOf(b) !== ratingOf(a)) {
                        return ratingOf(b) - ratingOf(a);
                    }
                    return dateOf(b) - dateOf(a);
                }

                if (sort === "negative") {
                    if (ratingOf(a) !== ratingOf(b)) {
                        return ratingOf(a) - ratingOf(b);
                    }
                    return dateOf(b) - dateOf(a);
                }

                return dateOf(b) - dateOf(a);
            });

            cards.forEach((card) => container.appendChild(card));
        },

        applyFilters() {
            const container = this.$refs.grid;
            if (!container) return;

            const cards = Array.from(container.children);

            cards.forEach((card) => {
                const hasPhoto = card.dataset.hasPhoto === "1";
                const cardSource = card.dataset.source || "google";
                const sourceMatch = this.source === "all" || cardSource === this.source;
                const shouldShow = sourceMatch && (!this.onlyWithPhoto || hasPhoto);
                card.style.display = shouldShow ? "" : "none";
            });
        },
    };
}
