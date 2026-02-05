window.modalPhone = function () {
    return {
        open: false,

        openModal() {
            this.open = true;
            document.body.classList.add("overflow-hidden");
        },
        closeModal() {
            this.open = false;
            document.body.classList.remove("overflow-hidden");
        },
        submit() {
            console.log("Телефон:", this.$refs.phone.value);
            this.closeModal();
        },
    };
};
