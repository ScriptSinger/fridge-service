export default (payload = {}) => ({
    form: {
        name: "",
        phone: "",
        comment: "",
        privacy_policy: false,
    },

    loading: false,
    success: false,
    errors: {},

    init() {
        window.addEventListener("lead:success", () => {
            this.loading = false;
            this.errors = {};
            this.success = true;
        });
    },

    async submit() {
        this.loading = true;
        this.errors = {};
        this.success = false;

        try {
            // POST-запрос через Axios (он уже подключён в bootstrap.js)
            const { data } = await axios.post("/api/leads", {
                ...this.form, // поля формы
                ...payload, // leadable_type, leadable_id, UTM и др.
            });

            // Если успешно
            this.success = true;
            window.dispatchEvent(new CustomEvent("lead:success"));
            // очищаем форму
            this.form.name = "";
            this.form.phone = "";
            this.form.comment = "";
            this.form.privacy_policy = false;
        } catch (err) {
            // Если валидация не прошла
            if (err.response?.status === 422) {
                this.errors = err.response.data.errors || {};
            } else {
                console.error(err); // для других ошибок
            }
        } finally {
            this.loading = false;
        }
    },
});
