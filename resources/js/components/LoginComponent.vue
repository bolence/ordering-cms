<template>
    <div
        class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0"
    >
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="mb-4 text-center">
                        <a href="/"
                            ><img src="images/logo.png" width="100" alt=""
                        /></a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                    <h3 class="">Ulogujte se</h3>
                                    <p>
                                        Još nemate nalog?
                                        <a href="/register">Registruj se</a>
                                    </p>
                                </div>

                                <div class="form-body">
                                    <form class="row g-3">
                                        <div class="col-12">
                                            <label
                                                for="inputEmailAddress"
                                                class="form-label"
                                                >Email adresa</label
                                            >
                                            <input
                                                type="email"
                                                class="form-control"
                                                :class="{
                                                    'is-invalid': errors.email,
                                                }"
                                                id="email"
                                                name="email"
                                                placeholder="Unesite email adresu"
                                                v-model="email"
                                            />
                                            <div
                                                v-if="errors.email"
                                                class="invalid-feedback"
                                                style="
                                                    display: block !important;
                                                    font-size: 17px !important;
                                                "
                                            >
                                                {{ errors.email[0] }}
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label
                                                for="inputChoosePassword"
                                                class="form-label"
                                                >Unesi šifru</label
                                            >
                                            <div class="input-group">
                                                <input
                                                    type="password"
                                                    class="form-control border-end-0"
                                                    id="password"
                                                    v-model="password"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.password,
                                                    }"
                                                    name="password"
                                                    placeholder="Unesite Password"
                                                />

                                                <a
                                                    href="javascript:;"
                                                    class="input-group-text bg-transparent"
                                                    ><i class="bx bx-hide"></i
                                                ></a>
                                                <div
                                                    v-if="errors.password"
                                                    class="invalid-feedback"
                                                    style="
                                                        display: block !important;
                                                        font-size: 17px !important;
                                                    "
                                                >
                                                    {{ errors.password[0] }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6 text-end">
                                            <a href="">Zaboravljena šifra?</a>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <a
                                                    type="submit"
                                                    class="btn btn-primary"
                                                    @click.prevent="doLogin()"
                                                >
                                                    <i
                                                        class="bx bxs-lock-open"
                                                    ></i
                                                    >Uloguj se
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: null,
            password: null,
            errors: {},
        };
    },

    computed: {},

    methods: {
        doLogin() {
            if (!this.email && !this.password) return;

            let data = {
                email: this.email,
                password: this.password,
            };

            axios
                .post("/login", data)
                .then((resp) => {
                    let token = resp.data.token;
                    let user = JSON.stringify(resp.data.user);
                    localStorage.setItem("bedzevi.jwt", token);
                    localStorage.setItem("bedzevi.user", user);
                    window.location.href = "/";
                })
                .catch((error) => {
                    if(error.response.data.token_missing) {
                        this.$awn.alert('Uradite refresh stranice');
                        return;
                    }
                    this.$awn.alert(error.response.data.message);
                    this.errors = error.response.data.errors;
                });
        },
    },
};
</script>

<style scoped>
body {
    overflow-y: hidden; /* Hide vertical scrollbar */
    overflow-x: hidden; /* Hide horizontal scrollbar */
}
</style>
