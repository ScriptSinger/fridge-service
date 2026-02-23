export default function brandSelect(brands = []) {
    return {
        open: false,
        search: "",
        brands: brands,
        get filtered() {
            return this.brands.filter((b) =>
                b.name.toLowerCase().includes(this.search.toLowerCase()),
            );
        },
        goToFirst() {
            if (this.filtered.length > 0) {
                window.location.href = this.filtered[0].url;
            }
        },
        selectBrand(brand) {
            window.location.href = brand.url;
        },
    };
}
