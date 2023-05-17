<template>
    <div class="card-body mt-3">
        <div class="row mb-3">
            <div class="col-sm-4 text-secondary">
                <label>Ime mušterije</label>
                <input
                    type="text"
                    v-if="order.customer"
                    v-model="order.customer.name"
                    class="form-control"
                />
            </div>
            <div class="col-sm-4 text-secondary">
                <label>Email</label>
                <input
                    type="text"
                    v-if="order.customer"
                    v-model="order.customer.email"
                    class="form-control"
                />
            </div>
            <div class="col-sm-4 text-secondary">
                <label>Telefon</label>
                <input
                    type="text"
                    v-if="order.customer"
                    v-model="order.customer.phone"
                    class="form-control"
                />
            </div>
            <hr class="mt-4" />
            <div class="col-sm-4 text-secondary">
                <label>Telefon 2</label>
                <input
                    type="text"
                    v-if="order.customer"
                    v-model="order.customer.phone2"
                    class="form-control"
                />
            </div>
            <div class="col-sm-4 text-secondary">
                <label>Adresa</label>
                <input
                    type="text"
                    v-if="order.customer"
                    v-model="order.customer.street"
                    class="form-control"
                />
            </div>
            <div class="col-sm-4 text-secondary">
                <label>Grad</label>
                <input
                    type="text"
                    v-if="order.customer"
                    v-model="order.customer.city"
                    class="form-control"
                />
            </div>

            <div class="col-md-12 text-secondary">
                <a
                    @click.prevent="customerUpdate(order?.customer?.id)"
                    class="btn btn-warning px-4 mt-4 float-end"
                    >Izmeni mušteriju</a
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["order"],
    data() {
        return {};
    },

    methods: {
        customerUpdate(customerId) {
            axios
                .put("/api/customers/" + customerId, this.order.customer)
                .then((resp) => {
                    this.$awn.success(resp.data.message);
                })
                .catch((error) => {
                    this.$awn.alert(error.response.data.message);
                });
        },
    },
};
</script>
