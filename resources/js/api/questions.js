import { API } from './index';

export default {
    getMainQuestions: params => API.get('admin/exams/get-main-questions/'+params),
    addMainQuestion: params => API.post('admin/exams/add-main-question',params),
    getQuestions: params => API.get('admin/exams/get-questions/'+params),
    addQuestion: params => API.post('admin/exams/add-question',params),
    deleteQuestion: params => API.post('admin/exams/delete-question/',params),
    updateQuestion: params => API.post('admin/exams/update-question/'+params.id,params),
    updateQuestionOrder: params => API.post('admin/exams/update-question-order',params)
}
