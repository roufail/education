import { defaultsDeep } from "lodash";

export default {

    setCourseLectures(state,lectures){
        state.lectures = lectures.filter(function(lec) {
            return lec != undefined;
        });;
    },
    setCourseLecture(state,lecture){
        state.lectures.push(lecture);
    },
    editCourseLecture(state,lecture){
        let $index = state.lectures.map(lec => lec.id).indexOf(lecture.id);
        state.lectures[$index] = lecture;
    },
    deleteCourseLecture(state,lecture_id){
        let $index = state.lectures.map(lec => lec.id).indexOf(lecture_id);
        state.lectures.splice($index,1);
    },
    setLectureMedia(state,media){
        let $index = state.lectures.map(lec => lec.id).indexOf(media.lecture_id);
        if(!state.lectures[$index].attachments)
                state.lectures[$index].attachments = [];
        state.lectures[$index].attachments.push(media);
    },
    editLectureMedia(state,data){
        let $lindex = state.lectures.map(lec => lec.id).indexOf(data.lecture_id);
        let $mindex = state.lectures[$lindex].attachments.map(att => att.id).indexOf(data.attachment.id);
        state.lectures[$lindex].attachments[$mindex] = data.attachment;
    },
    deleteLectureMedia(state,data){
        let $lindex = state.lectures.map(lec => lec.id).indexOf(data.lecture_id);
        let $mindex = state.lectures[$lindex].attachments.map(att => att.id).indexOf(data.attachment_id);
        state.lectures[$lindex].attachments.splice($mindex,1);
    },
    updateLecturesOrder(state,data) {
        let index = state.lectures
            .map(lec => lec.id)
            .indexOf(data.lecture.id);
        state.lectures[index].order = data.index + 1;
    },
    updateLectureAttachmentsOrder(state,data) {

        let index = state.lectures[data.index].attachments
            .map(attach => attach.id)
            .indexOf(data.attachment.id);
            state.lectures[data.index].attachments[index].order = data.index + 1;
    }




};
