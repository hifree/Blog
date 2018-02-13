@extends('app')

@section('content')

		<style>

			.well {
				margin: 0px auto;
				max-width: 500px;
				background-color: #fafafa;
				border: 1px solid #bbb;
			}

			.form-control {				
				border: 1px solid #bbb;
			}
			textarea {
				min-height:110px;
			}
			.noresize {
				resize: none; 
			}
			.vresize {
				resize: vertical; 
			}
			.hresize {
				resize: horizontal;  
			}

			.btn {
				width: 100%;				
				border-radius: 5px;
				border: 1px solid #bbb;
			}

		</style>

		<div id="app">
			@include('common.errors')

			<div class="well">

			  <form enctype="multipart/form-data" id="regform">
			  {{ csrf_field() }}

				<label>Добавить статью:</label>
				<div class="form-group">
					<input type="text" class="form-control" id="name" placeholder="Имя" autocomplete="off" maxlength="255" v-model="blogpost.name">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" id="header" placeholder="Заголовок" autocomplete="off" maxlength="255" v-model="blogpost.header">
				</div>
				<div class="form-group">
					<textarea class="form-control vresize" id="article" placeholder="Текст статьи" autocomplete="off" v-model="blogpost.article" rows="10"></textarea>
				</div>
				
				<div class="form-group">
					<label>Добавить картинку в статью</label>				
					<input type="file" name="picture" id="picture">
				</div>

				<button type="submit" class="btn btn-primary" v-on:click.prevent="insert">Опубликовать</button>

			  </form>

			</div>
		</div>


		<script>
			var post = <?php echo $posts; ?>;			

			new Vue ({
				el: "#app",
				data:{
					blogpost:{
						id: 		'0',
						name: 		'Имя автора',
						header: 	'Заголовок',
						article: 	'Статья',
						picture: 	'image',
					},					
				},
				methods:{
					insert: function()
					{
						obj = this.blogpost;
						console.log(obj.name);
						$.ajax({
							type: 'get',
							url: '/insert',
							data: obj,
							success:function(data){ 
								console.log("Успешная операция ");
								window.location.href="/showlist";
							},
							error: function(data){ 
								console.log("Ошибка передачи: " + data.error);
							}
						});						
					}
				}
			});

		</script>

@endsection