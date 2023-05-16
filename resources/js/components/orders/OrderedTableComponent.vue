<template>
  <Fragment>
    <EditTshirtComponent :orderItem="orderItem" :type="type" />
    <EditBadgeComponent :orderItem="orderItem" :type="type" />
    <div class="row" v-if="order.order_items?.length > 0">
      <div class="col-sm-12">
        <div class="card bordered-10">
          <div class="card-body">
            <div class="card-header mb-0">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-1">
                  Porudžbina sadrži
                  {{ order.order_items.length }}
                  proizvod/a
                </h5>
                <span>
                  <a
                    href=""
                    style="font-size: 25px"
                    @click.prevent="addNewProduct('bedž')"
                    ><i class="bx bxs-badge"></i
                  ></a>
                  <a
                    href=""
                    style="font-size: 25px"
                    @click.prevent="addNewProduct('majica')"
                    ><i class="bx bxs-t-shirt"></i
                  ></a>
                </span>
              </div>
            </div>
            <div class="tab-content table-responsive">
              <table id="badges" class="table table-bordered my-3">
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
                    v-for="(order_item, index) in order.order_items"
                    :key="index"
                  >
                    <td class="fw-bold">
                      {{ order_item.type | capitalize }}
                    </td>
                    <td>
                      {{
                        order_item.badge_size
                          ? order_item.badge_size + "mm"
                          : order_item.tshirt_size | capitalize
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
                        order_item.plastifikacija && order_item.type == "bedž"
                          ? order_item.plastifikacija
                          : order_item.tshirt_type | capitalize
                      }}
                    </td>
                    <td>
                      {{ order_item.quantity }}
                    </td>
                    <td>
                      <a
                        href=""
                        @click.prevent="orderItemDelete(index, order_item.id)"
                        ><i class="bx bxs-trash text-danger"></i
                      ></a>

                      <a
                        href=""
                        @click.prevent="
                          orderItemEdit(order_item.id, order_item.type)
                        "
                        ><i class="bx bxs-pencil text-success"></i
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
  </Fragment>
</template>

<script>
import EditTshirtComponent from "../edit/EditTshirtComponent.vue";
import EditBadgeComponent from "../edit/EditBadgeComponent.vue";
import { Fragment } from "vue-fragment";
export default {
  components: {
    EditTshirtComponent,
    EditBadgeComponent,
    Fragment,
  },
  props: ["order"],
  data() {
    return {
      type: "",
      orderItem: {},
    };
  },

  methods: {
    orderItemEdit(orderId, type) {
      this.type = type;

      axios
        .get("/api/order_items/" + orderId)
        .then((resp) => {
          this.orderItem = resp.data.order_items;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    addNewProduct(type) {
      this.type = type;
      //   this.orderItem = {};
    },
  },
};
</script>

