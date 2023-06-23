<script>
import axios from 'axios';

export default {
  data() {
    return {
      todoList: [],
    
      newTodo: {
        to: "",
        do: false
      }
    };
  },
  methods: {
    onSubmit(){
      const url = 'http://localhost:8888/giorno58/php-todo-list-json/back-end/postTodo.php';
      const data = this.newTodo;
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      //invio richiesta post
      axios.post(url, data, headers)
        .then(response => {
          this.todoList = response.data;

          this.newTodo.to = "";
      })
      .catch(error => console.error("error", error));
    },

    onBarrato(index){
      // Recupera l'oggetto corrispondente dall'array todoList
      const selectedTodo = this.todoList[index];
      // Modifica la proprietà 'do' nell'oggetto selezionato
      // selectedTodo.do = !selectedTodo.do;

      const url = 'http://localhost:8888/giorno58/php-todo-list-json/back-end/barratoTodo.php';
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };
      // Invia una richiesta POST a barratoTodo.php per aggiornare data.json
      axios.post(url, selectedTodo, headers)
        .then(response => {
            // Aggiorna la todoList con la risposta del server
            this.todoList = response.data;
        })
        .catch(error => {
          console.error("Errore durante la richiesta POST", error);
        });
    },
    onDelete(index){
      // Recupera l'oggetto corrispondente dall'array todoList
      const deletedTodo = this.todoList[index];

      const url = 'http://localhost:8888/giorno58/php-todo-list-json/back-end/deleteTodo.php';
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      // Invia una richiesta POST a barratoTodo.php per aggiornare data.json
      axios.post(url, deletedTodo, headers)
        .then(response => {
            // Aggiorna la todoList con la risposta del server
            this.todoList = response.data;
        })
        .catch(error => {
          console.error("Errore durante la richiesta POST", error);
        });
    },
  },
  mounted() {
    axios.get('http://localhost:8888/giorno58/php-todo-list-json/back-end/back-and.php')
    .then(response => {
        this.todoList = response.data;
        console.log(this.todoList);
      });
  },



}
</script>

<template>

  <div class="container">
    <h1>todo</h1>
    <form @submit.prevent="onSubmit">
      <input type="text" name="name" id="name" v-model="newTodo.to">
      <input type="submit" value="crea todo">
    </form>


    <ul>
      <li v-for="(todo, index) in todoList" :key="index" :class="{  'barrato': !todo.do  }" @click="onBarrato(index)">

        {{todo.to}}
        <button class="delete" @click="onDelete(index)">X</button>
      
      </li>
    </ul>
  </div>

</template>

<style>

.barrato {
  text-decoration: line-through;
}
li{
  cursor: pointer;
  text-align: right;
  width: 80%;
  margin-bottom: 10px;
}
li:hover{
  color: brown;
}
.delete{
  color: red;
  border: 1px solid red;
  padding: 2px;
  border-radius: 0;
  margin-left: 10px;
}
.delete:hover{
  background-color: rgba(255, 0, 0, 0.3);
  border: 1px solid red;
}

</style>
