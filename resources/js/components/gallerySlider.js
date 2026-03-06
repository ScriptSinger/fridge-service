export default (slides = []) => ({
    current: 0,
    perView: 1,
    touchStartX: 0,
    allSlides: slides,
    isFullscreen: false,
    fullscreenCurrent: 0,
    cardStep: 0,
    resizeTimer: null,

    get slides() {
        return this.allSlides;
    },

    get maxIndex() {
        return Math.max(this.slides.length - this.perView, 0);
    },

    get fullscreenMaxIndex() {
        return Math.max(this.slides.length - 1, 0);
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

        if (this.current > this.maxIndex) {
            this.current = this.maxIndex;
        }
    },

    next() {
        this.current = this.current >= this.maxIndex ? 0 : this.current + 1;
    },

    prev() {
        this.current = this.current <= 0 ? this.maxIndex : this.current - 1;
    },

    goTo(index) {
        this.current = index;
    },

    openFullscreen(index) {
        this.fullscreenCurrent = index;
        this.isFullscreen = true;
        document.body.classList.add("overflow-hidden");
    },

    closeFullscreen() {
        this.isFullscreen = false;
        document.body.classList.remove("overflow-hidden");
    },

    nextFullscreen() {
        this.fullscreenCurrent =
            this.fullscreenCurrent >= this.fullscreenMaxIndex
                ? 0
                : this.fullscreenCurrent + 1;
    },

    prevFullscreen() {
        this.fullscreenCurrent =
            this.fullscreenCurrent <= 0
                ? this.fullscreenMaxIndex
                : this.fullscreenCurrent - 1;
    },

    goToFullscreen(index) {
        this.fullscreenCurrent = index;
    },

    onTouchStart(event) {
        this.touchStartX = event.changedTouches[0].screenX;
    },

    onTouchEnd(event, mode = "default") {
        const touchEndX = event.changedTouches[0].screenX;
        const delta = this.touchStartX - touchEndX;

        if (Math.abs(delta) < 40) return;

        if (delta > 0) {
            mode === "fullscreen" ? this.nextFullscreen() : this.next();
        } else {
            mode === "fullscreen" ? this.prevFullscreen() : this.prev();
        }
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
        window.addEventListener("keydown", (event) => {
            if (!this.isFullscreen) return;

            if (event.key === "Escape") this.closeFullscreen();
            if (event.key === "ArrowRight") this.nextFullscreen();
            if (event.key === "ArrowLeft") this.prevFullscreen();
        });
    },
});
