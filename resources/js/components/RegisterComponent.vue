<template>
    <div
        class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0"
    >
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                <div class="col mx-auto">
                    <div class="my-4 text-center">
                        <a href="/"
                            ><img src="images/logo.png" width="180" alt=""
                        /></a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                    <h3 class="">Sign Up</h3>
                                    <p>
                                        Already have an account?
                                        <a href="authentication-signin.html"
                                            >Sign in here</a
                                        >
                                    </p>
                                </div>
                                <div class="d-grid">
                                    <a
                                        class="btn my-4 shadow-sm btn-white"
                                        href="javascript:;"
                                    >
                                        <span
                                            class="d-flex justify-content-center align-items-center"
                                        >
                                            <img
                                                class="me-2"
                                                src="assets/images/icons/search.svg"
                                                width="16"
                                                alt="Image Description"
                                            />
                                            <span>Sign Up with Google</span>
                                        </span>
                                    </a>
                                    <a
                                        href="javascript:;"
                                        class="btn btn-facebook"
                                        ><i class="bx bxl-facebook"></i>Sign Up
                                        with Facebook</a
                                    >
                                </div>
                                <div class="login-separater text-center mb-4">
                                    <span>OR SIGN UP WITH EMAIL</span>
                                    <hr />
                                </div>
                                <div class="form-body">
                                    <form class="row g-3">
                                        <div class="col-12">
                                            <label
                                                for="inputFirstName"
                                                class="form-label"
                                                >Ime i prezime</label
                                            >
                                            <input
                                                type="text"
                                                name="name"
                                                v-model="data.name"
                                                class="form-control"
                                                id="name"
                                                :class="{
                                                    'is-invalid': errors.name,
                                                }"
                                                placeholder="Jhon"
                                            />
                                            <div
                                                v-if="errors.name"
                                                class="invalid-feedback"
                                                style="
                                                    display: block !important;
                                                    font-size: 17px !important;
                                                "
                                            >
                                                {{ errors.name[0] }}
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label
                                                for="inputEmailAddress"
                                                class="form-label"
                                                >Email Address</label
                                            >
                                            <input
                                                type="email"
                                                class="form-control"
                                                id="email"
                                                name="email"
                                                v-model="data.email"
                                                placeholder="example@user.com"
                                                :class="{
                                                    'is-invalid': errors.email,
                                                }"
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
                                                    v-model="data.password"
                                                    name="password"
                                                    type="password"
                                                    class="form-control border-end-0"
                                                    value="12345678"
                                                    placeholder="Unesi šifru"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.password,
                                                    }"
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

                                        <div class="col-12">
                                            <label
                                                for="inputChoosePassword"
                                                class="form-label"
                                                >Unesi šifru</label
                                            >
                                            <div class="input-group">
                                                <input
                                                    v-model="
                                                        data.password_confirmation
                                                    "
                                                    name="password"
                                                    type="password"
                                                    class="form-control border-end-0"
                                                    value="12345678"
                                                    placeholder="Unesi šifru"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.password_confirmation,
                                                    }"
                                                />
                                                <a
                                                    href="javascript:;"
                                                    class="input-group-text bg-transparent"
                                                    ><i class="bx bx-hide"></i
                                                ></a>

                                                <div
                                                    v-if="
                                                        errors.password_confirmation
                                                    "
                                                    class="invalid-feedback"
                                                    style="
                                                        display: block !important;
                                                        font-size: 17px !important;
                                                    "
                                                >
                                                    {{
                                                        errors
                                                            .password_confirmation[0]
                                                    }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <a href="/login" class="float-end"
                                                >Već imam nalog</a
                                            >
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <a
                                                    @click.prevent="
                                                        doRegister()
                                                    "
                                                    class="btn btn-primary"
                                                >
                                                    <i class="bx bx-user"></i
                                                    >Sign up
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
            data: {
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
            },
            errors: {},
        };
    },

    computed: {},

    methods: {
        doRegister() {
            if (
                !this.data.email &&
                !this.data.password &&
                !this.data.name &&
                !this.password_confirmation
            ) {
                return;
            }

            axios
                .post("/register", this.data)
                .then((resp) => {
                    let jwt = resp.data.token;
                    let user = JSON.stringify(resp.data.user);
                    localStorage.setItem("bedzevi.jwt", token);
                    localStorage.setItem("bedzevi.user", user);
                    window.location.href = "/";
                })
                .catch((error) => {
                    this.$awn.alert(error.response.data.message);
                    this.errors = error.response.data.errors;
                });
        },
    },
};
</script>
