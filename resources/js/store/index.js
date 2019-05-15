import Vue from 'vue'
import Vuex from 'vuex'
import lessons from './lessons/index';
import schedule from './schedule/index';
import students from './students/index';
import journal from './journal/index';

Vue.use(Vuex);

let store = new Vuex.Store({

    modules: {
        lessons,
        schedule,
        students,
        journal
    },

    state: {

    },
    getters: {


    },
    actions: {

    },

    mutations: {

    }
});

export default store;
