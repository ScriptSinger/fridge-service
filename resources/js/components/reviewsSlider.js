export default function reviewsSlider(slides = [], { autoplay = false, interval = 5500 } = {}) {
    return {
        slides,
        perView: 1,
        current: 0,
        timer: null,
        autoplay,
        interval,
        cardStep: 0,
        resizeTimer: null,
        removeListeners: null,

        init() {
            const debouncedResize = () => {
                if (this.resizeTimer) clearTimeout(this.resizeTimer);
                this.resizeTimer = setTimeout(() => this.updatePerView(), 100);
            };

            const onLoad = () => this.updatePerView();
            this.updatePerView();
            requestAnimationFrame(() => this.updatePerView());
            window.addEventListener("load", onLoad, { once: true });
            window.addEventListener("resize", debouncedResize);

            if (this.autoplay) this.startAutoplay();

            this.removeListeners = () => {
                if (this.resizeTimer) {
                    clearTimeout(this.resizeTimer);
                    this.resizeTimer = null;
                }
                window.removeEventListener("resize", debouncedResize);
                this.stopAutoplay();
            };

            return () => {
                this.removeListeners && this.removeListeners();
            };
        },

        updatePerView() {
            const track = this.$refs.track;
            const card = track?.querySelector("[data-card]");
            if (!track || !card) {
                this.perView = 1;
                this.cardStep = 0;
                return;
            }

            const rect = card.getBoundingClientRect();
            const style = getComputedStyle(card);
            const margin =
                parseFloat(style.marginLeft || "0") + parseFloat(style.marginRight || "0");
            this.cardStep = rect.width + margin;

            const trackWidth = track.getBoundingClientRect().width;
            this.perView = Math.max(1, Math.floor(trackWidth / this.cardStep));
            this.current = Math.min(this.current, this.maxIndex);

            if (!this.canSlide) {
                this.current = 0;
                this.stopAutoplay();
            } else if (this.autoplay && !this.timer) {
                this.startAutoplay();
            }
        },

        get maxIndex() {
            return Math.max(this.slides.length - this.perView, 0);
        },

        get pages() {
            return Math.max(Math.ceil(this.slides.length / this.perView), 1);
        },

        get canSlide() {
            return this.slides.length > this.perView;
        },

        next() {
            this.current = this.current >= this.maxIndex ? 0 : this.current + 1;
        },

        prev() {
            this.current = this.current <= 0 ? this.maxIndex : this.current - 1;
        },

        goTo(index) {
            this.current = Math.min(Math.max(index, 0), this.maxIndex);
        },

        startAutoplay() {
            if (!this.autoplay || !this.canSlide) return;
            this.stopAutoplay();
            this.timer = setInterval(() => this.next(), this.interval);
        },

        stopAutoplay() {
            if (this.timer) {
                clearInterval(this.timer);
                this.timer = null;
            }
        },

        trackStyle() {
            if (!this.cardStep) return "";
            const translate = -(this.cardStep * this.current);
            return `transform: translateX(${translate}px);`;
        },

        dotClass(i) {
            return [
                "h-2 w-2 rounded-full transition",
                i === this.pageIndex ? "bg-yellow-500" : "bg-gray-300 hover:bg-gray-400",
            ].join(" ");
        },

        get pageIndex() {
            return Math.floor(this.current / this.perView);
        },

        goToPage(i) {
            this.goTo(i * this.perView);
        },
    };
}
