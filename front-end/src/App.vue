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

        axios.post(url, data, headers)
          .then(response => {
            this.todoList = response.data;

            this.newTodo.to = "";
        })
        .catch(error => console.error("error", error));
    }  
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
      <li v-for="(todo, index) in todoList" :key="index">

        {{todo.to}}
      
      </li>
    </ul>
  </div>

</template>

<style>

</style>
