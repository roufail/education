import { API } from "./index";

export default {
    getExam: params =>
        API.get("/student/get-exam/" + params.id + "/?page=" + params.page),
    getAnswers: params => API.post("/student/get-answers", params),
    saveAnswers: params => API.post("/student/save-answers", params),
    endExam: params => API.post("/student/end-exam", params),
    getExamResult: params =>
        API.post("/student/get-exam-result/" + params.id, params)
};
