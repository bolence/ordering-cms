<template>
  <div class="row" v-if="type == 'bedž'">
    <div class="col-sm-12">
      <div class="card bordered-10">
        <div class="card-body">
          <div class="card-header mb-0">
            <h5>Izmeni poručen bedž</h5>
          </div>
          <div class="row mt-3">
            <div class="col-md-3">
              <label>Tip majice</label>
              <input class="form-control" v-model="orderItem.tshirt_type" />
            </div>
            <div class="col-md-3">
              <label>Veličina</label>
              <input class="form-control" v-model="orderItem.tshirt_size" />
            </div>
            <div class="col-md-3">
              <label>Boja</label>
              <input class="form-control" v-model="orderItem.tshirt_color" />
            </div>
            <div class="col-md-3">
              <label>Količina</label>
              <input class="form-control" v-model="orderItem.quantity" />
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
};
</script>

