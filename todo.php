<!DOCTYPE html>
<html>
<head>
	<title>Todo List</title>
	<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
</head>
<style type="text/css">
	.preview {
		padding: 5px;
	    border: 1px solid #8BC34A;
	    width: 200px;
	    background: #CDDC39;
	    font-family: arial;
	}

	li { 
		padding:5px 0px 5px 0px; 
		font-family: Arial; font-size:16px; 
	}
</style>
<body>

	<!-- ALL Vuejs directive works only inside this container as the el: '#app'  -->
	<div id="app">
		<h2>Simple Todo List</h2>
		<!-- Insert new task -->
		<input type="text" v-model="task" v-on:keyup.enter="add()">
		<button @click="add()">Add</button>

		<p v-if="task" class="preview">{{ task }}</p>

		<!-- List the todo -->
		<ul>
		    <li v-for="(todo, index)  in todos">
		      {{ todo.text }}
		      <button @click="remove(todo)">delete</button>
		    </li>
		</ul>
	</div>
</body>

<script type="text/javascript">
	
	var app = new Vue({

	  el: '#app',

	  data: {
	  	task: '',
	    todos: []
	  },
	  mounted () {
	  	axios
  	      .get('http://localhost:8888/vue-todo/process.php')
  	      .then(response => (this.todos = response.data));

	  },
	  methods: {

	  	add: function() {
	  		if (this.task != '') {
	  			// insert new task into todos array MySQL
	 
	  			var bodyFormData = new FormData();
	  			bodyFormData.set('text', this.task);

	  			// Axios is a ajax library to send POST and GET request via Javascript
		  	    axios({
		  	      method: 'post',
		  	      url: 'http://localhost:8888/vue-todo/process.php',
		  	      config: { headers: {'Content-Type': 'multipart/form-data' }},
		  	      data: bodyFormData,

		  	    }).then(function(response) {
		  	    	console.log(response);
		  	    });

	  			// For browser side changes
	  			this.todos.unshift({text: this.task});
	  			this.task = '';


	  		}
	  		
	  	},

	  	remove: function(todo) {

		  	axios
	  	      .get('http://localhost:8888/vue-todo/process.php?delete_id='+ todo.id)
	  	      .then(response => {
	  	     	
	  	     	// Delete the selected task using splice method from todos array
	  	      	this.todos.splice(this.todos.indexOf(todo), 1);

	  	      });
	  		
	  	}

	  }

	});
</script>
</html>