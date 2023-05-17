<template>
    <div class="page-content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div
                            class="d-flex flex-column align-items-center text-center"
                        >
                            <img
                                src="/images/avatar.png"
                                alt="Admin"
                                class="rounded-circle p-1 bg-primary"
                                width="110"
                            />
                            <div class="mt-3">
                                <h4>Poručio/la: {{ customer?.name }}</h4>

                                <a
                                    v-if="customer?.email"
                                    class="text-muted font-size-sm py-2"
                                    >{{ customer?.email }}</a
                                >

                                <p
                                    class="text-muted font-size-sm py-2"
                                    v-if="customer?.phone"
                                >
                                    {{ customer?.phone }}
                                </p>

                                <a
                                    class="btn btn-primary"
                                    :href="`mailto:${customer?.email}`"
                                    >Pošalji poruku</a
                                >
                            </div>
                        </div>

                        <hr class="my-4" />
                        <ul
                            class="list-group list-group-flush"
                            v-if="customer?.street || customer?.city"
                        >
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                            >
                                <h6 class="mb-0">Ulica</h6>
                                <span class="text-secondary">{{
                                    customer?.street
                                }}</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                            >
                                <h6 class="mb-0">Grad</h6>
                                <span class="text-secondary">{{
                                    customer?.city
                                }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <!-- <div class="card bordered-10">
                    <div class="card-header">
                        <h4>
                            Detalji porudžbine
                            <span class="text-primary fw-bold">{{
                                order.order_number
                            }}</span>
                        </h4>
                    </div>
                    <div class="card-body mt-3">
                        {{ order.delivery_type }}
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Tip dostave</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <select
                                    v-model="order.delivery_type"
                                    class="form-select"
                                >
                                    <option
                                        value="Dostava"
                                        :selected="
                                            order.delivery_type == 'Dostava'
                                        "
                                    >
                                        Dostava
                                    </option>
                                    <option
                                        value="Lično"
                                        :selected="
                                            order.delivery_type == 'Lično'
                                        "
                                    >
                                        Lično
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Datum porudžbine</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="order.order_date"
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Poručeno sa</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <select
                                    v-model="order.order_from"
                                    class="form-select"
                                >
                                    <option
                                        value="Facebook"
                                        :selected="
                                            order.order_from == 'Facebook'
                                        "
                                    >
                                        Facebook
                                    </option>
                                    <option
                                        value="Viber"
                                        :selected="order.order_from == 'Viber'"
                                    >
                                        Viber
                                    </option>
                                    <option
                                        value="Instagram"
                                        :selected="
                                            order.order_from == 'Instagram'
                                        "
                                    >
                                        Instagram
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Suma porudžbine</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="order.price"
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Porudžbina kreirana</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input
                                    type="text"
                                    class="form-control"
                                    disabled
                                    v-model="order.created_at"
                                />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Status porudžbine</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <select
                                    class="form-select"
                                    id="status"
                                    name="status"
                                    v-model="order.status_id"
                                >
                                    <option
                                        v-for="(status, index) in statuses"
                                        :key="index"
                                        :selected="
                                            status.id === order.status_id
                                        "
                                        :value="status.id"
                                    >
                                        {{ status.status }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div
                            v-if="
                                order.delivery &&
                                order.delivery_type == 'Dostava'
                            "
                        >
                            <h5 class="text-primary">Detalji slanja</h5>
                            <hr />
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">
                                        Ime i prezime kome se šalje
                                    </h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="order.delivery.name"
                                    />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Ulica gde se šalje</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="order.delivery.street"
                                    />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Grad gde se šalje</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="order.delivery.city"
                                    />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Telefon za kontakt</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="order.delivery.phone"
                                    />
                                </div>
                            </div>
                        </div>

                        <div v-else-if="order.delivery_type == 'Dostava'">
                            <h5 class="text-primary">Detalji slanja</h5>
                            <hr />
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">
                                        Ime i prezime kome se šalje
                                    </h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="delivery_name"
                                    />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Ulica gde se šalje</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="delivery_street"
                                    />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Grad gde se šalje</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="delivery_city"
                                    />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Telefon za kontakt</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="delivery_phone"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12text-secondary">
                                <a
                                    @click.prevent="updateOrder()"
                                    class="btn btn-primary px-4 float-end"
                                    >Snimi izmene</a
                                >
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="row" v-if="customer.orders.length > 0">
                    <div class="col-sm-12">
                        <div class="card bordered-10">
                            <div class="card-body">
                                <div class="card-header mb-0">
                                    <h5 class="mb-1">
                                        Broj porudžbina
                                        {{ customer.orders.length }}
                                    </h5>
                                </div>

                                <table
                                    id="badges"
                                    class="table table-bordered table-striped my-3"
                                    style="width: 100%"
                                >
                                    <thead>
                                        <tr>
                                            <th>Broj porudžbine</th>
                                            <th>Datum porudžbine</th>
                                            <th>Tip dostave</th>
                                            <th>Poručeno sa</th>
                                            <th>Broj proizvoda</th>
                                            <th>Status</th>
                                            <th>Detalji</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                order, index
                                            ) in customer.orders"
                                            :key="index"
                                        >
                                            <td class="fw-bold">
                                                {{ order.order_number }}
                                            </td>

                                            <td class="fw-bold">
                                                {{
                                                    order.order_date
                                                        | formatDate
                                                }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ order.delivery_type }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ order.order_from }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ order.order_items.length }}
                                            </td>
                                            <td class="fw-bold">
                                                <span
                                                    class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                                                >
                                                    <i
                                                        class="bx bxs-circle me-1"
                                                    ></i
                                                    >{{ order.status.status }}
                                                </span>
                                            </td>
                                            <td>
                                                <a
                                                    :href="`/order/${order.id}`"
                                                    class="btn btn-primary btn-sm radius-30 px-4"
                                                    >Detalji
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
    props: ["customer_id"],
    data() {
        return {
            customer: {},
        };
    },

    computed: {
        // ...mapGetters({
        //     order: "order/order",
        //     statuses: "order/statuses",
        // }),
    },

    mounted() {
        axios.get(`/api/customers/${this.customer_id}`).then((resp) => {
            this.customer = resp.data.customer_orders;
        });
    },

    methods: {
        ...mapActions({
            getOrder: "order/getOrder",
            deleteOrderItem: "order/deleteOrderItem",
        }),
    },
};
</script>
