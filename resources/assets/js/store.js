import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({

    state:{
        auth_user: {}
    },
    mutations:{
        addAuthUser(state,user){
            state.auth_user = user;
        }
    },
    getters:{
        auth_user(state){
            return state.auth_user;
        }
    }

});