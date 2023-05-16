<template>
  <div class="row" v-if="type == 'majica'">
    <div class="col-sm-12">
      <div class="card bordered-10">
        <div class="card-body">
          <div class="card-header mb-0">
            <h5>Izmeni poručenu majicu</h5>
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
                <option value="crna">Crna</option>
                <option value="bela">Bela</option>
              </select>
            </div>
            <div class="col-md-3">
              <label>Količina</label>
              <input class="form-control" v-model="orderItem.quantity" />
            </div>

            <div class="col-md-12 text-secondary">
              <a
                @click.prevent="orderItemUpdate(orderItem.id)"
                class="btn btn-warning px-4 mt-4 float-end"
                >Izmeni porudžbinu</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["orderItem", "type"],
  data() {
    return {};
  },

  methods: {
    orderItemUpdate(orderItemId) {
      axios
        .put(`/api/order_items/${orderItemId}`, this.orderItem)
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

