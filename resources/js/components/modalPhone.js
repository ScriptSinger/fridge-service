window.modalPhone = function () {
    return {
        open: false,
        init() {
            if (this.$refs.phone) {
                new Cleave(this.$refs.phone, {
                    phoneRegionCode: "ru",
                    prefix: "+7",
                    delimiter: "-",
                    blocks: [2, 3, 3, 2, 2],
                    uppercase: true,
                });
            }
        },
        openModal() {
            this.open = true;
        },
        closeModal() {
            this.open = false;
        },
        submit() {
            console.log("Телефон:", this.$refs.phone.value);
            this.closeModal();
        },
    };
};
