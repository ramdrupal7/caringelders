<?php



?>

<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body id="container">

<div class="container">
  <div class="row">
    <div class="col-md-10 offset-1"> 
<div id='myapp'>
 
  <!-- List records -->
  
    <table class="table table-striped table-hover">
    <tr>
      <th>Userid</th>
	  <th>Name</th>
    </tr>

    <tr v-for='user in users.slice(0, 10)'>
      <td>{{ user.id }}</td>
	  <td>{{ user.name }}</td>
    </tr>
  </table>
  
  <nav aria-label="...">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#"  @click.prevent="nextPage(0)" tabindex="-1">First</a>
    </li>
	
    
	<template v-if="users.length > 10">
    <li class="page-item"><a class="page-link" href="#" @click.prevent="nextPage(users[9].id)" > > </a></li>
	</template>
    <li class="page-item">
      <a class="page-link" href="#" @click.prevent="nextPage(lastPageId)">Last</a>
    </li>
  </ul>
</nav>
  
</div>
</div>

</div>
</div>


</body>

<script>
 var app = new Vue({
  el: '#myapp',
  data: {
    users: "",
    userid: 0,
	lastPageId : ""
  },
	created: function() {
			console.log('getting created');
			this.allRecords();
	},
  methods: {
	  nextPage: function(id) {
		  console.log(id);
		  this.userid = id;
		  this.recordByID();
	  },
    allRecords: function(){
		console.log('getting data');

      axios.get('ajaxfile.php')
      .then(function (response) {
         app.users = response.data.users;
		 app.lastPageId = response.data.last_page_id;
      })
      .catch(function (error) {
         console.log(error);
      });
    },
    recordByID: function(){
      
 
        axios.get('ajaxfile.php', {
           params: {
             last_id: this.userid
           }
        })
        .then(function (response) {
           app.users = response.data.users;
		   app.lastPageId = response.data.last_page_id;
        })
        .catch(function (error) {
           console.log(error);
        });
      
    }
  }
})
</script>