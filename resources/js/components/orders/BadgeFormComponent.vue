<template>
    <div v-show="type == 'badges'">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-uppercase pb-3">Dodaj bedž</h5>
            <a href="" @click.prevent="addForm()"
                ><i class="bx bx-plus" style="font-size: 30px"></i
            ></a>
        </div>

        <div v-for="(form, key, index) in forms" :key="index">
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
                    <select
                        name="size"
                        id="size"
                        v-model="form.quantity"
                        class="form-select"
                    >
                        <option value="0">Izaberi količinu bedzeva</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>

                <div class="col-md mx-auto text-center mt-3">
                    <a
                        href=""
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
                    quantity: 0,
                    type: "Bedž",
                },
            ],

            kacenja: [
                { id: 1, type: "zihernadla" },
                { id: 2, type: "magnet" },
                { id: 3, type: "samolepljiv" },
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
            });
        },

        removeForm(index) {
            this.forms.splice(index, 1);
        },

        addToNewOrderItems() {
            this.newOrder.badges = this.forms;
        },
    },
};
</script>
