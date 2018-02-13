@extends('app')

@section('content')

		<style>
						
			#app {
				margin: 0px auto;
			}
			
			.form-control {				
				border: 1px solid #bbb;
			}
			
			.btn {
				width: 100%;				
				border-radius: 5px;
				border: 1px solid #bbb;
			}
			
			.btn2 {
				width: 100%;
				border-radius: 0px;
				border: 1px solid #bbb;
			}

		</style>
		
			
		<div id="app" class="container">
		@include('common.errors')

		  <div class="table-responsive">
		  <table class="table table-striped">
		  
			<thead>
			  <tr>
				<th v-for="column in columns">
				  <a href="#" v-html="column"></a>
				</th>
			  </tr>
			</thead>

			<tbody>
			  <tr v-for="post in posts">
				<td v-html="post.id"></td>
				<td v-html="post.name"></td>
				<td v-html="post.header"></td>
				<td v-html="post.article"></td>
				<td v-html="post.picture"></td>
				<td><a :href="url+post.index">изменить</a></td>
			  </tr>
			</tbody>

		  </table>
		  </div>
		  
		</div>


		<script>
			var post = <?php echo $posts; ?>;			
						
			new Vue ({
				el: "#app",
				data:{
					posts: post,
					url: '/edit/',
					columns: ['id', 'Имя', 'Заголовок', 'Статья (начало)', 'Фото', 'Правка'],
				},
				methods:{
					// поскольку id-номера клиентов после удаления записей могут идти не последовательно
					// делаем последовательный индекс, для получения корректных ссылок на записи в поле "изменить"
					getPrepears: function()
					{
						for(var i = 0; i < post.length; i++)
							{
								post[i].index = i;
								r = post[i].article; post[i].article = r.slice(0, 140) + ' ...';
							}
					}
				},				
				beforeMount(){
					this.getPrepears()
				}
			});
			
		</script>
		
@endsection