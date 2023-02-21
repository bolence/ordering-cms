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
                                src="/assets/images/avatars/avatar-2.png"
                                alt="Admin"
                                class="rounded-circle p-1 bg-primary"
                                width="110"
                            />
                            <div class="mt-3">
                                <h4>Poručio/la: {{ order.customer?.name }}</h4>

                                <a
                                    v-if="order.customer?.email"
                                    class="text-muted font-size-sm py-2"
                                    >{{ order.customer?.email }}</a
                                >

                                <p
                                    class="text-muted font-size-sm py-2"
                                    v-if="order.customer?.phone"
                                >
                                    {{ order.customer?.phone }}
                                </p>

                                <a
                                    class="btn btn-primary"
                                    :href="`mailto:${order.customer?.email}`"
                                    >Pošalji poruku</a
                                >
                            </div>
                        </div>

                        <hr class="my-4" />
                        <ul
                            class="list-group list-group-flush"
                            v-if="
                                order.customer?.street || order.customer?.city
                            "
                        >
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                            >
                                <h6 class="mb-0">Ulica</h6>
                                <span class="text-secondary">{{
                                    order.customer?.street
                                }}</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                            >
                                <h6 class="mb-0">Grad</h6>
                                <span class="text-secondary">{{
                                    order.customer?.city
                                }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card bordered-10">
                    <div class="card-header">
                        <h4>
                            Detalji porudžbine
                            <span class="text-primary fw-bold">{{
                                order.order_number
                            }}</span>
                        </h4>
                    </div>
                    <div class="card-body mt-3">
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
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="order.order_from"
                                />
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

                        <div v-if="order.delivery_type == 'Dostava'">
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
                                        :value="order.delivery.name"
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
                                        :value="order.delivery.street"
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
                                        :value="order.delivery.city"
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
                                        :value="order.delivery.phone"
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
                </div>

                <div class="row" v-if="order.order_items?.length > 0">
                    <div class="col-sm-12">
                        <div class="card bordered-10">
                            <div class="card-body">
                                <div class="card-header mb-0">
                                    <h5 class="d-flex align-items-center mb-1">
                                        Porudžbina sadrži
                                        <!-- {{ $order->order_items->sum('quantity') }} -->
                                        proizvoda
                                    </h5>
                                </div>

                                <table
                                    id="badges"
                                    class="table table-bordered my-3"
                                    style="width: 100%"
                                >
                                    <thead>
                                        <tr>
                                            <th>Tip</th>
                                            <th>Veličina bedža/majice</th>
                                            <th>Tip kačenja/ Boja majice</th>
                                            <th>Plastifikacija/Tip majice</th>
                                            <th>Količina</th>
                                            <th>Akcije</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                order_item, index
                                            ) in order.order_items"
                                            :key="index"
                                        >
                                            <td class="fw-bold">
                                                {{
                                                    order_item.type | capitalize
                                                }}
                                            </td>
                                            <td>
                                                {{
                                                    order_item.badge_size
                                                        ? order_item.badge_size +
                                                          "mm"
                                                        : order_item.tshirt_size
                                                          | capitalize
                                                }}
                                            </td>
                                            <td>
                                                {{
                                                    order_item.tip_kacenja
                                                        ? order_item.tip_kacenja
                                                        : order_item.tshirt_color

                                                }}
                                            </td>
                                            <td>
                                                {{
                                                    order_item.plastifikacija &&
                                                    order_item.type == "bedž"
                                                        ? order_item.plastifikacija
                                                        : order_item.tshirt_type
                                                          | capitalize
                                                }}
                                            </td>
                                            <td>{{ order_item.quantity }}</td>
                                            <td>
                                                <a
                                                    href=""
                                                    @click.prevent="
                                                        orderItemDelete(index)
                                                    "
                                                    ><i
                                                        class="bx bxs-trash text-danger"
                                                    ></i
                                                ></a>
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
    props: ["order_id"],
    data() {
        return {};
    },

    computed: {
        ...mapGetters({
            order: "order/order",
            statuses: "order/statuses",
        }),
    },

    mounted() {
        this.getOrder({ id: this.order_id });
    },

    methods: {
        ...mapActions({
            getOrder: "order/getOrder",
            deleteOrderItem: "order/deleteOrderItem",
        }),

        orderItemDelete(index) {
            this.order.order_items.splice(index, 1);
        },

        updateOrder() {
            console.log(this.order);
        },
    },
};
</script>
