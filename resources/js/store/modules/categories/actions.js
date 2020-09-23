import categoires from '../../../api/categories';

export default {
    getCategories({ commit },params) {
        return new Promise((resolve, reject) => {
            categoires.getCategories(params).then(response => {
                commit('setCategories', response.data.categories);
            }).catch(error => {
                reject(error);
            })
        });
    },

}
