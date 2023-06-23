<template>
  <div class="container">
    <h1>todo</h1>
    <h3 v-if="erroreImmissione" class="errore">INSERISCI DATI CORRETTI</h3>
    <form @submit.prevent="onSubmit">
      <input type="text" name="name" id="name" v-model="newTodo.to">
      <input type="submit" value="crea todo">
    </form>
    <ul>
      <li v-for="(todo, index) in todoList" :key="index">
        <span :class="{ 'barrato': !todo.barrato, 'fatto': !todo.do }" @click="onBarrato(index)">{{ todo.to }}</span>
        <button type="button" :class="{'fatto': !todo.do, 'fare': todo.do}" @click="onCheck(index)">&#10004;</button>
        <button type="button" class="delete" @click="onDelete(index)">X</button>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      erroreImmissione: false,
      todoList: [],
      newTodo: {
        id: "",
        to: "",
        do: false,
        barrato: false
      }
    };
  },
  methods: {
    onSubmit() {
      const url = 'http://localhost:8888/giorno58/php-todo-list-json/back-end/postTodo.php';
      const data = this.newTodo;
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };
      
      // Controllo se il dato non è vuoto
      if (data.to.replace(/ /g, "").length === 0) {
        this.erroreImmissione = true;
        return;
      }
      this.erroreImmissione = false;

      // Invio richiesta post
      axios.post(url, data, headers)
        .then(response => {
          this.todoList = response.data;
          this.newTodo.to = "";
          this.newTodo.id = "";
        })
        .catch(error => console.error("error", error));
    },

    onBarrato(index) {
      // Recupera l'oggetto corrispondente dall'array todoList
      const selectedTodo = this.todoList[index];
      const data = { "index": index };

      const url = 'http://localhost:8888/giorno58/php-todo-list-json/back-end/barratoTodo.php';
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      // Invia una richiesta POST a barratoTodo.php per aggiornare data.json
      axios.post(url, data, headers)
        .then(response => {
          // Aggiorna la todoList con la risposta del server
          this.todoList = response.data;
        })
        .catch(error => {
          console.error("Errore durante la richiesta POST", error);
        });
    },

    onDelete(index) {
      // Recupera l'oggetto corrispondente dall'array todoList
      const deletedTodo = this.todoList[index];
      const data = { "index": index };

      const url = 'http://localhost:8888/giorno58/php-todo-list-json/back-end/deleteTodo.php';
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      // Invia una richiesta POST a barratoTodo.php per aggiornare data.json
      axios.post(url, data, headers)
        .then(response => {
          // Aggiorna la todoList con la risposta del server
          this.todoList = response.data;
        })
        .catch(error => {
          console.error("Errore durante la richiesta POST", error);
        });
    },

    onCheck(index) {
      // Recupera l'indice corrispondente dall'array todoList
      const data = { "index": index };

      const url = 'http://localhost:8888/giorno58/php-todo-list-json/back-end/checkTodo.php';
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      // Invia una richiesta POST a barratoTodo.php per aggiornare data.json
      axios.post(url, data, headers)
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

<style lang="scss">
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.barrato {
  text-decoration: line-through;
}

ul {
  margin-top: 20px;
  
  li {
    cursor: pointer;
    text-align: right;
    width: 80%;
    margin-bottom: 10px;

    span {
      display: inline-block;
      width: calc(100% - 50px);
      padding-right: 10px;
      &:hover{
        background-color: lightgray;
      }
      
      &.fatto {
        background-color: lightgreen;
      }
    }
    
    button {
      padding: 2px 0;
      width: 20px;
      border-radius: 0;
      margin-right: 5px;
      
      &:focus {
        outline: none;
      }
      
      &.delete {
        color: red;
        border: 1px solid red;
        
        &:hover {
          background-color: rgba(255, 0, 0, 0.3);
          border: 1px solid red;
        }
      }
      
      &.fare {
        color: lightgray;
        border: 1px solid lightgray;
        
        &:hover {
          color: gray;
          border: 1px solid gray;
        }
      }
      
      &.fatto {
        color: lightgreen;
        border: 1px solid lightgreen;
        
        &:hover {
          color: green;
          border: 1px solid green;
        }
      }
    }
  }
}

.errore {
  color: red;
}
</style>
