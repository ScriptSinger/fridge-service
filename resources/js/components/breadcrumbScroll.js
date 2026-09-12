export default function breadcrumbScroll() {
    return {
        canScrollRight: false,
        onScroll: null,
        onResize: null,

        init() {
            this.update();
            this.onScroll = () => this.update();
            this.onResize = () => this.update();
            this.$refs.nav.addEventListener("scroll", this.onScroll);
            window.addEventListener("resize", this.onResize);
        },

        update() {
            const nav = this.$refs.nav;
            this.canScrollRight = nav.scrollWidth > nav.clientWidth + nav.scrollLeft + 1;
        },

        destroy() {
            if (this.onScroll) {
                this.$refs.nav.removeEventListener("scroll", this.onScroll);
            }
            if (this.onResize) {
                window.removeEventListener("resize", this.onResize);
            }
        },
    };
}
