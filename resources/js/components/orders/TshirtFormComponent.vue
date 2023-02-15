<template>
    <div v-show="type == 'tshirt'">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-uppercase pb-3">Dodaj majicu</h5>
            <a href="" @click.prevent="addForm()"
                ><i class="bx bx-plus" style="font-size: 30px"></i
            ></a>
        </div>
        <div v-for="(form, index) in forms" :key="index">
            <div class="row">
                <div class="col-md-3 mb-1">
                    <label for="color" class="form-label">Boja majice:</label>
                    <select
                        name="color"
                        id="color"
                        v-model="form.color"
                        class="form-select"
                    >
                        <option value="null">Izaberi boju majice</option>
                        <option value="crna">Crna</option>
                        <option value="bela">Bela</option>
                    </select>
                </div>

                <div class="col-md-3 mb-1">
                    <label class="form-label">Tip majice:</label>
                    <select
                        name="tshirt_type"
                        id="tshirt_type"
                        v-model="form.tshirt_type"
                        class="form-select"
                    >
                        <option value="null">Izaberi tip majice</option>
                        <option value="muška">Muška</option>
                        <option value="ženska">Ženska</option>
                    </select>
                </div>

                <div class="col-md-3 mb-1">
                    <label class="form-label">Veličina majice:</label>
                    <select
                        name="size"
                        id="size"
                        v-model="form.size"
                        class="form-select"
                    >
                        <option value="null">Izaberi veličinu majice</option>
                        <option value="xs">XS</option>
                        <option value="s">S</option>
                        <option value="m">M</option>
                        <option value="l">L</option>
                        <option value="xl">XL</option>
                        <option value="xxl">XXL</option>
                    </select>
                </div>

                <div class="col-md-2 mb-1">
                    <label class="form-label">Količina:</label>
                    <select
                        name="size"
                        id="size"
                        v-model="form.quantity"
                        class="form-select"
                    >
                        <option value="0">Izaberi količinu majice</option>
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
                        v-show="forms.length > 1 && index > 0"
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
                    color: null,
                    tshirt_type: null,
                    size: null,
                    quantity: null,
                },
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
                color: null,
                tshirt_type: null,
                size: null,
                quantity: null,
            });
        },

        removeForm(index) {
            this.forms.splice(index, 1);
            this.$awn.success("Uspešno izbrisana forma");
        },

        addToNewOrderItems() {
            this.newOrder.tshirt = this.forms;
        },
    },
};
</script>
