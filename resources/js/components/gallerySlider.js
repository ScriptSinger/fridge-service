export default (slides = []) => ({
    current: 0,
    perView: 1,
    touchStartX: 0,
    slides,
    isFullscreen: false,
    fullscreenCurrent: 0,

    get maxIndex() {
        return Math.max(this.slides.length - this.perView, 0);
    },

    get fullscreenMaxIndex() {
        return Math.max(this.slides.length - 1, 0);
    },

    updatePerView() {
        if (window.innerWidth >= 1024) {
            this.perView = 3;
        } else if (window.innerWidth >= 768) {
            this.perView = 2;
        } else {
            this.perView = 1;
        }

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
        this.updatePerView();
        window.addEventListener("resize", () => this.updatePerView());
        window.addEventListener("keydown", (event) => {
            if (!this.isFullscreen) return;

            if (event.key === "Escape") this.closeFullscreen();
            if (event.key === "ArrowRight") this.nextFullscreen();
            if (event.key === "ArrowLeft") this.prevFullscreen();
        });
    },
});
