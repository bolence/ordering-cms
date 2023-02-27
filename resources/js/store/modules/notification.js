

const state = {
 notifications: [],
 count_notification: 0,
}

const getters = {
    notifications: state => state.notifications,
    count_notification: state => state.count_notification,
}


const mutations = {
    setNotifications(state, data) {
        state.notifications = data.notifications;
        state.count_notification = data.count_notifications;
    },
}

const actions = {

    getNotifications({commit}) {
        return new Promise((resolve, reject) => {
            axios.get('/notifications').then(resp => {
                commit("setNotifications", resp.data);
                resolve(resp.data);
            }).catch(error => {
                reject(error.response.data.errors);
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


