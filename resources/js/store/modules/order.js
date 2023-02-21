const state =  {
 errors: {},
 order: {},
 orders: {},
 newOrder: {
    badges: {},
    tshirt: {},
 },
 statuses: [],

}

const getters = {
    errors: state => state.errors,
    order: state => state.order,
    orders: state => state.orders,
    newOrder: state => state.newOrder,
    statuses: state => state.statuses,
}

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
}


const actions = {

    saveOrder({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.post('/api/orders', payload).then(resp => {
                commit('setOrder', resp.data.order);
                resolve(resp.data);
            }).catch( error => {
                commit('setErrors', error.response.data.errors);
                reject(error.response.data);
            })
        })
    },

    getOrder({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/orders/${payload.id}`).then(resp => {
                resolve(resp.data);
                commit('setOrder', resp.data.order);
                commit('setStatuses', resp.data.statuses);
            }).catch( error => {
                reject(error.response.data.errors);
                commit('errors', error.response.data.errors);
            })
        })
    },

    deleteOrder({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.delete(`/api/orders/${payload.id}`).then(resp => {
                resolve(resp.data);
            }).catch( error => {
                reject(error.response.data.errors);
                commit('errors', error.response.data.errors);
            })
        })
    },

    deleteOrderItem({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/orders_items/${payload.id}`).then(resp => {
                resolve(resp.data);
                // commit('setOrder', resp.data.order);
            }).catch( error => {
                reject(error.response.data.errors);
                commit('errors', error.response.data.errors);
            })
        })
    }
}


export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
