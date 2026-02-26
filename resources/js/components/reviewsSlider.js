export default function reviewsSlider(slides = [], { autoplay = true, interval = 5500 } = {}) {
    return {
        slides,
        current: 0,
        perView: 1,
        touchStartX: 0,
        cardStep: 0,
        resizeTimer: null,
        timer: null,
        autoplay,
        interval,

        get maxIndex() {
            return Math.max(this.slides.length - this.perView, 0);
        },

        get canSlide() {
            return this.slides.length > this.perView;
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

            if (this.current > this.maxIndex) this.current = this.maxIndex;

            if (!this.canSlide) {
                this.stopAutoplay();
            } else if (this.autoplay && !this.timer) {
                this.startAutoplay();
            }
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

        onTouchStart(event) {
            this.touchStartX = event.changedTouches[0].screenX;
        },

        onTouchEnd(event) {
            const touchEndX = event.changedTouches[0].screenX;
            const delta = this.touchStartX - touchEndX;
            if (Math.abs(delta) < 40) return;
            delta > 0 ? this.next() : this.prev();
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
                i === this.current ? "w-7 bg-yellow-500" : "w-2.5 bg-gray-300 hover:bg-gray-400",
            ].join(" ");
        },

        init() {
            const debouncedResize = () => {
                if (this.resizeTimer) clearTimeout(this.resizeTimer);
                this.resizeTimer = setTimeout(() => this.updatePerView(), 100);
            };

            this.updatePerView();
            requestAnimationFrame(() => this.updatePerView());
            window.addEventListener("load", () => this.updatePerView(), { once: true });
            window.addEventListener("resize", debouncedResize);

            if (this.autoplay) this.startAutoplay();
        },
    };
}
