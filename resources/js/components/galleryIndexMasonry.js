export default function galleryIndexMasonry() {
    return {
        resizeTimer: null,
        layoutTimer: null,
        onResize: null,

        init() {
            this.bindImageListeners();
            this.scheduleLayout();
            window.addEventListener("load", () => this.scheduleLayout(), { once: true });
            this.scrollAfterNavigationIfNeeded();

            this.onResize = () => {
                if (this.resizeTimer) {
                    clearTimeout(this.resizeTimer);
                }

                this.resizeTimer = setTimeout(() => {
                    this.layoutMasonry();
                }, 120);
            };

            window.addEventListener("resize", this.onResize);
        },

        getColumns() {
            if (window.innerWidth >= 1280) return 3;
            if (window.innerWidth >= 768) return 2;
            return 1;
        },

        getGap(container) {
            const computed = getComputedStyle(container);
            const raw = (computed.getPropertyValue("--gallery-masonry-gap") || "32px").trim();

            if (raw.endsWith("rem")) {
                const rem = parseFloat(raw);
                const rootFontSize = parseFloat(
                    getComputedStyle(document.documentElement).fontSize || "16"
                );
                const px = rem * rootFontSize;
                return Number.isFinite(px) ? px : 32;
            }

            if (raw.endsWith("px")) {
                const px = parseFloat(raw);
                return Number.isFinite(px) ? px : 32;
            }

            const number = parseFloat(raw);
            if (Number.isFinite(number)) return number;

            if (window.innerWidth >= 1280) return 32;
            if (window.innerWidth >= 768) return 24;
            return 16;
        },

        scheduleLayout() {
            if (this.layoutTimer) {
                cancelAnimationFrame(this.layoutTimer);
            }

            this.layoutTimer = requestAnimationFrame(() => {
                this.layoutMasonry();
            });
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
            const section = this.$refs.section || this.$refs.grid;
            if (!section) return;

            section.scrollIntoView({
                behavior: "smooth",
                block: "start",
            });
        },

        layoutMasonry() {
            const container = this.$refs.grid;
            if (!container) return;

            const cards = Array.from(container.children);
            const visibleCards = cards.filter((card) => card.style.display !== "none");
            const columns = this.getColumns();

            container.style.position = "relative";

            if (!visibleCards.length) {
                container.style.height = "0px";
                return;
            }

            if (columns === 1) {
                cards.forEach((card) => {
                    this.resetCardStyle(card);
                });

                container.style.height = "auto";
                return;
            }

            const gap = this.getGap(container);
            const containerWidth = container.clientWidth;

            if (!containerWidth) return;

            const cardWidth = (containerWidth - gap * (columns - 1)) / columns;
            const columnHeights = Array.from({ length: columns }, () => 0);

            visibleCards.forEach((card) => {
                card.style.position = "absolute";
                card.style.width = `${cardWidth}px`;
                card.style.left = "0";
                card.style.top = "0";
                card.style.transform = "translate3d(0, 0, 0)";
            });

            const heights = visibleCards.map((card) => card.offsetHeight);

            visibleCards.forEach((card, index) => {
                let targetColumn = 0;
                let minHeight = columnHeights[0];
                for (let i = 1; i < columns; i += 1) {
                    if (columnHeights[i] < minHeight) {
                        minHeight = columnHeights[i];
                        targetColumn = i;
                    }
                }

                const left = targetColumn * (cardWidth + gap);
                const top = columnHeights[targetColumn];

                card.style.willChange = "transform";
                card.style.transition = "transform 220ms cubic-bezier(.2,.8,.2,1)";
                card.style.transform = `translate3d(${left}px, ${top}px, 0)`;

                columnHeights[targetColumn] = top + heights[index] + gap;
            });

            container.style.height = `${Math.max(...columnHeights) - gap}px`;
        },

        bindImageListeners() {
            const container = this.$refs.grid;
            if (!container) return;

            container.querySelectorAll("img").forEach((img) => {
                if (img.dataset.masonryBound === "1") {
                    return;
                }

                img.dataset.masonryBound = "1";

                if (!img.complete) {
                    img.addEventListener("load", () => this.scheduleLayout(), { once: true });
                    img.addEventListener("error", () => this.scheduleLayout(), { once: true });
                }
            });
        },

        resetCardStyle(card) {
            card.style.position = "";
            card.style.left = "";
            card.style.top = "";
            card.style.width = "";
            card.style.transform = "";
            card.style.willChange = "";
            card.style.transition = "";
        },

        destroy() {
            if (this.onResize) {
                window.removeEventListener("resize", this.onResize);
            }

            if (this.resizeTimer) {
                clearTimeout(this.resizeTimer);
            }

            if (this.layoutTimer) {
                cancelAnimationFrame(this.layoutTimer);
            }
        },
    };
}
