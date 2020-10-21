<template>
    <div>


  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
        المحتوي
          <div class="card-tools">
            <a href="javascript:;"
              ><i @click="addLectureModal" class="fa fa-plus"></i
            ></a>
          </div>
        </div>


        <div class="card-body">




      <div class="div-table" v-if="lectures.length > 0">

             <div class="div-table-row div-table-head">
                <div class="div-table-col  div-table-col-5 text-right">المسلسل</div>
                <div class="div-table-col div-table-col-5 text-right">المحاضره</div>
                <div class="div-table-col div-table-col-5 text-right">الدكتور</div>
                <div class="div-table-col div-table-col-5 text-right">تعديل</div>
                <div class="div-table-col div-table-col-5 text-right">اضافه ملف</div>
             </div>

            <draggable v-model="lectures" @change="changelectureOrder" tag="div">

            <div class="div-table-row" v-for="(lecture,index) in lectures" :key="'tr-'+index">
                <div class="div-table-col div-table-col-5 text-right">1</div>
                <div class="div-table-col div-table-col-5 text-right">{{ lecture.title }}</div>
                <div class="div-table-col div-table-col-5 text-right">{{ lecture.teacher }}</div>
                <div class="div-table-col div-table-col-5 text-right">
                    <a href="javascript:;" @click="editLectureModel(lecture)">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:;" @click="deleteLecture(lecture.id)">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="div-table-col div-table-col-5 text-right">
                    <a href="javascript:;">
                        <i @click="addLectureMediaModal(lecture.id)" class="fa fa-plus"></i>
                    </a>
                </div>





            <div :key="'attachments-table-'+index" class="attachments-table" v-if="lecture.attachments && lecture.attachments.length > 0">


                <table class="table">
                                <thead>
                                    <th>الملف</th>
                                    <th>نوعه</th>
                                    <th>تحميل</th>
                                    <th>ملف المحاضره</th>
                                    <th>تعديل</th>
                                </thead>
                                <draggable v-model="lecture.attachments" tag="tbody" @change="changeAttachmentOrder(index)">
                                <tr v-for="(attachment,aindex) in lecture.attachments" :key="'attachments-'+aindex">
                                    <td>{{ attachment.title }}</td>
                                    <td>{{ attachment.type }}</td>
                                    <td>{{ attachment.link }}</td>
                                    <td>{{ attachment.lecture ? 'نعم' : 'لا'}}</td>
                                    <td>
                                            <a href="javascript:;" @click="editLectureMediaModel(attachment)"
                                                ><i class="fa fa-edit"></i
                                            ></a>

                                            <a
                                                href="javascript:;"
                                                @click="deleteLectureMedia(lecture.id,attachment.id)"
                                                ><i class="fa fa-times"></i
                                            ></a>
                                    </td>

                                </tr>
                                </draggable>

                            </table>


            </div>
            <div v-else>
                لا توجد محاضرات في هذا الكورس
            </div>



            </div>
        </draggable>






      </div>








    </div>



            </div>
        </div>
    </div>





<!-- Modal -->
<div class="modal fade" id="AddLectureModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">اضافه محاضرة</h5>
        <button type="button" class="ml-1 close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>

            <div class="form-group row">
                <label for="lec-title" class="col-sm-2 col-form-label"
                  >المحاضره</label
                >
                <div class="col-sm-10">
                  <input
                    type="text"
                    v-model="form.title"
                    class="form-control"
                    id="lec-title"
                    placeholder="المحاضره"
                  />
                  <has-error :form="form" field="title"></has-error>
                </div>
            </div>

            <div class="form-group row">
                <label for="teacher" class="col-sm-2 col-form-label"
                  >المحاضر</label
                >
                <div class="col-sm-10">
                  <input
                    type="text"
                    v-model="form.teacher"
                    class="form-control"
                    id="teacher"
                    placeholder="المحاضر"
                  />
                  <has-error :form="form" field="teacher"></has-error>
                </div>
            </div>


        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
        <button type="button" v-if="!form.id" @click="addLecture" class="btn btn-primary">اضافه</button>
        <button type="button" v-if="form.id" @click="editLecture" class="btn btn-primary">تعديل</button>
      </div>
    </div>
  </div>
</div><!-- add Lecture form modal -->


<!-- Modal -->
<div class="modal fade" id="AddLectureMediaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">اضافه ملف</h5>
        <button type="button" class="ml-1 close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>



            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label"
                  >عنوان الملف</label
                >
                <div class="col-sm-10">
                  <input
                    type="text"
                    v-model="mediaForm.title"
                    class="form-control"
                    id="title"
                    placeholder="العنوان"
                  />
                  <has-error :form="mediaForm" field="title"></has-error>
                </div>
            </div>




            <div class="form-group row">
                <label for="link" class="col-sm-2 col-form-label"
                  >الملف</label
                >
                <div class="col-sm-10">
                  <input
                    type="text"
                    v-model="mediaForm.link"
                    class="form-control"
                    id="link"
                    placeholder="الملف"
                  />
                  <has-error :form="mediaForm" field="link"></has-error>
                </div>
            </div>


            <div class="form-group row">
                <label for="type" class="col-sm-2 col-form-label"
                  >نوع الملف</label
                >
                <div class="col-sm-10">
                  <select class="form-control" v-model="mediaForm.type" id="type">
                    <option value="">نوع الملف</option>
                        <option value="youtube">
                        Youtube
                        </option>

                        <option value="audio">
                        Audio
                        </option>

                        <option value="pdf">
                        PDF
                        </option>

                  </select>

                  <has-error :form="mediaForm" field="type"></has-error>
                </div>
              </div>



            <div class="form-group row">
                <label for="primary" class="col-sm-2 col-form-label"
                  >المحاضره</label
                >
                <div class="col-sm-10">
                  <input
                    type="checkbox"
                    v-model="mediaForm.lecture"
                  />
                </div>
            </div>



        </form>
      </div>
      <div class="modal-footer">
        <button type="button" v-if="!mediaForm.id" @click="addLectureMedia" class="btn btn-primary">اضافه</button>
        <button type="button" v-if="mediaForm.id" @click="editLectureMedia" class="btn btn-primary">تعديل</button>
      </div>
    </div>
  </div>
</div><!-- add lecture media modal -->

</div>
</template>

<script>

import { mapGetters } from "vuex";
import draggable from "vuedraggable";


export default {
  props: ['id'],
  data() {
      return {
      form: new Form({
            id: null,
            title: "",
            teacher: "",
        }),
        mediaForm: new Form({
            id: null,
            lecture_id: "",
            title: "",
            link: "",
            type:"",
            lecture:false
        })
       }
  },
  methods: {
      addLectureModal() {
        this.form.clear();
        this.form.reset();
        $('#AddLectureModal').modal('show');
      },
      addLecture(){
        let lecture = {
            course_id: this.id,
            title: this.form.title,
            teacher: this.form.teacher,
            serial: 0,
            order:0,
        };

        this.$store
            .dispatch("courses/addCourseLecture", lecture)
            .then((response) => {
            $("#AddLectureModal").modal("hide");
            this.form.clear();
            this.form.reset();
            })
            .catch((error) => {
                if (error.response) {
                    this.form.errors.errors = error.response.data.errors;
                }
            });
      },

      getCourseLectures(){
        this.$store
            .dispatch("courses/getCourseLectures", {id:this.id})
            .then((response) => {
            })
            .catch((error) => {
                if (error.response) {
                    this.form.errors.errors = error.response.data.errors;
                }
            });
      },

      addLectureMediaModal(lecture_id) {
        this.mediaForm.lecture_id = lecture_id;
        $('#AddLectureMediaModal').modal('show');
      },
      editLectureModel(lecture){
          this.form.clear();
          this.form.reset();
          this.form.fill(lecture);
          $('#AddLectureModal').modal('show');
      },

      editLecture(){
        let lecture = {
            id: this.form.id,
            course_id: this.id,
            title: this.form.title,
            teacher: this.form.teacher,
            serial: 0,
            order:0,
        };
        this.$store
            .dispatch("courses/editCourseLecture", lecture)
            .then((response) => {
            $("#AddLectureModal").modal("hide");
            this.form.clear();
            this.form.reset();
            })
            .catch((error) => {
                if (error.response) {
                    this.form.errors.errors = error.response.data.errors;
                }
        });
      },
      deleteLecture(id){


        Swal.fire({
                title: 'هل انت متأكد ؟',
                text: "لايمكنك التراجع عن هذا الاجراء.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم',
                cancelButtonText: 'تراجع'
                }).then((result) => {
                if (result.value) {
                        this.$store
                            .dispatch("courses/deleteCourseLecture", {id})
                            .then((response) => {
                                Toast.fire("تم حفظ الاجابات", "", "info");
                            })
                            .catch((error) => {
                                if (error.response) {
                                    this.form.errors.errors = error.response.data.errors;
                                }
                        });
                }
                });

      },
       addLectureMedia() {
            let media = {
                course_id: this.id,
                lecture_id: this.mediaForm.lecture_id,
                title: this.mediaForm.title,
                link: this.mediaForm.link,
                type: this.mediaForm.type,
                lecture:this.mediaForm.lecture,
            };
            this.$store
                .dispatch("courses/addLectureMedia", media)
                .then((response) => {
                $("#AddLectureMediaModal").modal("hide");
                this.mediaForm.clear();
                this.mediaForm.reset();
                })
                .catch((error) => {
                    if (error.response) {
                        this.mediaForm.errors.errors = error.response.data.errors;
                    }
            });
      },

    editLectureMediaModel(attachment){
        this.mediaForm.clear();
        this.mediaForm.reset();
        this.mediaForm.fill(attachment);
        $('#AddLectureMediaModal').modal('show');
    },

      editLectureMedia() {
            let media = {
                id: this.mediaForm.id,
                course_id: this.id,
                lecture_id: this.mediaForm.lecture_id,
                title: this.mediaForm.title,
                link: this.mediaForm.link,
                type: this.mediaForm.type,
                lecture:this.mediaForm.lecture,
            };
            this.$store
                .dispatch("courses/editLectureMedia", media)
                .then((response) => {
                $("#AddLectureMediaModal").modal("hide");
                this.mediaForm.clear();
                this.mediaForm.reset();
                })
                .catch((error) => {
                    if (error.response) {
                        this.mediaForm.errors.errors = error.response.data.errors;
                    }
            });
      },
      deleteLectureMedia(lecture_id,id){
        Swal.fire({
                title: 'هل انت متأكد ؟',
                text: "لايمكنك التراجع عن هذا الاجراء.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم',
                cancelButtonText: 'تراجع'
                }).then((result) => {
                if (result.value) {
                        this.$store
                            .dispatch("courses/deleteLectureMedia", {lecture_id,id})
                            .then((response) => {
                                Toast.fire("تم حذف الملف", "", "info");
                            })
                            .catch((error) => {
                                if (error.response) {
                                    this.form.errors.errors = error.response.data.errors;
                                }
                        });
                }
                });

      },

      changelectureOrder(){

        this.lectures.map((lecture, index) => {
            this.$store.commit("courses/updateLecturesOrder", {
            lecture,
            index,
            });
        });

        let request = this.lectures.map(function (lecture) {
        return {
          id: lecture.id,
          order: lecture.order,
        };
      });


      this.$store
        .dispatch("courses/updateLecturesOrder", {
          lectures: request,
        })
        .then((response) => {})
        .catch((error) => {});
    },
    changeAttachmentOrder($index){

        // this.lectures[$index].attachments.map((attachment, index) => {
        //     this.$store.commit("courses/updateLectureAttachmentsOrder", {
        //     attachment,
        //     index,
        //     });
        // });

        let request = this.lectures[$index].attachments.map(function (attachement,index) {
        return {
          id: attachement.id,
          order: index + 1,
        };
      });


      this.$store
        .dispatch("courses/updateLectureAttachmentsOrder", {
          attachements: request,
        })
        .then((response) => {})
        .catch((error) => {
            console.log(error);
        });


    }
  },


  mounted() {
    this.getCourseLectures();
  },
  computed: {
    ...mapGetters({
      //lectures: "courses/getCourseLectures",
    }),

    lectures: {
      get() {
        return this.$store.state.courses.lectures;
      },
      set(lectures) {
        this.$store.commit("courses/setCourseLectures", lectures);
      },
    },


  },
  components: {
    draggable,
  },

}

</script>

<style scoped>
    .files-table {
    }
    .lecture-table,.lecture-table tr,.lecture-table td, .lecture-table th{
        border:2px solid #dee2e6;
    }


    .invalid-feedback {
         display: block;
    }



.div-table {
  display: table;
  width: 100%;
  background-color: #eee;
  border: 1px solid #666666;
  border-spacing: 5px; /* cellspacing:poor IE support for  this */
}
.div-table-row {
  display: block;
  width: 100%;
  clear: both;
}
.div-table-col {
  float: right; /* fix for  buggy browsers */
  display: table-column;
  background-color: #ccc;
}

.div-table-col-3{
    width:33.3333%
}

.div-table-col-5{
    width:20%;
}


</style>
