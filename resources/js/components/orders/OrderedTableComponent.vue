<template>
    <fragment>
        <EditTshirtComponent
            :orderItem="orderItem"
            :type="type"
            :orderId="order.id"
        />
        <EditBadgeComponent
            :orderItem="orderItem"
            :type="type"
            :orderId="order.id"
        />
        <div class="row" v-if="order.order_items?.length > 0">
            <div class="col-sm-12">
                <div class="card bordered-10">
                    <div class="card-body">
                        <div class="card-header mb-0">
                            <div
                                class="d-flex justify-content-between align-items-center"
                            >
                                <h5 class="mb-1">
                                    Porudžbina sadrži
                                    {{ order.order_items.length }}
                                    proizvod/a
                                </h5>
                                <span>
                                    <a
                                        href=""
                                        style="font-size: 25px"
                                        class="fw-bolder"
                                        v-b-tooltip.hover
                                        title="Dodaj majicu u porudžbinu"
                                        @click.prevent="addMore('majica')"
                                        ><i
                                            class="bx bxs-t-shirt text-primary"
                                        ></i
                                    ></a>

                                    <a
                                        href=""
                                        style="font-size: 25px"
                                        class="fw-bolder"
                                        v-b-tooltip.hover
                                        title="Dodaj bedž u porudžbinu"
                                        @click.prevent="addMore('bedž')"
                                        ><i
                                            class="bx bxs-badge text-success"
                                        ></i
                                    ></a>
                                </span>
                            </div>
                        </div>
                        <div class="tab-content table-responsive">
                            <table
                                id="badges"
                                class="table table-bordered my-3"
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
                                            {{ order_item.type | capitalize }}
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
                                        <td>
                                            {{ order_item.quantity }}
                                        </td>
                                        <td>
                                            <a
                                                href=""
                                                style="font-size: 20px"
                                                @click.prevent="
                                                    orderItemDelete(
                                                        index,
                                                        order_item.id
                                                    )
                                                "
                                                ><i
                                                    class="bx bxs-trash text-danger"
                                                ></i
                                            ></a>

                                            <a
                                                href=""
                                                style="font-size: 20px"
                                                @click.prevent="
                                                    orderItemEdit(
                                                        order_item.id,
                                                        order_item.type
                                                    )
                                                "
                                                ><i
                                                    class="bx bxs-pencil text-success"
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
    </fragment>
</template>

<script>
import EditTshirtComponent from "../edit/EditTshirtComponent.vue";
import EditBadgeComponent from "../edit/EditBadgeComponent.vue";
import { mapGetters, mapMutations } from "vuex";
export default {
    props: ["order"],
    components: {
        EditBadgeComponent,
        EditTshirtComponent,
    },
    data() {
        return {
            orderItem: {},
        };
    },

    computed: {
        ...mapGetters({
            type: "order/type",
        }),
    },

    methods: {
        ...mapMutations({
            setType: "order/setType",
            setOrder: "order/setOrder",
            setFormType: "order/setFormType",
        }),

        orderItemDelete(index, orderItemId) {
            this.order.order_items.splice(index, 1);

            axios
                .delete(`/api/order_items/${orderItemId}`)
                .then((resp) => {
                    this.$awn.success(resp.data.message);
                })
                .catch((error) => {
                    this.$awn.alert(error.response.data.message);
                });
        },

        orderItemEdit(orderId, type) {
            this.setType(type);
            this.setFormType("update");

            axios
                .get("/api/order_items/" + orderId)
                .then((resp) => {
                    this.orderItem = resp.data.order_items;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        addMore(type, orderId) {
            this.setType(type);
            this.orderItem = {};
            this.setFormType("add");
        },
    },
};
</script>
