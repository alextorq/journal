import axios from 'axios';

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

export default {
    state: {
        schedule: [],
        scheduleByUser: [],
        pref: '/api',
        GET: {
            schedule: '/schedule',
            scheduleBy: '/schedule/by/{id}'
        },
        POST: {
            schedule: '/schedule'
        },
        DELETE: {

        },
        PATCH: {

        },
        PUT: {

        },
    },
    getters: {
        scheduleInformation(state) {
            return state.schedule;
        },

        scheduleByUser(state) {
            return state.scheduleByUser;
        }
    },
    mutations: {
        addScheduleInformation(store, schedule) {
            store.schedule = schedule;
        },
        addUserSchedule(store, schedule) {
            store.scheduleByUser = schedule;
        }
    },
    actions: {
        getScheduleIndex(context){
            axios.get(context.state.pref + context.state.GET.schedule, {})
                .then(response => {
                    context.commit('addScheduleInformation', response.data.data);
                })
                .catch((error) => {
                    console.log(error)
                });
        },

        getScheduleByUser(context, data){
            axios.get(context.state.pref + context.state.GET.scheduleBy.replace('{id}', data.id), {})
                .then(response => {
                    context.commit('addUserSchedule', response.data.data);
                })
                .catch((error) => {
                    console.log(error)
                });
        },

        saveSchedule(context, data) {
            return new Promise((resolve, reject) => {
                axios.post(context.state.pref + context.state.POST.schedule, data)
                    .then(response => {
                        context.commit('addScheduleInformation', response.data.data);
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
    }
}