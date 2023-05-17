<template>
    <div class="row" v-if="type == 'majica'">
        <div class="col-sm-12">
            <div class="card bordered-10">
                <div class="card-body">
                    <div class="card-header mb-0">
                        <h5>Izmeni/Dodaj majicu</h5>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label>Tip majice</label>
                            <select
                                name="tshirt_type"
                                id="tshirt_type"
                                v-model="orderItem.tshirt_type"
                                class="form-select"
                            >
                                <option value="muška">Muška</option>
                                <option value="ženska">Ženska</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Veličina</label>
                            <select
                                name="size"
                                id="size"
                                v-model="orderItem.tshirt_size"
                                class="form-select"
                            >
                                <option value="xs">XS</option>
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                                <option value="xl">XL</option>
                                <option value="xxl">XXL</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Boja</label>
                            <select
                                name="color"
                                id="color"
                                v-model="orderItem.tshirt_color"
                                class="form-select"
                            >
                                <option value="Crna">Crna</option>
                                <option value="Bela">Bela</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Količina</label>
                            <input
                                class="form-control"
                                v-model="orderItem.quantity"
                            />
                        </div>

                        <div class="col-md-12 text-secondary">
                            <a
                                v-if="formType == 'update'"
                                @click.prevent="
                                    orderItemUpdate(
                                        orderItem.id,
                                        orderItem.order_id
                                    )
                                "
                                class="btn btn-success px-4 mt-4 float-end"
                                >Izmeni porudžbinu</a
                            >

                            <a
                                class="btn btn-success px-4 mt-4 float-end"
                                v-if="formValid"
                                @click.prevent="
                                    addMoreBadgeToExistingOrder(
                                        orderItem.order_id
                                    )
                                "
                                >Dodaj proizvod</a
                            >

                            <a
                                class="btn btn-warning px-4 mt-4 float-end mx-2"
                                @click.prevent="cancelEditing()"
                                >Otkaži izmenu</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
export default {
    props: ["orderItem", "orderId"],
    data() {
        return {};
    },

    computed: {
        ...mapGetters({
            type: "order/type",
            formType: "order/formType",
        }),

        formValid() {
            return !this.orderItem.tshirt_color ||
                !this.orderItem.tshirt_size ||
                !this.orderItem.tshirt_type ||
                !this.orderItem.quantity
                ? false
                : true;
        },
    },

    methods: {
        ...mapActions({
            getOrder: "order/getOrder",
        }),
        ...mapMutations({
            setType: "order/setType",
            setFormType: "order/setFormType",
        }),
        orderItemUpdate(orderItemId, orderId) {
            axios
                .put(`/api/order_items/${orderItemId}`, this.orderItem)
                .then((resp) => {
                    this.$awn.success(resp.data.message);
                    this.getOrder({ id: orderId });
                    this.setType("");
                    // this.orderItem = {};
                })
                .catch((error) => {
                    this.$awn.alert(error.response.data.message);
                });
        },

        cancelEditing() {
            this.setType("");
            this.setFormType("");
        },

        addMoreBadgeToExistingOrder() {
            this.orderItem.order_id = this.orderId;
            this.orderItem.type = "majica";
            axios
                .post("/api/order_items", this.orderItem)
                .then((resp) => {
                    this.$awn.success(resp.data.message);
                    this.getOrder({ id: this.orderId });
                    this.cancelEditing();
                })
                .catch((error) => {
                    this.$awn.alert(error.response.data.message);
                });
        },
    },
};
</script>
