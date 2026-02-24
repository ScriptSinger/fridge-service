export default function brandCarousel(slides = [], speed = 0.5) {
    return {
        slides: [...slides, ...slides], // дублируем для бесконечности
        speed: speed,
        offset: 0,
        frame: null,

        init() {
            this.start();
        },

        start() {
            const step = () => {
                this.offset -= this.speed;

                const halfWidth = this.$el.scrollWidth / 2;

                if (Math.abs(this.offset) >= halfWidth) {
                    this.offset = 0;
                }

                this.frame = requestAnimationFrame(step);
            };

            this.frame = requestAnimationFrame(step);
        },

        stopAutoplay() {
            cancelAnimationFrame(this.frame);
        },

        startAutoplay() {
            this.start();
        },

        translateX() {
            return `transform: translateX(${this.offset}px)`;
        },
    };
}
