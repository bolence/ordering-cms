<template>
    <div v-if="order.delivery && order.delivery_type == 'Dostava'">
        <h5 class="text-primary">Detalji slanja</h5>
        <hr />
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">Ime i prezime kome se šalje</h6>
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
</template>

<script>
export default {
    props: ["order"],
    data() {
        return {};
    },
};
</script>
