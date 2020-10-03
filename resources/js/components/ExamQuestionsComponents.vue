<template>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          الاسئله

          <div class="card-tools">
            <a href="javascript:;"
              ><i @click="AddMainQuestionModal" class="fa fa-plus"></i
            ></a>
          </div>
        </div>
        <div class="card-body">
          <draggable
            @change="changeMainQuestionsOrder"
            v-if="AllMainQuestions.length > 0"
            :options="{ animation: 300 }"
            v-model="AllMainQuestions"
          >
            <div
              v-for="(mainQuestion, mindex) in AllMainQuestions"
              :key="mindex"
            >
              <div class="">
                {{ mainQuestion.question }}

                <div class="pull-left">
                  <a href="javascript:;"
                    ><i
                      @click="editMainQuestionModal(mainQuestion)"
                      class="fa fa-edit"
                    ></i
                  ></a>
                  <a href="javascript:;">
                    <i
                      @click="deleteMainQuestion(mainQuestion.id)"
                      class="fa fa-times"
                    ></i>
                  </a>
                </div>
              </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>الترتيب</th>
                    <th>السؤال</th>
                    <th>الدرجة</th>
                    <th>الاجابات</th>
                    <th style="width: 40px">
                      <i
                        @click="AddQuestionModal(mainQuestion.id)"
                        class="fa fa-plus"
                      ></i>
                    </th>
                  </tr>
                </thead>

                <draggable
                  :options="{ animation: 300 }"
                  @change="changeQuestionsOrder(mindex)"
                  v-model="AllMainQuestions[mindex].questions"
                  tag="tbody"
                >
                  <tr
                    v-for="(question, index) in mainQuestion.questions"
                    :key="index"
                  >
                    <td>{{ question.order }}</td>
                    <td>{{ question.question }}</td>
                    <td>
                      {{ question.degree }}
                    </td>
                    <td>
                      <ul>
                        <li
                          v-for="(answer, aindex) in question.answers"
                          :key="aindex"
                        >
                          {{ answer.answer }}
                          {{ answer.right ? "صحيحه" : "خطأ" }}
                        </li>
                      </ul>
                    </td>
                    <td>
                      <a href="javascript:;" @click="editQuestion(question)"
                        ><i class="fa fa-edit"></i
                      ></a>

                      <a
                        href="javascript:;"
                        @click="deleteQuestion(question.id)"
                        ><i class="fa fa-times"></i
                      ></a>
                    </td>
                  </tr>
                </draggable>
              </table>
            </div>
          </draggable>

          <div v-else>لسه مفيش اسئله</div>
        </div>
      </div>
    </div>

    <!-- Add Main Question Modal -->
    <div
      class="modal fade"
      id="AddMainQuestionModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="AddMainQuestionModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="AddMainQuestionModalLabel">
              سؤال رئيسي
            </h5>
            <button
              type="button"
              class="ml-1 close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group row">
                <label for="question" class="col-sm-2 col-form-label"
                  >السؤال</label
                >
                <div class="col-sm-10">
                  <input
                    type="text"
                    v-model="mainform.question"
                    class="form-control"
                    id="question"
                    placeholder="السؤال"
                  />
                  <has-error :form="form" field="question"></has-error>
                </div>
              </div>

              <div class="form-group row">
                <label for="notes" class="col-sm-2 col-form-label"
                  >ملاحظات</label
                >
                <div class="col-sm-10">
                  <textarea
                    v-model="mainform.notes"
                    class="form-control"
                    id="notes"
                    placeholder="ملاحظات"
                  ></textarea>
                  <has-error :form="form" field="notes"></has-error>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              الغاء
            </button>

            <button
              v-if="!this.editMainQuestion"
              type="button"
              class="btn btn-primary"
              @click="SaveMainQuestion"
            >
              اضافه سؤال
            </button>

            <button
              v-if="this.editMainQuestion"
              type="button"
              class="btn btn-primary"
              @click="updateMainQuestion"
            >
              تعديل سؤال
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Add Question Modal -->
    <div
      class="modal fade"
      id="AddQuestionModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">اضافة سؤال</h5>
            <button
              type="button"
              class="ml-1 close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group row">
                <label for="question" class="col-sm-2 col-form-label"
                  >السؤال</label
                >
                <div class="col-sm-10">
                  <input
                    type="text"
                    v-model="form.question"
                    class="form-control"
                    id="question"
                    placeholder="السؤال"
                  />
                  <has-error :form="form" field="question"></has-error>
                </div>
              </div>

              <div class="form-group row">
                <label for="degree" class="col-sm-2 col-form-label"
                  >الدرجه</label
                >
                <div class="col-sm-10">
                  <input
                    type="text"
                    v-model="form.degree"
                    class="form-control"
                    id="degree"
                    placeholder="الدرجه"
                  />
                  <has-error :form="form" field="degree"></has-error>
                </div>
              </div>
              <div v-if="allCategories" class="form-group row">
                <label for="category" class="col-sm-2 col-form-label"
                  >التصنيف</label
                >
                <div class="col-sm-10">
                  <!-- <multiselect
                                        v-model="form.category_id"
                                        track-by="id"
                                        label="category"
                                        :options="allCategories"
                                        :clear-on-select="false"
                                    >
                                    </multiselect> -->

                  <select class="form-control" v-model="form.category_id">
                    <option value="">اختار تصنيف</option>

                    <option
                      v-for="(value, index) in allCategories"
                      :key="index"
                      :value="value.id"
                      :selected="form.category_id == value.id"
                    >
                      {{ value.category }}
                    </option>
                  </select>

                  <has-error :form="form" field="category_id"></has-error>
                </div>
              </div>

              <ul class="list-group">
                <li
                  class="list-group-item"
                  v-for="(answer, index) in form.answers"
                  :key="index"
                >
                  <input type="text" v-model="answer.answer" />
                  <label :for="'answer-' + index">
                    صحيحه :
                    <input
                      :id="'answer-' + index"
                      v-model="answer.right"
                      type="checkbox"
                      :checked="answer.right"
                    />

                    <a
                      v-if="index > 1"
                      href="javascript:;"
                      class="pull-left mt-2"
                      ><i
                        @click="removeQuestionAnswer(index)"
                        class="fa fa-minus"
                        >حذف الاجابه</i
                      ></a
                    >
                  </label>
                  <has-error
                    :form="form"
                    :field="'answers.' + index + '.answer'"
                  ></has-error>
                </li>

                <a href="javascript:;" class="pull-left mt-2"
                  ><i @click="AddQuestionAnswer" class="fa fa-plus"
                    >اضافه اجابه</i
                  ></a
                >
              </ul>

              <div class="form-group row">
                <label for="notes" class="col-sm-2 col-form-label"
                  >ملاحظات</label
                >
                <div class="col-sm-10">
                  <textarea
                    v-model="form.notes"
                    class="form-control"
                    id="notes"
                    placeholder="ملاحظات"
                  ></textarea>
                  <has-error :form="form" field="notes"></has-error>
                </div>
              </div>

              <div class="form-group row">
                <label for="visible" class="col-sm-2 col-form-label"
                  >مفعل</label
                >
                <div class="col-sm-10">
                  <input
                    v-model="form.visible"
                    type="checkbox"
                    :checked="form.visible"
                  />
                </div>
              </div>
            </form>
          </div>

          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              الغاء
            </button>
            <button
              type="button"
              v-if="!edit"
              @click="SaveQuestion"
              class="btn btn-primary"
            >
              حفظ
            </button>
            <button
              type="button"
              v-if="edit"
              @click="updateQuestion"
              class="btn btn-primary"
            >
              تحديث
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import draggable from "vuedraggable";

export default {
  props: ["id"],
  data() {
    return {
      edit: false,
      editMainQuestion: false,
      questions: [],
      form: new Form({
        question: "",
        degree: "",
        answers: [
          {
            answer: "",
            right: false,
          },
          {
            answer: "",
            right: false,
          },
        ],
        category_id: null,
      }),
      mainform: new Form({
        question: "",
        notes: "",
      }),
    };
  },
  methods: {
    AddMainQuestionModal(e) {
      e.preventDefault();
      $("#AddMainQuestionModal").modal("show");
      this.edit = false;
      this.form.clear();
      this.form.reset();
    },

    SaveMainQuestion() {
      let question = {
        exam: this.id,
        question: this.mainform.question,
        notes: this.mainform.notes,
      };

      this.$store
        .dispatch("questions/addMainQuestion", question)
        .then((response) => {
          $("#AddMainQuestionModal").modal("hide");
          this.form.clear();
          this.form.reset();
        })
        .catch((error) => {
          if (error.response) {
            this.form.errors.errors = error.response.data.errors;
          }
        });
    },

    editMainQuestionModal(mainQuestion) {
      this.editMainQuestion = true;
      this.mainform.clear();
      this.mainform.clear();
      this.mainform.fill(mainQuestion);
      this.mainform.id = mainQuestion.id;
      $("#AddMainQuestionModal").modal("show");
    },

    updateMainQuestion() {
      let question = {
        exam: this.id,
        id: this.mainform.id,
        question: this.mainform.question,
        notes: this.mainform.notes,
      };
      this.$store
        .dispatch("questions/updateMainQuestion", question)
        .then((response) => {
          $("#AddMainQuestionModal").modal("hide");
          this.form.clear();
          this.form.reset();
        })
        .catch((error) => {
          if (error.response) {
            this.form.errors.errors = error.response.data.errors;
          }
        });
    },

    AddQuestionModal(main_question_id) {
      $("#AddQuestionModal").modal("show");
      this.edit = false;
      this.form.clear();
      this.form.reset();
      this.form.main_question_id = main_question_id;
    },
    AddQuestionAnswer(e) {
      this.form.answers.push({
        answer: "",
        right: false,
      });
    },
    removeQuestionAnswer(index) {
      this.form.answers.splice(index, 1);
    },
    getMainQuestions() {
      this.$store
        .dispatch("questions/getMainQuestions", this.id)
        .then((response) => {})
        .catch((error) => {
          console.log(error);
        });
    },
    getQuestions() {
      this.$store
        .dispatch("questions/getQuestions", this.id)
        .then((response) => {})
        .catch((error) => {
          console.log(error);
        });
    },
    getCategories() {
      this.$store
        .dispatch("categories/getCategories")
        .then((response) => {})
        .catch((error) => {
          console.log(error);
        });
    },

    SaveQuestion() {
      let question = {
        exam: this.id,
        question: this.form.question,
        main_question_id: this.form.main_question_id,
        degree: this.form.degree,
        answers: this.form.answers,
        order: 0,
        notes: this.form.notes,
        category_id: this.form.category_id ? this.form.category_id : null,
        visible: this.form.visible,
      };

      this.$store
        .dispatch("questions/addQuestion", question)
        .then((response) => {
          $("#AddQuestionModal").modal("hide");
          this.form.clear();
          this.form.reset();
        })
        .catch((error) => {
          if (error.response) {
            this.form.errors.errors = error.response.data.errors;
          }
        });
    },

    editQuestion(question) {
      this.edit = true;
      let Ques = JSON.parse(JSON.stringify(question));
      this.form.clear();
      this.form.reset();
      this.form.fill(Ques);
      this.form.id = Ques.id;
      $("#AddQuestionModal").modal("show");
    },
    updateQuestion() {
      let question = {
        id: this.form.id,
        exam: this.id,
        question: this.form.question,
        degree: this.form.degree,
        answers: this.form.answers,
        order: 0,
        notes: this.form.notes,
        category_id: this.form.category_id ? this.form.category_id : null,
        visible: this.form.visible,
      };

      this.$store
        .dispatch("questions/updateQuestion", question)
        .then((response) => {
          $("#AddQuestionModal").modal("hide");
          this.form.clear();
          this.form.reset();
          this.edit = false;
        })
        .catch((error) => {
          if (error.response) {
            this.form.errors.errors = error.response.data.errors;
          }
        });
    },
    deleteQuestion(id) {
      this.$store
        .dispatch("questions/deleteQuestion", { id })
        .then((response) => {})
        .catch((error) => {
          //console.log(error);
        });
    },

    deleteMainQuestion(id) {
      this.$store
        .dispatch("questions/deleteMainQuestion", { id })
        .then((response) => {})
        .catch((error) => {
          //console.log(error);
        });
    },

    changeQuestionsOrder(mindex) {
      this.AllMainQuestions[mindex].questions.map((question, index) => {
        this.$store.commit("questions/updateQuestionOrder", {
          question,
          index,
          mindex,
        });
      });
      let request = this.AllMainQuestions[mindex].questions.map(function (
        question
      ) {
        return {
          id: question.id,
          order: question.order,
        };
      });

      this.$store
        .dispatch("questions/updateQuestionOrder", {
          questions: request,
        })
        .then((response) => {})
        .catch((error) => {});
    },

    changeMainQuestionsOrder(mindex) {
      this.AllMainQuestions.map((question, index) => {
        this.$store.commit("questions/updateMainQuestionOrder", {
          question,
          index,
        });
      });
      let request = this.AllMainQuestions.map(function (question) {
        return {
          id: question.id,
          order: question.order,
        };
      });

      this.$store
        .dispatch("questions/updateMainQuestionOrder", {
          questions: request,
        })
        .then((response) => {})
        .catch((error) => {});
    },
  },

  mounted() {
    this.getMainQuestions();
    this.getQuestions();
    this.getCategories();
  },
  computed: {
    ...mapGetters({
      allCategories: "categories/allCategories",
      AllMainQuestions: "questions/allMainQuestions",
    }),
    AllMainQuestions: {
      get() {
        return this.$store.state.questions.mainQuestions;
      },
      set(mainQuestions) {
        this.$store.commit("questions/setMainQuestions", mainQuestions);
      },
    },
  },
  components: {
    draggable,
  },
};
</script>
<style scoped>
.invalid-feedback {
  display: block;
}
.multiselect__input,
.multiselect__single {
  text-align: right !important;
}
.multiselect__select {
  float: left !important;
}
</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
