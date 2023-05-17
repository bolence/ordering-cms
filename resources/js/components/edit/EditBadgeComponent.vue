<template>
    <div class="row" v-if="type == 'bedž'">
        <div class="col-sm-12">
            <div class="card bordered-10">
                <div class="card-body">
                    <div class="card-header mb-0">
                        <h5>Izmeni/Dodaj bedž</h5>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label>Veličina bedža</label>
                            <select
                                name="badge_size"
                                id="badge_size"
                                v-model="orderItem.badge_size"
                                class="form-select"
                            >
                                <option value="26">26mm</option>
                                <option value="36">36mm</option>
                                <option value="55">55mm</option>
                                <option value="77">77mm</option>
                                <option value="31">31mm</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Tip kačenja</label>
                            <select
                                class="form-select"
                                v-model="orderItem.tip_kacenja"
                            >
                                <option value="Zihernadla">Zihernadla</option>
                                <option value="Fer.magnet">Fer.magnet</option>
                                <option value="Neo.magnet">Neo.magnet</option>
                                <option value="Samolepljiv">Samolepljiv</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Plastifikacija</label>
                            <input
                                v-if="orderItem.length"
                                class="form-control"
                                v-model="orderItem.plastifikacija"
                            />

                            <select
                                v-else
                                class="form-select"
                                v-model="orderItem.plastifikacija"
                            >
                                <option value="mat">Mat</option>
                                <option value="sjaj">Sjaj</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Količina</label>
                            <input
                                class="form-control"
                                v-model="orderItem.quantity"
                            />
                        </div>
                    </div>

                    <div
                        class="col-md-12 text-secondary"
                        v-if="formType == 'update'"
                    >
                        <a
                            class="btn btn-success px-4 mt-4 float-end"
                            @click.prevent="
                                updateBadgeOrder(
                                    orderItem.id,
                                    orderItem.order_id
                                )
                            "
                            >Izmeni porudžbinu</a
                        >
                    </div>

                    <div class="col-md-12 text-secondary" v-else>
                        <a
                            class="btn btn-success px-4 mt-4 float-end"
                            v-if="formValid"
                            @click.prevent="
                                addMoreBadgeToExistingOrder(orderItem.order_id)
                            "
                            >Dodaj proizvod</a
                        >
                    </div>
                    <div class="col-md-12 text-secondary">
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
            return !this.orderItem.badge_size ||
                !this.orderItem.tip_kacenja ||
                !this.orderItem.plastifikacija ||
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
            setOrder: "order/setOrder",
            setFormType: "order/setFormType",
        }),
        updateBadgeOrder(orderItemId, orderId) {
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
            this.orderItem.type = "bedž";
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
