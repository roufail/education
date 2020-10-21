import Vue from "vue";
import Vuex from "vuex";
import VuexPersist from "vuex-persist";

import questions from "./modules/questions";
import categories from "./modules/categories";
import exams from "./modules/exams";
import courses from "./modules/courses";
Vue.use(Vuex);
const debug = process.env.NODE_ENV !== "production";

const VuexPersists = new VuexPersist({
    key: "alferp",
    reducer: state => ({ user: state.user }),
    storage: window.localStorage
});

export const strict = false;

export default new Vuex.Store({
    modules: {
        questions,
        categories,
        exams,
        courses
    },
    plugins: [VuexPersists.plugin],
    strict: debug
});
