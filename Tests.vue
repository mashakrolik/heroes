<template>
<div class="container mx-auto" id="app">
  <div class="w-41 md:w-41 lg:w-41">
    <div v-for="test in tests">
        <div v-for="tests in test.tests">
            Ид теста: {{ tests.test_id }}
            <div v-for="question in tests.questions">
                <p>Вопрос: {{ question.question }}</p>
                <p>ИД Вопроса: {{ question.question_id }}</p>
                <form v-for="answer in question.answers" @click="setResult(tests.questions)">
                  <input type="radio" v-bind:id="answer.answer_id" v-bind:data-correct="answer.correct" v-bind:value="answer.answer_id"  @click="getCorrect" >
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
  data() {
    return {
      data: {
         showResult: false,
         percentCorrect: 0,
         questionsLenght: 0,
         tests: [],
         result: 0,
      },
      mounted() {
         // https://api.myjson.com/bins/sbev0
         axios.get("https://api.myjson.com/bins/q5i5k")
         .then(response => {
           this.tests = response.data
         })
      },
      methods: {
         getCorrect(e) {
           if(e.currentTarget.getAttribute('data-correct')) {
             this.result += 1;
             let list = e.target.parentElement.parentElement.getElementsByTagName("input");
             for (var i = 0; i < list.length; i++) {
             list[i].disabled = true;
         }
         e.target.classList.add('correct');
         } else if (!e.currentTarget.getAttribute('data-correct')) {
           e.target.classList.add('wrong');
           let list = e.target.parentElement.parentElement.getElementsByTagName("input");
           for (var i = 0; i < list.length; i++) {
           list[i].disabled = true;
         }
         } else {
           e.currentTarget.classList.add('wrong');
         }
         },
         setResult(answers) {
           this.questionsLenght = answers.length
         },
         getResult() {
           if(this.result == 0) {
             this.percentCorrect == 0;
             this.showResult = true
           } else {
             this.percentCorrect = (100 / this.questionsLenght) * this.result
             this.showResult = true
           }
          }
        }
      },
    }
</script>





<script>
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
      });    
    </script>














<script>
import states from "../assets/data.json";
export default {
  name: "HelloWorld",
  computed: {
    names() {
      return states.accounts.map((item) => {
        return item.name;
      })
    }
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1,
h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
