<template>
    <div v-show="type == 'badges'">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-uppercase pb-3">Dodaj bedž</h5>
            <a href="" @click.prevent="addForm()"
                ><i class="bx bx-plus" style="font-size: 30px"></i
            ></a>
        </div>

        <div v-for="(form, index) in forms" :key="index">
            <div class="row pt-4">
                <div class="col-md-3 mb-1">
                    <label for="color" class="form-label"
                        >Dimenzije bedža:</label
                    >
                    <select
                        name="color"
                        id="color"
                        v-model="form.badge_size"
                        class="form-select"
                    >
                        <option value="null">Izaberi dimeneziju bedža</option>
                        <option value="26">26mm</option>
                        <option value="36">36mm</option>
                        <option value="55">55mm</option>
                        <option value="77">77mm</option>
                        <option value="31">31mm</option>
                    </select>
                </div>

                <div class="col-md-3 mb-1">
                    <label class="form-label">Tip kačenja:</label>
                    <div class="form-check">
                        <div
                            class="form-check form-check-inline mt-2"
                            v-for="(kacenje, index) in kacenja"
                            :key="kacenje.id"
                        >
                            <input
                                class="form-check-input"
                                type="checkbox"
                                :value="kacenje.type"
                                v-model="form.tip_kacenja"
                            />
                            <label class="form-check-label">{{
                                kacenje.type
                            }}</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-1">
                    <label class="form-label">Tip plastifikacije:</label>
                    <div class="form-check">
                        <div
                            class="form-check form-check-inline mt-2"
                            v-for="(plast, index) in plastification"
                            :key="plast.id"
                        >
                            <input
                                class="form-check-input"
                                type="radio"
                                :value="plast.type"
                                v-model="form.plastifikacija"
                            />
                            <label class="form-check-label">{{
                                plast.type
                            }}</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 mb-1">
                    <label class="form-label">Količina:</label>
                    <input
                        name="quanity"
                        id="quantity"
                        v-model="form.quantity"
                        class="form-control"
                        placeholder="Unesi količinu"
                    />
                </div>

                <div class="col-md mx-auto text-center mt-3">
                    <a
                        href=""
                        v-show="index > 0"
                        @click.prevent="removeForm(index)"
                        class="text-danger"
                        ><i class="bx bx-minus" style="font-size: 30px"></i
                    ></a>
                    <a
                        href=""
                        v-if="index == 0"
                        @click.prevent="addToNewOrderItems()"
                        class="text-success"
                        ><i class="bx bx-save" style="font-size: 30px"></i
                    ></a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
    props: ["type"],
    data() {
        return {
            forms: [
                {
                    badge_size: null,
                    tip_kacenja: [],
                    plastifikacija: [],
                    quantity: null,
                    type: "bedž",
                },
            ],

            kacenja: [
                { id: 1, type: "Zihernadla" },
                { id: 2, type: "Magnet" },
                { id: 3, type: "Samolepljiv" },
            ],

            plastification: [
                { id: 1, type: "Sjaj" },
                { id: 2, type: "Mat" },
            ],
        };
    },

    computed: {
        ...mapGetters({
            newOrder: "order/newOrder",
        }),
    },

    methods: {
        addForm() {
            this.forms.push({
                badge_size: null,
                tip_kacenja: [],
                plastifikacija: [],
                quantity: 0,
                type: "bedž",
            });
        },

        removeForm(index) {
            this.forms.splice(index, 1);
        },

        addToNewOrderItems() {
            this.$awn.success("Dodat bedž u porudžbinu.");
            this.newOrder.badges = this.forms;
        },
    },
};
</script>
