import exams from "../../../api/exams";

export default {
    getExam({ commit }, params) {
        return new Promise((resolve, reject) => {
            exams
                .getExam(params)
                .then(response => {
                    commit("setExam", response.data.response.exam);
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    getAnswers({ commit }, params) {
        return new Promise((resolve, reject) => {
            exams
                .getAnswers(params)
                .then(response => {
                    //commit("setAnswers", response.data.response);
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    saveAnswers({ commit }, params) {
        return new Promise((resolve, reject) => {
            exams
                .saveAnswers(params)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    endExam({ commit }, params) {
        return new Promise((resolve, reject) => {
            exams
                .endExam(params)
                .then(response => {
                    // commit("setExamResult", response.data.response.exam_result);
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    getExamResult({ commit }, params) {
        return new Promise((resolve, reject) => {
            exams
                .getExamResult(params)
                .then(response => {
                    commit("setExamResult", response.data.response);
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    }
};
