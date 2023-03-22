<template>
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <div
                class="card border-top border-bottom border-0 border-3 border-primary bordered-15"
            >
                <div class="card-body p-4">
                    <div
                        class="card-title d-flex align-items-center justify-content-between"
                    >
                        <div class="col-md-6">
                            <h5 class="mb-0">
                                <i
                                    class="bx bxs-book me-1 font-22 text-primary"
                                ></i>
                                Nova porudžbina
                            </h5>
                        </div>

                        <div class="col-mx-auto float-end">
                            <div class="form-check form-check-inline pl-2">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    value="tshirt"
                                    id="tshirt"
                                    name="order_type"
                                    v-model="data.order_type"
                                />
                                <label
                                    class="form-check-label fw-bold"
                                    for="tshirt"
                                    >Majice</label
                                >
                            </div>

                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    value="badges"
                                    id="badges"
                                    name="order_type"
                                    v-model="data.order_type"
                                />
                                <label
                                    class="form-check-label fw-bold"
                                    for="badges"
                                    >Bedževi</label
                                >
                            </div>
                        </div>
                    </div>

                    <hr class="fancy" />
                    <form class="row g-3 pb-3">
                        <div class="col-md-3">
                            <label for="name" class="form-label fw-bold"
                                >Datum porudžbine</label
                            >
                            <div class="input-group">
                                <datepicker
                                    v-model="data.order_date"
                                    placeholder="Datum porudžbine"
                                    name="order_date"
                                    format="dd MMM yyyy"
                                    type="date"
                                    style="width: 100%"
                                    :input-class="{
                                        'form-control': true,
                                        'is-invalid': errors.order_date,
                                    }"
                                    calendar-button-icon="fa fa-calendar"
                                ></datepicker>
                            </div>
                            <div
                                v-if="errors?.order_date"
                                class="invalid-feedback error-message"
                            >
                                {{ errors.order_date[0] }}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="name" class="form-label fw-bold"
                                >Datum isporuke</label
                            >
                            <div class="input-group">
                                <datepicker
                                    v-model="data.delivery_date"
                                    placeholder="Datum isporuke"
                                    name="delivery_date"
                                    format="dd MMM yyyy"
                                    type="date"
                                    style="width: 100%"
                                    :input-class="{
                                        'form-control': true,
                                        'is-invalid': errors.delivery_date,
                                    }"
                                    calendar-button-icon="fa fa-calendar"
                                ></datepicker>
                            </div>
                            <div
                                v-if="errors?.delivery_date"
                                class="invalid-feedback error-message"
                            >
                                {{ errors.delivery_date[0] }}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="name" class="form-label fw-bold"
                                >Ime i prezime</label
                            >

                            <div class="input-group">
                                <span class="input-group-text bg-transparent"
                                    ><i class="bx bxs-user"></i
                                ></span>

                                <input
                                    type="text"
                                    class="form-control border-start-0"
                                    id="name"
                                    name="name"
                                    :class="{
                                        'is-invalid': errors['customer.name'],
                                    }"
                                    v-model="data.customer.name"
                                    placeholder="Unesi ime i prezime mušterije"
                                />
                            </div>

                            <div
                                v-if="errors['customer.name']"
                                class="invalid-feedback error-message"
                            >
                                {{ errors["customer.name"][0] }}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="company" class="form-label fw-bold"
                                >Firma</label
                            >
                            <div class="input-group">
                                <span class="input-group-text bg-transparent"
                                    ><i class="bx bx-home-circle"></i
                                ></span>
                                <input
                                    type="text"
                                    class="form-control border-start-0"
                                    id="company"
                                    name="company"
                                    v-model="data.customer.company"
                                    placeholder="Unesi ime firme"
                                />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="phone" class="form-label fw-bold"
                                >Telefon</label
                            >
                            <div class="input-group">
                                <span class="input-group-text bg-transparent"
                                    ><i class="bx bxs-phone"></i
                                ></span>
                                <input
                                    type="text"
                                    class="form-control border-start-0"
                                    id="comphoneany"
                                    name="phone"
                                    :class="{
                                        'is-invalid': errors['customer.phone'],
                                    }"
                                    v-model="data.customer.phone"
                                    placeholder="Unesi telefon"
                                />
                            </div>
                            <div
                                v-if="errors['customer.phone']"
                                class="invalid-feedback error-message"
                            >
                                {{ errors["customer.phone"][0] }}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="email" class="form-label fw-bold"
                                >Email adresa</label
                            >
                            <div class="input-group">
                                <span class="input-group-text bg-transparent"
                                    ><i class="bx bxs-envelope"></i
                                ></span>
                                <input
                                    type="email"
                                    class="form-control border-start-0"
                                    id="email"
                                    v-model="data.customer.email"
                                    :class="{
                                        'is-invalid': errors['customer.email'],
                                    }"
                                    placeholder="Unesi email adresu"
                                />
                            </div>
                            <div
                                v-if="errors['customer.email']"
                                class="invalid-feedback error-message"
                            >
                                {{ errors["customer.email"][0] }}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="from" class="form-label fw-bold"
                                >Poručeno sa:</label
                            >
                            <div class="input-group">
                                <span class="input-group-text bg-transparent"
                                    ><i class="bx bxl-facebook"></i
                                ></span>
                                <select
                                    id="order_from"
                                    name="order_from"
                                    v-model="data.order_from"
                                    class="form-select"
                                    :class="{
                                        'is-invalid': errors.order_from,
                                    }"
                                >
                                    <option value="null">
                                        Izaberi odakle je poručeno
                                    </option>
                                    <option value="email">Email</option>
                                    <option value="facebook">Facebook</option>
                                    <option value="instagram">Instagram</option>
                                    <option value="viber">Viber</option>
                                </select>
                            </div>
                            <div
                                v-if="errors['order_from']"
                                class="invalid-feedback error-message"
                            >
                                {{ errors.order_from[0] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <label for="payment" class="form-label fw-bold"
                                >Plaćanje:</label
                            >
                            <div class="form-check px-1">
                                <div class="form-check form-check-inline mt-2">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        value="keš"
                                        id="cash"
                                        name="payment"
                                        :class="{
                                            'is-invalid': errors.payment_type,
                                        }"
                                        v-model="data.payment_type"
                                    />
                                    <label class="form-check-label" for="cash"
                                        >Gotovina</label
                                    >
                                </div>

                                <div class="form-check form-check-inline mt-2">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        value="virman"
                                        id="virman"
                                        name="payment"
                                        v-model="data.payment_type"
                                        :class="{
                                            'is-invalid': errors.payment_type,
                                        }"
                                    />
                                    <label class="form-check-label" for="virman"
                                        >Virman</label
                                    >
                                </div>
                            </div>
                            <div
                                v-if="errors.payment_type"
                                class="invalid-feedback error-message"
                            >
                                {{ errors.payment_type[0] }}
                            </div>
                        </div>

                        <div class="col-auto">
                            <label for="payment" class="form-label fw-bold"
                                >Dostava:</label
                            >
                            <div class="form-check px-1">
                                <div class="form-check form-check-inline mt-2">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        value="lično"
                                        id="lično"
                                        name="delivery"
                                        v-model="data.delivery_type"
                                        :class="{
                                            'is-invalid': errors.delivery_type,
                                        }"
                                    />
                                    <label class="form-check-label" for="lično"
                                        >Lično</label
                                    >
                                </div>

                                <div class="form-check form-check-inline mt-2">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        value="dostava"
                                        id="dostava"
                                        name="delivery"
                                        v-model="data.delivery_type"
                                        :class="{
                                            'is-invalid': errors.delivery_type,
                                        }"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="dostava"
                                        >Dostava</label
                                    >
                                </div>
                            </div>
                            <div
                                v-if="errors.delivery_type"
                                class="invalid-feedback error-message"
                            >
                                {{ errors.delivery_type[0] }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label
                                for="inputChoosePassword"
                                class="form-label fw-bold"
                                >Napomena</label
                            >
                            <div>
                                <textarea
                                    id="napomena"
                                    name="napomena"
                                    class="form-control"
                                    rows="6"
                                    cols="10"
                                    v-model="data.napomena"
                                ></textarea>
                            </div>
                        </div>

                        <hr class="fancy" v-if="data.order_type" />

                        <TshirtForm :type="data.order_type" />
                        <BadgeForm :type="data.order_type" />

                        <div
                            class="row pt-3"
                            v-if="data.delivery_type == 'dostava'"
                        >
                            <div
                                class="d-flex justify-content-between align-items-center"
                            >
                                <h5 class="mb-0 text-uppercase pb-3">
                                    Podaci za dostavu
                                </h5>
                                <span class="float-end">
                                    <div
                                        class="form-check form-check-inline mt-2"
                                    >
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            :value="true"
                                            id="customer_details"
                                            name="customer_details"
                                            @change="setSamePhone()"
                                            v-model="
                                                data.customer.customer_details
                                            "
                                        />
                                        <label
                                            class="form-check-label"
                                            for="customer_details"
                                            >Dostavlja se poručiocu</label
                                        >
                                    </div>
                                </span>
                            </div>

                            <div class="col-md-3">
                                <label for="name" class="form-label"
                                    >Ime/Firma</label
                                >
                                <input
                                    class="form-control"
                                    id="delivery_name"
                                    name="delivery_name"
                                    v-model="data.delivery.name"
                                    placeholder="Ime ili firma"
                                />
                            </div>

                            <div class="col-md-3">
                                <label for="street" class="form-label"
                                    >Ulica</label
                                >
                                <input
                                    class="form-control"
                                    id="street"
                                    name="street"
                                    v-model="data.delivery.street"
                                    placeholder="Ulica i broj"
                                />
                            </div>

                            <div class="col-md-3">
                                <label for="street" class="form-label"
                                    >Grad</label
                                >
                                <input
                                    class="form-control"
                                    id="city"
                                    name="city"
                                    v-model="data.delivery.city"
                                    placeholder="Grad"
                                />
                            </div>
                            <div class="col-md-3">
                                <label for="phone2" class="form-label"
                                    >Telefon</label
                                >
                                <input
                                    class="form-control"
                                    id="phone2"
                                    name="phone2"
                                    v-model="data.delivery.phone"
                                    placeholder="Telefon"
                                />
                            </div>
                        </div>

                        <div
                            class="col-12 pt-5 d-flex justify-content-between align-items-center"
                        >
                            <div class="col-md-3">
                                <input
                                    class="form-control"
                                    id="price"
                                    name="price"
                                    v-model="data.price"
                                    :class="{
                                        'is-invalid': errors.price,
                                    }"
                                    placeholder="Suma porudžbine"
                                />
                                <div
                                    v-if="errors.price"
                                    class="invalid-feedback error-message"
                                >
                                    {{ errors.price[0] }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <a
                                    @click.prevent="makeOrder()"
                                    class="btn btn-primary px-2 float-end"
                                >
                                    <i class="bx bxs-save"></i>SNIMI
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div
                class="card border-top border-bottom border-0 border-3 border-danger"
                v-if="newOrder.tshirt.length > 0"
            >
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                        <div class="position-relative">
                            <h3>
                                Količina majica
                                {{ newOrder.tshirt.length }} kom.
                            </h3>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Boja</th>
                                    <th>Veličina</th>
                                    <th>Tip majice</th>
                                    <th>Količina</th>
                                    <th>Datum</th>
                                    <th>Akcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in newOrder.tshirt"
                                    :key="index"
                                >
                                    <td>
                                        {{ item.tshirt_color }}
                                    </td>
                                    <td>
                                        {{ item.tshirt_size }}
                                    </td>
                                    <td>
                                        {{ item.tshirt_type }}
                                    </td>
                                    <td>{{ item.quantity }}</td>

                                    <td>{{ date }}</td>

                                    <td>
                                        <div class="d-flex order-actions">
                                            <a
                                                href=""
                                                class="ms-3"
                                                @click.prevent="
                                                    removeTshirt(index)
                                                "
                                                ><i
                                                    class="bx bxs-trash text-danger"
                                                ></i
                                            ></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div
                class="card border-top border-bottom border-0 border-3 border-success"
                v-if="newOrder.badges.length > 0"
            >
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                        <div class="position-relative">
                            <h3>
                                Količina bedževa
                                {{ newOrder.badges.length }} kom.
                            </h3>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Veličina</th>
                                    <th>Tip kačenja</th>
                                    <th>Plastifikacija</th>
                                    <th>Količina</th>
                                    <th>Datum</th>
                                    <th>Akcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in newOrder.badges"
                                    :key="index"
                                >
                                    <td>
                                        {{ item.badge_size }}
                                    </td>
                                    <td>{{ item.tip_kacenja }}</td>
                                    <td>
                                        {{ item.plastifikacija }}
                                    </td>
                                    <td>{{ item.quantity }}</td>
                                    <td>{{ date }}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a
                                                href=""
                                                class="ms-3"
                                                @click.prevent="
                                                    removeBadge(index)
                                                "
                                                ><i
                                                    class="bx bxs-trash text-danger"
                                                ></i
                                            ></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Datepicker from "vuejs-datepicker/dist/vuejs-datepicker.esm.js";
import TshirtForm from "./TshirtFormComponent.vue";
import BadgeForm from "./BadgeFormComponent.vue";
import moment from "moment";
export default {
    components: {
        Datepicker,
        TshirtForm,
        BadgeForm,
    },
    data() {
        return {
            date: moment().format("DD.MM.YYYY"),
            data: {
                customer: {
                    name: null,
                    company: null,
                    phone: null,
                    email: null,
                    customer_details: false,
                },
                delivery: {
                    street: null,
                    city: null,
                    street: null,
                    phone: null,
                    name: null,
                },
                order_from: null,
                delivery_type: null,
                order_date: moment().format("DD MMM yyyy"),
                order_type: null,
                payment_type: null,
                napomena: null,
                price: null,
                delivery_date: moment().add(7, "days").format("DD MMM yyyy"), // added 7 days to order_date default date
            },
        };
    },

    mounted() {
        axios.get("/api/customers").then((resp) => {
            this.customers = resp.data.customers;
        });
    },

    computed: {
        ...mapGetters({
            errors: "order/errors",
            newOrder: "order/newOrder",
        }),
    },

    methods: {
        ...mapActions({
            saveOrder: "order/saveOrder",
            getNotifications: "notification/getNotifications",
        }),

        makeOrder() {
            Object.assign(this.data, this.newOrder);

            this.saveOrder(this.data)
                .then((resp) => {
                    this.$awn.success(resp.message);
                    this.clearForm();
                    setTimeout(() => {
                        this.getNotifications();
                    }, 1000);
                })
                .catch((error) => {
                    this.$awn.alert(error.message);
                });
        },

        clearForm() {
            this.data = {};
            this.data.customer = {};
            this.data.delivery = {};
            this.newOrder.tshirt = {};
            this.newOrder.badges = {};
        },

        removeTshirt(index) {
            this.newOrder.tshirt.splice(index, 1);
        },

        removeBadge(index) {
            this.newOrder.badges.splice(index, 1);
        },

        setSamePhone() {
            this.data.delivery.phone = this.data.customer.phone;
            this.data.delivery.name = this.data.customer.name;
        },
    },
};
</script>

<style>
hr.fancy {
    width: 100%;
    border: 0;
    height: 1px;
    background-image: linear-gradient(
        to right,
        rgba(0, 0, 0, 0),
        rgba(0, 0, 0, 0.75),
        rgba(0, 0, 0, 0)
    );
}

input[type="radio"] {
    transform: scale(1.5);
}

input[type="checkbox"] {
    transform: scale(1.5);
}
</style>
