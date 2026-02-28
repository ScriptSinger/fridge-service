export default function galleryIndexSort(initialSort = "newest") {
    return {
        sort: initialSort || "newest",

        init() {
            this.sortCards(this.sort);

            window.addEventListener("gallery-sort-change", (event) => {
                this.sort = event.detail?.sort ?? "newest";
                this.sortCards(this.sort);
            });
        },

        sortCards(sort) {
            const container = this.$refs.grid;
            if (!container) return;

            const cards = Array.from(container.children);
            const createdAt = (el) => Number(el.dataset.createdTs || 0);

            cards.sort((a, b) => {
                if (sort === "oldest") {
                    return createdAt(a) - createdAt(b);
                }
                return createdAt(b) - createdAt(a);
            });

            cards.forEach((card) => container.appendChild(card));
        },
    };
}
