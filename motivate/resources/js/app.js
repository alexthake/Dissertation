/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import moment from 'moment'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

window.Vue = require('vue');
Vue.use(BootstrapVue);
Vue.use(IconsPlugin)
Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Individual Pages
Vue.component('dashboard', require('./Dashboard.vue').default);
Vue.component('project-page', require('./ProjectPage.vue').default);
Vue.component('retrospective-page', require('./RetrospectivePage.vue').default);

//Dashboard Page Sections
Vue.component('home-project', require('./components/HomeProject.vue').default);
Vue.component('new-project-button', require('./components/EditProject.vue').default);

//Project Page Sections
Vue.component('project', require('./components/Project.vue').default);
Vue.component('project-section', require('./components/Section.vue').default);
Vue.component('task', require('./components/Task.vue').default);

//Retrospective Page Sections
Vue.component('retrospective', require('./components/Retrospective.vue').default);
Vue.component('line-graph', require('./components/LineGraph.vue').default);
Vue.component('bar-graph', require('./components/BarGraph.vue').default);
Vue.component('donut-graph', require('./components/DonutGraph.vue').default);

//Re-usable Components
Vue.component('progress-bar', require('./components/ProgressBar.vue').default);

//Edit and Create Modals
Vue.component('new-project', require('./components/NewProject.vue').default);
Vue.component('edit-project', require('./components/EditProject.vue').default);
Vue.component('edit-section', require('./components/EditSection.vue').default);
Vue.component('edit-task', require('./components/EditTask.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
