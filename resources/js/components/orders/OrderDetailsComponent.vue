<template>
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <div class="card bordered-10">
          <div class="card-header">
            <h4>
              Poručeno od:
              <span class="text-primary fw-bold">{{
                order.customer.name
              }}</span>
            </h4>
          </div>
          <CustomerEditFormComponent :order="order" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card bordered-10">
          <div class="card-header">
            <h4>
              Detalji/izmena porudžbine
              <span class="text-primary fw-bold">{{ order.order_number }}</span>
            </h4>
          </div>
          <div class="card-body mt-3">
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Tip dostave</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <select v-model="order.delivery_type" class="form-select">
                  <option
                    value="Dostava"
                    :selected="order.delivery_type == 'Dostava'"
                  >
                    Dostava
                  </option>
                  <option
                    value="Lično"
                    :selected="order.delivery_type == 'Lično'"
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
                <datepicker
                  v-model="order_date"
                  name="order_date"
                  type="date"
                  :bootstrap-styling="true"
                  :language="sr"
                  :monday-first="true"
                  calendar-button-icon="fa fa-calendar"
                ></datepicker>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Datum isporuke</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input
                  type="text"
                  class="form-control"
                  v-model="order.delivery_date"
                />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Poručeno sa</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <select v-model="order.order_from" class="form-select">
                  <option value="Email" :selected="order.order_from == 'Email'">
                    Email
                  </option>
                  <option
                    value="Facebook"
                    :selected="order.order_from == 'Facebook'"
                  >
                    Facebook
                  </option>
                  <option value="Viber" :selected="order.order_from == 'Viber'">
                    Viber
                  </option>
                  <option
                    value="Instagram"
                    :selected="order.order_from == 'Instagram'"
                  >
                    Instagram
                  </option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Tip plaćanja</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <select v-model="order.payment_type" class="form-select">
                  <option
                    value="virman"
                    :selected="order.payment_type == 'virman'"
                  >
                    Virman
                  </option>
                  <option value="cash" :selected="order.payment_type == 'cash'">
                    Gotovina
                  </option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Suma porudžbine</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input type="text" class="form-control" v-model="order.price" />
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
                    :selected="status.id === order.status_id"
                    :value="status.id"
                  >
                    {{ status.status }}
                  </option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Napomena</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <textarea
                  rows="6"
                  v-model="order.napomena"
                  class="form-control"
                  name="napomena"
                  id="napomena"
                >
                </textarea>
              </div>
            </div>

            <div v-if="order.delivery_type == 'Dostava'">
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
                    :class="{
                      'is-invalid': errors['delivery.name'],
                    }"
                    v-model="delivery_name"
                  />
                  <div
                    v-if="errors['delivery.name']"
                    class="invalid-feedback error-message"
                  >
                    {{ errors["delivery.name"][0] }}
                  </div>
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
                    :class="{
                      'is-invalid': errors['delivery.street'],
                    }"
                    v-model="delivery_street"
                  />
                  <div
                    v-if="errors['delivery.street']"
                    class="invalid-feedback error-message"
                  >
                    {{ errors["delivery.street"][0] }}
                  </div>
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
                    :class="{
                      'is-invalid': errors['delivery.city'],
                    }"
                  />
                  <div
                    v-if="errors['delivery.city']"
                    class="invalid-feedback error-message"
                  >
                    {{ errors["delivery.city"][0] }}
                  </div>
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
                    :class="{
                      'is-invalid': errors['delivery.phone'],
                    }"
                  />
                  <div
                    v-if="errors['delivery.phone']"
                    class="invalid-feedback error-message"
                  >
                    {{ errors["delivery.phone"][0] }}
                  </div>
                </div>
              </div>
            </div>

            <div
              class="col-12 d-flex align-items-center justify-content-between"
              v-if="!order.finished_at"
            >
              <div class="col-md-6">
                <span v-if="order.customer?.email">
                  <!-- <input
                                        type="checkbox"
                                        class="form-check-input"
                                        name="send_email"
                                        id="send_email"
                                        v-model="notified"
                                    />
                                    <label
                                        class="form-check-label px-1"
                                        for="send_email"
                                        >Pošalji notifikaciju</label
                                    > -->
                </span>
              </div>
              <div class="col-md-6 text-secondary">
                <a
                  @click.prevent="orderUpdate()"
                  class="btn btn-primary px-4 float-end"
                  >Snimi</a
                >
              </div>
            </div>
            <div class="col-12" v-else>
              <div
                class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-1"
              >
                <div class="d-flex align-items-center">
                  <div class="font-35 text-dark">
                    <i class="bx bx-info-square"></i>
                  </div>
                  <div class="ms-3">
                    <h6 class="mb-0 text-dark">Obaveštenje</h6>
                    <div class="text-dark">
                      Porudžbenica je završena i ne može se više izmeniti.
                    </div>
                  </div>
                </div>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="alert"
                  aria-label="Close"
                ></button>
              </div>
            </div>
          </div>
        </div>

        <OrderedTable :order="order" :type="type" />
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions, mapMutations } from "vuex";
import Datepicker from "vuejs-datepicker";
import { sr } from "vuejs-datepicker/dist/locale";
import moment from "moment";

import CustomerEditFormComponent from "../customers/CustomerEditFormComponent.vue";
import OrderedTable from "./OrderedTableComponent.vue";
export default {
  components: {
    Datepicker,
    // EditTshirtComponent,
    CustomerEditFormComponent,
    // EditBadgeComponent,
    OrderedTable,
  },
  props: ["order_id"],
  data() {
    return {
      notified: false,
      name: null,
      phone: null,
      city: null,
      street: null,
      sr: sr,
      ordered_date: null,
      type: "",
      add: false,
      product_type: null,
      orderItem: {},
    };
  },

  computed: {
    ...mapGetters({
      order: "order/order",
      statuses: "order/statuses",
      errors: "order/errors",
    }),

    order_date: {
      get() {
        return moment(this.order.order_date, "DD.MM.YYYY").format(
          "DD MMM yyyy"
        );
      },
      set(value) {
        this.ordered_date = value;
      },
    },

    delivery_name: {
      get() {
        return this.order.delivery ? this.order.delivery.name : null;
      },
      set(value) {
        this.name = value;
      },
    },

    delivery_street: {
      get() {
        return this.order.delivery ? this.order.delivery.street : null;
      },
      set(value) {
        this.street = value;
      },
    },

    delivery_city: {
      get() {
        return this.order.delivery ? this.order.delivery.city : null;
      },
      set(value) {
        this.city = value;
      },
    },

    delivery_phone: {
      get() {
        return this.order.delivery ? this.order.delivery.phone : null;
      },
      set(value) {
        this.phone = value;
      },
    },
  },

  mounted() {
    this.getOrder({ id: this.order_id });
  },

  methods: {
    ...mapActions({
      getOrder: "order/getOrder",
      deleteOrderItem: "order/deleteOrderItem",
      updateOrder: "order/updateOrder",
    }),

    ...mapMutations({
      setOrder: "order/setOrder",
    }),

    addItem() {
      this.edit = false;
      this.add = true;
    },

    infoAboutSendingEmail() {
      if (
        this.order.status_id == 5 &&
        !this.order.notified &&
        this.order.customer.email
      ) {
        this.$swal
          .fire({
            title: "Pošaljite email?",
            text: "Da li želite da pošaljete email kako bi obavestili kupca o završenoj porudžbini?",
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Da, želim!",
            cancelButtonText: "Otkaži",
          })
          .then((result) => {
            if (result.isConfirmed) {
              this.notified = true;
              this.$swal.fire(
                "Slanje mejla zakazano!",
                "Mejl će biti poslat kad kliknete na snimi. Ako ipak ne želite, odčekirajte pošalji notifikaciju!",
                "warning"
              );
            } else {
              this.$swal.fire(
                "Mejl neće biti poslat!",
                "Mejl neće biti poslat kad budete izmenili status ove porudžbenice!",
                "info"
              );
            }
          });
      }
    },

    orderItemDelete(index, orderItemId) {
      this.$swal
        .fire({
          title: "Da li ste sigurni?",
          text: "Radnja je nepovratna!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Da, izbriši!",
          cancelButtonText: "Otkaži",
        })
        .then((result) => {
          if (result.isConfirmed) {
            this.deleteOrderItem({ id: orderItemId }).then((resp) => {
              this.order.order_items.splice(index, 1);
              this.$swal.fire("Izbrisano!", resp.message, "success");
            });
          }
        });
    },

    orderUpdate() {
      this.order.notified = this.notified;

      if (this.name) {
        this.order.delivery = {
          name: this.name,
          street: this.street,
          city: this.city,
          phone: this.phone,
        };
      }

      this.order.order_date = this.ordered_date;

      this.updateOrder(this.order)
        .then((resp) => {
          this.$awn.success(resp.message);
          this.setOrder(resp.order);
          // this.notified = false;
        })
        .catch((error) => {
          this.$awn.alert(error.message);
        });
    },
  },
};
</script>
