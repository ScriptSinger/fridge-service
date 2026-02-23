export default function brandSelect(brands = []) {
    return {
        open: false,
        search: "",
        brands: brands,
        get filtered() {
            return this.brands.filter((b) => {
                const query = this.search.toLowerCase();
                const name = b.name.toLowerCase();
                const nameRu = (b.name_ru ?? "").toLowerCase();
                return name.includes(query) || nameRu.includes(query);
            });
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
