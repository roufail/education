export default {
    setMainQuestions(state, mainQuestions) {
        state.mainQuestions = mainQuestions.filter(function (el) {
            return el != undefined;
          });
    },

    setQuestions(state, questions) {
        state.questions = questions
    },


    addQuestion(state, question) {
        state.questions.push(question);
    },
    deleteQuestion(state,question_id){
        let index = state.questions.map(question => question.id ).indexOf(question_id);
        state.questions.splice(index,1);
    },
    updateQuestion(state,question) {
        let index = state.questions.map(question => question.id ).indexOf(question.id);
        state.questions[index] = question;
    },
    updateQuestionOrder(state,data) {
        // let index = state.questions.map(newquestion => newquestion.id ).indexOf(data.question.id);
        let index = state.mainQuestions[data.mindex].questions.map(newquestion => newquestion.id ).indexOf(data.question.id);
        state.mainQuestions[data.mindex].questions[index].order = data.index + 1;
    }
}
