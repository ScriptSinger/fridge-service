export default function galleryCard(detailUrl) {
    return {
        imageModalOpen: false,
        detailUrl,
        previousUrl: null,
        popstateHandler: null,
        openModal() {
            this.previousUrl = window.location.href;
            this.imageModalOpen = true;
            document.body.style.overflow = "hidden";

            if (!this.popstateHandler) {
                this.popstateHandler = () => {
                    this.imageModalOpen = false;
                    document.body.style.overflow = "";
                    window.removeEventListener("popstate", this.popstateHandler);
                };
            }

            window.addEventListener("popstate", this.popstateHandler);

            if (this.detailUrl && history && history.pushState) {
                history.pushState({ galleryModal: true }, "", this.detailUrl);
            }
        },
        closeModal() {
            this.imageModalOpen = false;
            document.body.style.overflow = "";

            if (this.popstateHandler) {
                window.removeEventListener("popstate", this.popstateHandler);
            }

            if (history && history.state && history.state.galleryModal) {
                history.back();
            } else if (this.previousUrl) {
                history.pushState(null, "", this.previousUrl);
            }
        },
    };
}
