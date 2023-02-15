const state =  {
 errors: {},
 order: {},
 orders: {},
 newOrder: {
    badges: {},
    tshirt: {},
 }

}

const getters = {
    errors: state => state.errors,
    order: state => state.order,
    orders: state => state.orders,
    newOrder: state => state.newOrder,
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
    }
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
    }
}


export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};