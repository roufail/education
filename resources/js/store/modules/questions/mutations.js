export default {
    setMainQuestions(state, mainQuestions) {
        state.mainQuestions = mainQuestions.filter(function(el) {
            return el != undefined;
        });
    },

    setQuestions(state, questions) {
        state.questions = questions;
    },

    addQuestion(state, question) {
        let mindex = state.mainQuestions
            .map(question => question.id)
            .indexOf(question.main_question_id);
        state.mainQuestions[mindex].questions.push(question);
    },
    deleteQuestion(state, ids) {
        let mindex = state.mainQuestions
            .map(question => question.id)
            .indexOf(ids.main_question_id);
        let index = state.mainQuestions[mindex].questions
            .map(question => question.id)
            .indexOf(ids.question_id);
        state.mainQuestions[mindex].questions.splice(index, 1);
    },
    updateQuestion(state, question) {
        let mindex = state.mainQuestions
            .map(question => question.id)
            .indexOf(question.main_question_id);
        let index = state.mainQuestions[mindex].questions
            .map(question => question.id)
            .indexOf(question.id);
        state.mainQuestions[mindex].questions[index] = question;
    },
    updateQuestionOrder(state, data) {
        // let index = state.questions.map(newquestion => newquestion.id ).indexOf(data.question.id);
        let index = state.mainQuestions[data.mindex].questions
            .map(newquestion => newquestion.id)
            .indexOf(data.question.id);
        state.mainQuestions[data.mindex].questions[index].order =
            data.index + 1;
    },
    addMainQuestion(state, question) {
        state.mainQuestions.push(question);
    },
    updateMainQuestionOrder(state, data) {
        let index = state.mainQuestions
            .map(newquestion => newquestion.id)
            .indexOf(data.question.id);
        state.mainQuestions[index].order = data.index + 1;
    },

    updateMainQuestion(state, question) {
        let index = state.mainQuestions
            .map(newquestion => newquestion.id)
            .indexOf(question.id);
        state.mainQuestions[index] = question;
    },

    deleteMainQuestion(state, question) {
        let index = state.mainQuestions
            .map(newquestion => newquestion.id)
            .indexOf(question.main_question_id);
        state.mainQuestions.splice(index, 1);
    },

};
