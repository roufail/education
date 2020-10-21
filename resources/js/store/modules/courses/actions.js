import courses from "../../../api/courses";

export default {
    getCourseLectures({commit},parmas){
        return new Promise((resolve,reject) => {
            courses.getCourseLectures(parmas).then(function(response){
                commit("setCourseLectures", response.data.lectures);
                resolve(response);
            }).catch(error => {
                reject(error);
            });
        });
    },
    addCourseLecture({commit},parmas){
        return new Promise((resolve,reject) => {
            courses.addCourseLecture(parmas).then(function(response){
                commit("setCourseLecture", response.data.lecture);
                resolve(response);
            }).catch(error => {
                reject(error);
            });
        });
    },
    editCourseLecture({commit},parmas){
        return new Promise((resolve,reject) => {
            courses.editCourseLecture(parmas).then(function(response){
                commit("editCourseLecture", response.data.lecture);
                resolve(response);
            }).catch(error => {
                reject(error);
            });
        });
    },
    deleteCourseLecture({commit},parmas){
        return new Promise((resolve,reject) => {
            courses.deleteCourseLecture(parmas).then(function(response){
                commit("deleteCourseLecture", response.data.id);
                resolve(response);
            }).catch(error => {
                reject(error);
            });
        });
    },
    addLectureMedia({commit},parmas){
        return new Promise((resolve,reject) => {
            courses.addLectureMedia(parmas).then(function(response){
                commit("setLectureMedia", response.data.media);
                resolve(response);
            }).catch(error => {
                reject(error);
            });
        });
    },


    editLectureMedia({commit},parmas){
        return new Promise((resolve,reject) => {
            courses.editLectureMedia(parmas).then(function(response){
                commit("editLectureMedia", response.data);
                resolve(response);
            }).catch(error => {
                reject(error);
            });
        });
    },
    deleteLectureMedia({commit},parmas){
        return new Promise((resolve,reject) => {
            courses.deleteLectureMedia(parmas).then(function(response){
                commit("deleteLectureMedia", response.data);
                resolve(response);
            }).catch(error => {
                reject(error);
            });
        });
    },
    updateLecturesOrder({commit},parmas){
        return new Promise((resolve,reject) => {
            courses.updateLecturesOrder(parmas).then(function(response){
                resolve(response);
            }).catch(error => {
                reject(error);
            });
        });
    },

    updateLectureAttachmentsOrder({commit},parmas){
        return new Promise((resolve,reject) => {
            courses.updateLectureAttachmentsOrder(parmas).then(function(response){
                resolve(response);
            }).catch(error => {
                reject(error);
            });
        });
    }


};
