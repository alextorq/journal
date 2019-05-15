import axios from 'axios';

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

export default {
    state: {
        students: {},
        pref: '/api',
        GET: {
            students: '/students',
            student: '/students/{id}'
        },
        POST: {
            students: '/students',
        },
        DELETE: {
            student: '/students/{id}'
        },
        PATCH: {

        },
        PUT: {
            students: '/students/{id}',
        },
    },
    getters: {
        studentsList(state) {
            return state.students;
        },
    },
    mutations: {
        addStudents(store, students) {
            store.students = students;
        },
        addStudentsInformation(store, students) {
            store.students = students;
        },
    },
    actions: {
        getStudents(context, data){
            const { page } = data || {};

            let params = {
                params: {
                    page
                }
            };
            axios.get(context.state.pref + context.state.GET.students, params)
                .then(response => {
                    context.commit('addStudentsInformation', response.data);
                })
                .catch((error) => {
                    console.log(error)
                });
        },

        getStudent(context, data) {
            return new Promise((resolve, reject) => {
                    axios.get(context.state.pref + context.state.GET.student.replace('{id}', data.id), {})
                        .then(response => {
                            resolve(response);
                        })
                        .catch((error) => {
                            reject(error);
                        });
                });
        },
    }
}