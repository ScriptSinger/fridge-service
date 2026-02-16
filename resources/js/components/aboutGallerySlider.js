export default (slides = []) => ({
    current: 0,
    perView: 1,
    touchStartX: 0,
    slides,

    get maxIndex() {
        return Math.max(this.slides.length - this.perView, 0);
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

    onTouchStart(event) {
        this.touchStartX = event.changedTouches[0].screenX;
    },

    onTouchEnd(event) {
        const touchEndX = event.changedTouches[0].screenX;
        const delta = this.touchStartX - touchEndX;

        if (Math.abs(delta) < 40) return;

        if (delta > 0) {
            this.next();
        } else {
            this.prev();
        }
    },

    init() {
        this.updatePerView();
        window.addEventListener("resize", () => this.updatePerView());
    },
});
