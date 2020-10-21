import { API } from './index';

export default {
    getCourseLectures: (params) => API.get('admin/course/'+params.id+'/lectures'),
    addCourseLecture: (params) => API.post('admin/course/lectures',params),
    editCourseLecture: (params) => API.put('admin/course/lecture/'+params.id+'/edit',params),
    deleteCourseLecture: (params) => API.delete('admin/course/lecture/'+params.id+'/delete'),


    addLectureMedia: (params) => API.post('admin/course/lecture/'+params.lecture_id+'/media',params),
    editLectureMedia: (params) => API.put('admin/course/lecture/'+params.lecture_id+'/media/'+params.id+'/edit',params),
    deleteLectureMedia: (params) => API.delete('admin/course/lecture/'+params.lecture_id+'/media/'+params.id+'/delete'),

    updateLecturesOrder: (params) => API.post('admin/course/update-lectures-order',params),
    updateLectureAttachmentsOrder: (params) => API.post('admin/course/update-lecture-attachment-order',params)

}
