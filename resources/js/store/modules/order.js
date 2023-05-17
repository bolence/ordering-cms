const state = {
    errors: {},
    order: {},
    orders: {},
    newOrder: {
        badges: {},
        tshirt: {},
    },
    statuses: [],
    type: "",
    formType: "",
};

const getters = {
    errors: (state) => state.errors,
    order: (state) => state.order,
    orders: (state) => state.orders,
    newOrder: (state) => state.newOrder,
    statuses: (state) => state.statuses,
    type: (state) => state.type,
    formType: (state) => state.formType,
};

const mutations = {
    setErrors(state, errors) {
        state.errors = errors;
    },
    setOrder(state, order) {
        state.order = order;
    },
    setOrders(state, orders) {
        state.orders = orders;
    },
    setStatuses(state, statuses) {
        state.statuses = statuses;
    },
    setType(state, type) {
        state.type = type;
    },
    setFormType(state, formType) {
        state.formType = formType;
    },
};

const actions = {
    saveOrder({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios
                .post("/api/orders", payload)
                .then((resp) => {
                    commit("setOrder", resp.data.order);
                    resolve(resp.data);
                })
                .catch((error) => {
                    commit("setErrors", error.response.data.errors);
                    reject(error.response.data);
                });
        });
    },

    getOrder({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/orders/${payload.id}`)
                .then((resp) => {
                    resolve(resp.data);
                    commit("setOrder", resp.data.order);
                    commit("setStatuses", resp.data.statuses);
                })
                .catch((error) => {
                    reject(error.response.data.errors);
                    commit("setErrors", error.response.data.errors);
                });
        });
    },

    updateOrder({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios
                .put(`/api/orders/${payload.id}`, payload)
                .then((resp) => {
                    resolve(resp.data);
                    commit("setOrder", resp.data.order);
                })
                .catch((error) => {
                    reject(error.response.data.errors);
                    commit("setErrors", error.response.data.errors);
                });
        });
    },

    deleteOrder({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios
                .delete(`/api/orders/${payload.id}`)
                .then((resp) => {
                    resolve(resp.data);
                })
                .catch((error) => {
                    reject(error.response.data.errors);
                    commit("setErrors", error.response.data.errors);
                });
        });
    },

    deleteOrderItem({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios
                .delete(`/api/order_items/${payload.id}`)
                .then((resp) => {
                    resolve(resp.data);
                    // commit('setOrder', resp.data.order);
                })
                .catch((error) => {
                    reject(error.response.data.errors);
                    commit("setErrors", error.response.data.errors);
                });
        });
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
