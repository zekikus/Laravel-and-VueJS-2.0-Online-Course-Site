
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import {store} from './store';
import EditCourse from './components/EditCourse.vue';
import ShowCourse from './components/ShowCourse.vue';
import Search from './components/Search.vue';
import Profile from './components/Profile.vue';
import Init from './components/Init.vue';

const app = new Vue({
    el: '#app',
    components: {EditCourse, ShowCourse, Search, Profile, Init},
    store
});
