import questions from '../../../api/questions';

export default {

    getMainQuestions({ commit },params) {
        return new Promise((resolve, reject) => {
            questions.getMainQuestions(params).then(response => {
                commit('setMainQuestions', response.data.questions);
            }).catch(error => {
                reject(error);
            })
        });
    },
    addMainQuestion({ commit },params) {
        return new Promise((resolve, reject) => {
            questions.addMainQuestion(params).then(response => {
                commit('addQuestion', response.data.question);
                resolve(response);
            }).catch(error => {
                reject(error);
            })
        });
    },



    getQuestions({ commit },params) {
        return new Promise((resolve, reject) => {
            questions.getQuestions(params).then(response => {
                commit('setQuestions', response.data.questions);
            }).catch(error => {
                reject(error);
            })
        });
    },
    addQuestion({ commit },params) {
        return new Promise((resolve, reject) => {
            questions.addQuestion(params).then(response => {
                commit('addQuestion', response.data.question);
                resolve(response);
            }).catch(error => {
                reject(error);
            })
        });
    },
    updateQuestion({ commit },params) {
        return new Promise((resolve, reject) => {
            questions.updateQuestion(params).then(response => {
                commit('updateQuestion', response.data.question);
                resolve(response);
            }).catch(error => {
                reject(error);
            })
        });
    },

    updateQuestionOrder({ commit },params) {
        return new Promise((resolve, reject) => {
            questions.updateQuestionOrder(params).then(response => {
                resolve(response);
            }).catch(error => {
                reject(error);
            })
        });
    },



    deleteQuestion({ commit },params) {
        return new Promise((resolve, reject) => {
            questions.deleteQuestion(params).then(response => {
                commit('deleteQuestion', response.data.question_id);
                resolve(response);
            }).catch(error => {
                reject(error);
            })
        });
    },

}
