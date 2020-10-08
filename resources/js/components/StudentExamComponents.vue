<template>
  <div>
    <div v-if="exam && !ended">
      {{ exam.title }} ({{ exam.doctor }})
      {{ exam.notes ? '"' + exam.notes + '"' : "" }}

      <div :class="{ loading: isLoading }" v-if="exam.main_questions">
        <ul class="list-unstyled rtl-list">
          <li
            v-for="(question, mindex) in exam.main_questions.data"
            :key="mindex"
          >
            {{ question.question }} ({{ question.notes }})
            <ul class="list-unstyled">
              <li
                class="question m-2 p-3"
                :class="{ missed: missed.indexOf(subquestion.id) >= 0 }"
                v-for="(subquestion, sindex) in question.questions"
                :key="sindex"
              >
                {{ subquestion.question }}(<b>{{ subquestion.degree }} درجة</b>)
                <ul class="list-unstyled">
                  <li
                    v-for="(answer, aindex) in subquestion.answers"
                    :key="aindex"
                  >
                    <label
                      ><input
                        type="radio"
                        :value="answer.id"
                        v-model="selected[subquestion.id]"
                        :name="'selected.' + subquestion.id"
                      />&nbsp;&nbsp;{{ answer.answer }}</label
                    >
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>

        <pagination
          :data="laravelData"
          @pagination-change-page="gotoPage"
        ></pagination>

        <div>
          <button
            class="btn btn-large btn-primary"
            @click="
              save = true;
              saveAnswers();
            "
          >
            حفظ الامتحان
          </button>

          <button class="btn btn-large btn-primary" @click="endExam()">
            انهاء الامتحان
          </button>
        </div>
      </div>
    </div>
    <div class="" v-if="ended">
      تم انهاء هذا الامتحان

      <br />

      <div :class="{ loading: isLoading }" v-if="examResult && examResult.exam">
        {{ examResult.exam.result.fullmark }} الدرجه الكليه
        <br />
        {{ examResult.exam.result.degree }} الدرجه الطالب
        <br />
        % {{ examResult.exam.result.percentage }} النسبه المئويه
        <br />
        {{ examResult.exam.result.result_date }} تاريخ انهاء الامتحان

        <ul class="list-unstyled rtl-list">
          <li
            v-for="(question, mindex) in examResult.exam.main_questions"
            :key="mindex"
          >
            {{ question.question }} ({{ question.notes }})
            <ul class="list-unstyled">
              <li
                class="question m-2 p-3"
                v-for="(subquestion, sindex) in question.questions"
                :key="sindex"
              >
                {{ subquestion.question }} (<b>{{ subquestion.degree }} درجة</b
                >)
                <ul class="list-unstyled">
                  <li
                    v-for="(answer, aindex) in subquestion.answers"
                    :key="aindex"
                  >
                    <label
                      :class="{
                        wrong: wrong.indexOf(answer.id) >= 0,
                        right: right.indexOf(answer.id) >= 0,
                      }"
                      ><input
                        disabled="disabled"
                        type="radio"
                        :value="answer.id"
                        v-model="selected[subquestion.id]"
                        :name="'selected.' + subquestion.id"
                      />&nbsp;&nbsp;{{ answer.answer }}

                      <span v-if="wrong.indexOf(answer.id) >= 0"
                        >( الاجابه خاطئه )</span
                      ><span v-if="right.indexOf(answer.id) >= 0"
                        >( الاجابه صحيحة )</span
                      >
                    </label>
                  </li>
                </ul>
                <span class="notes" v-if="subquestion.notes">
                  {{ subquestion.notes }}
                </span>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  props: ["id"],
  data() {
    return {
      save: false,
      missed: [],
      q_saved: false,
      selected: [],
      wrong: [],
      right: [],
      questions_ids: [],
      page: 1,
      laravelData: {},
      isLoading: false,
      ended: false,
    };
  },
  methods: {
    gotoPage(page) {
      this.page = page;
      this.isLoading = true;

      if (Object.keys(this.selected).length > 0) {
        let $this = this;
        this.saveAnswers().then(function () {
          $this.getExam();
        });
      } else {
        this.getExam();
      }
    },
    getExam() {
      let $this = this;
      this.$store
        .dispatch("exams/getExam", { id: this.id, page: this.page })
        .then((response) => {
          //   if (this.page == 1) {
          this.selected = [];
          this.questions_ids = response.data.response.exam.main_questions.data[0].questions.map(
            (question) => question.id
          );

          //}
          this.laravelData = response.data.response.exam.main_questions;

          this.getAnswers(this.questions_ids).then((result) => {
            this.isLoading = false;
          });
        })
        .catch((error) => {
          this.ended = true;
          Toast.fire(error.response.data.message, "", "info");
          this.getExamResult();
        });
    },
    getAnswers(questions_ids) {
      return this.$store
        .dispatch("exams/getAnswers", {
          questions_ids,
        })
        .then((response) => {
          this.selected = response.data.response.answers;
          this.isLoading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    saveAnswers() {
      return this.$store
        .dispatch("exams/saveAnswers", {
          answers: this.selected,
          id: this.id,
          questions_ids: this.questions_ids,
        })
        .then((response) => {
          if (this.save) {
            Toast.fire("تم حفظ الاجابات", "", "info");
            this.save = false;
          }
        })
        .catch((error) => {});
    },
    endExam() {
      if (this.missed.length > 0 && !this.q_saved) {
        Toast.fire("قم بحفظ الامتحان اولاً", "", "ُerror");
        return false;
      }
      this.q_saved = true;
      this.$store
        .dispatch("exams/endExam", {
          id: this.id,
        })
        .then((response) => {
          Toast.fire("تم انهاء الامتحان", "", "info");
          this.getExamResult();
          this.ended = true;
        })
        .catch((error) => {
          this.missed = error.response.data.data;
          Toast.fire(error.response.data.message, "", "error");
        });
    },
    getExamResult() {
      this.loading = true;
      this.ended = true;
      return this.$store
        .dispatch("exams/getExamResult", {
          id: this.id,
          result: true,
        })
        .then((response) => {
          this.selected = response.data.response.answers;
          this.wrong = response.data.response.wrong;
          this.right = response.data.response.right;
          this.isLoading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getParameterByName(name, url = null) {
      if (!url) url = window.location.href;
      name = name.replace(/[\[\]]/g, "\\$&");
      var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return "";
      return decodeURIComponent(results[2].replace(/\+/g, " "));
    },
  },

  mounted() {
    this.page = this.getParameterByName("page")
      ? this.getParameterByName("page")
      : 1;
    this.getExam();
  },
  computed: {
    ...mapGetters({
      exam: "exams/getExam",
      answers: "exams/getExam",
      examResult: "exams/getExamResult",
    }),
  },
};
</script>

<style scoped>
.rtl-list {
  direction: rtl;
}
.question {
  background-color: white;
  border-radius: 5px;
  /* border: 1px solid #ccc; */
  box-shadow: 0px 0px 2px #ccc;
}
.loading {
  opacity: 0.5;
}
.missed {
  border: 1px solid red;
}
.wrong {
  color: red;
  font-weight: bold;
}

.right {
  color: green;
  font-weight: bold;
}

.notes {
  background-color: #fbf3d2;
  border-radius: 5px;
  border: 1px solid #ffe783;
  padding: 5px;
}
</style>
