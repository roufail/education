/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
import store from "./store/store";

window.Vue = require("vue");

import { Form, HasError, AlertError } from "vform";
import Multiselect from "vue-multiselect";
import Swal from "sweetalert2";

window.Form = Form;
window.Swal = Swal;

// sweetalert
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000
});

// global toaster alert
window.Toast = Toast;

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component("multiselect", Multiselect);

import pagination from "laravel-vue-pagination";
Vue.component("pagination", pagination);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "exam-questions",
    require("./components/ExamQuestionsComponents.vue").default
);
Vue.component(
    "student-exam",
    require("./components/StudentExamComponents.vue").default
);

Vue.component(
    "course-content",
    require("./components/CourseContentComponent.vue").default
);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    store
});
