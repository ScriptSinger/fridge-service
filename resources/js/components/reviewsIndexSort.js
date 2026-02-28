export default function reviewsIndexSort(initialSort = "newest") {
    return {
        sort: initialSort || "newest",

        init() {
            this.sortCards(this.sort);

            window.addEventListener("reviews-sort-change", (event) => {
                this.sort = event.detail?.sort ?? "newest";
                this.sortCards(this.sort);
            });
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
    };
}
