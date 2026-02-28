export default function galleryIndexSort(
    initialSort = "newest",
    initialBrand = "all",
    initialDevice = "all"
) {
    return {
        sort: initialSort || "newest",
        brand: initialBrand || "all",
        device: initialDevice || "all",

        init() {
            this.sortCards(this.sort);
            this.applyFilters();

            window.addEventListener("gallery-sort-change", (event) => {
                this.sort = event.detail?.sort ?? "newest";
                this.sortCards(this.sort);
                this.applyFilters();
            });

            window.addEventListener("gallery-brand-change", (event) => {
                this.brand = event.detail?.sort ?? "all";
                this.applyFilters();
            });

            window.addEventListener("gallery-device-change", (event) => {
                this.device = event.detail?.sort ?? "all";
                this.applyFilters();
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

        applyFilters() {
            const container = this.$refs.grid;
            if (!container) return;

            const cards = Array.from(container.children);

            cards.forEach((card) => {
                const cardBrand = card.dataset.brand || "";
                const cardDevice = card.dataset.device || "";
                const brandMatch = this.brand === "all" || cardBrand === this.brand;
                const deviceMatch = this.device === "all" || cardDevice === this.device;
                card.style.display = brandMatch && deviceMatch ? "" : "none";
            });
        },
    };
}
