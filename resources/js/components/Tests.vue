<template>
  <div class="container mx-auto">
    <div class="form-group">
      <router-link :to="{name: 'createTest'}" class="btn btn-success">Create new Test</router-link>
    </div>
    <div v-for="test in tests">
      <div v-for="tests in test.tests">
        <router-link :to="{name: 'editTest', params: {test_id: test.test_id}}" class="btn btn-xs btn-default">
          Edit
        </router-link>
        <a href="#" class="btn btn-xs btn-danger" v-on:click="deleteEntry(test.test_id, index)">
            Delete
        </a>
        Ид теста: {{ tests.test_id }}
        <div v-for="question in tests.questions">
          <p>Вопрос: {{ question.question }}</p>
          <p>ИД Вопроса: {{ question.question_id }}</p>
          <form v-for="answer in question.answers" @click="setResult(tests.questions)">
          <input type="radio" v-bind:id="answer.answer_id" v-bind:data-correct="answer.correct" v-bind:value="answer.answer_id"  @click="getCorrect">
          <label v-bind:for="answer.answer_id">{{ answer.answer }}</label>
          </input>
          <label>ИД ответа: {{ answer.answer_id }}</label>
          </form>
        </div>
        <button @click="getResult">Получить результат</button>
        <div class="result-hidden" v-bind:class="{ resultShow: showResult }">Вы ответили на: {{ counter }} Вопрос(ов)<br> Что составляет {{ percentCorrect }} %</div>
      </div>
    </div>
  </div>
</template>


<style>
  .result-hidden {
    display: none;
  }
  .resultShow {
    width: 1000px;
    padding: 20px;
    display: block;
  }
</style>

 <script>
      export default {
      data: function () {
            return {
          showResult: false,
          percentCorrect: 0,
          questionsLenght: 0,
          tests: [],
          counter: 0,
          }
        },
        mounted() {
          // https://api.myjson.com/bins/sbev0
            axios.get("https://api.myjson.com/bins/d7414")
              .then(response => {
                this.tests = response.data
              })
        },
        methods: {
          getCorrect(e) {
            
            console.log(this.questionsLenght)
            console.log(e.currentTarget)
            if(e.currentTarget.getAttribute('data-correct')) {
              
              this.counter += 1;
              let list = e.target.parentElement.parentElement.getElementsByTagName("input");
              for (var i = 0; i < list.length; i++) {
              list[i].disabled = true;
          }
              // e.target.parentElement.parentElement.hidden = true
              // e.currentTarget.hidden = false
              e.target.classList.add('correct');
            } else if (!e.currentTarget.getAttribute('data-correct')) {
              e.target.classList.add('wrong');
              let list = e.target.parentElement.parentElement.getElementsByTagName("input");
              for (var i = 0; i < list.length; i++) {
              list[i].disabled = true;
          }
          // e.target.parentElement.parentElement.hidden = true
            } else {
              e.currentTarget.classList.add('wrong');
            }
          },
          setResult(answers) {
            this.questionsLenght = answers.length
            console.log(this.questionsLenght)
          },
          getResult() {
            if(this.counter == 0) {
              this.percentCorrect == 0;
              this.showResult = true
            } else {
              this.percentCorrect = Math.round((100 / this.questionsLenght) * this.counter)
              this.percentCorrect
              this.showResult = true
            }
  
          }
        }
      };
    </script>

















