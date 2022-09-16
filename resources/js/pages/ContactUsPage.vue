<template>
    <div>
        <form @submit.prevent="sendEmail">
            <div v-if="status" class="alert alert-primary" role="alert">
                Messaggio inviato con successo!
            </div>
            <div class="form-group">
                <label for="name">Nome: </label>
                <input
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': errors.name != null }"
                    id="name"
                    name="name"
                    v-model="name"
                />
                <div
                    v-for="(error, index) in errors.name"
                    :key="index"
                    class="invalid-feedback"
                >
                    {{ error }}
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input
                    type="email"
                    class="form-control"
                    :class="{ 'is-invalid': errors.email != null }"
                    id="email"
                    v-model="email"
                />
                <div
                    v-for="(error, index) in errors.email"
                    :key="index"
                    class="invalid-feedback"
                >
                    {{ error }}
                </div>
            </div>
            <div class="form-group">
                <label for="message">Inserisci il tuo messaggio: </label>
                <textarea
                    class="form-control"
                    :class="{ 'is-invalid': errors.message != null }"
                    id="message"
                    rows="3"
                    v-model="message"
                ></textarea>
                <div
                    v-for="(error, index) in errors.message"
                    :key="index"
                    class="invalid-feedback"
                >
                    {{ error }}
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "ContactUsPage",
    data() {
        return {
            name: "",
            email: "",
            message: "",
            status: false,
            errors: {},
        };
    },
    methods: {
        sendEmail: function () {
            axios
                .post("/api/leads", {
                    name: this.name,
                    email: this.email,
                    message: this.message,
                })
                .then((res) => {
                    if (res.data.success == "false") {
                        console.log(res);
                        this.errors = res.data.errors;
                    } else {
                        this.status = true;
                        this.name = "";
                        this.email = "";
                        this.message = "";
                    }
                });
        },
    },
};
</script>

<style lang="scss" scoped>
div {
    margin-bottom: 1rem;
}
</style>
