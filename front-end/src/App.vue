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
    
  },
  mounted() {
    axios.get('http://localhost:8888/giorno58/php-todo-list-json/back-end/back-and.php')
    .then(response => {
        this.todoList = response.data;
      });
  },



}
</script>

<template>

  <div class="container">
    <h1>todo</h1>
    <ul>
      <li v-for="(todo, index) in todoList" :key="index">

        {{todoList.to}}
      
      </li>
    </ul>
  </div>

</template>

<style>

</style>
