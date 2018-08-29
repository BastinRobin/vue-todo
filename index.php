<!DOCTYPE html>
<html>
<head>
	<title>Todo List</title>
	<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
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
		<input type="text" v-model="task">
		<button @click="add()">Add</button>

		<p v-if="task" class="preview">{{ task }}</p>

		<!-- List the todo -->
		<ul>
		    <li v-for="(todo, index)  in todos">
		      {{ todo }}
		      <button @click="remove(index)">delete</button>
		    </li>
		</ul>
	</div>
</body>

<script type="text/javascript">
	
	var app = new Vue({

	  // el stands for the container having all vuejs directives eg: v-model, v-for
	  el: '#app',

	  // Entire data inside the app container should be declared jere
	  data: {
	  	task: '',
	    todos: []
	  },

	  // All methods and events to be added here
	  methods: {

	  	add: function() {
	  		if (this.task != '') {

	  			// insert new task into todos array
	  			this.todos.unshift(this.task);
	  			this.task = '';
	  		}
	  		
	  	},

	  	remove: function(index) {
	  		Vue.delete(this.todos, index);
	  	}

	  }

	});
</script>
</html>