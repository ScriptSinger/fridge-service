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
    submissionError: "",

    async submit() {
        this.loading = true;
        this.errors = {};
        this.success = false;
        this.submissionError = "";

        try {
            // POST-запрос через Axios (он уже подключён в bootstrap.js)
            await axios.post("/api/leads", {
                ...this.form, // поля формы
                ...payload, // leadable_type, leadable_id, UTM и др.
            });

            // Если успешно
            this.success = true;
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
                this.submissionError =
                    "Не удалось отправить заявку. Попробуйте ещё раз или позвоните нам.";
                console.error(err);
            }
        } finally {
            this.loading = false;
        }
    },
});
