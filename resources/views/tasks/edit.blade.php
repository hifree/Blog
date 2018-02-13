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

			.btn2 {
				width: 100%;
				border-radius: 0px;
				border: 1px solid #bbb;
			}

		</style>

		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<div id="app">
			@include('common.errors')
			
			<div class="well">
			  <form enctype="multipart/form-data" id="recform">
			  {{ csrf_field() }}

				<label v-html="indexStr" id="lab"></label>
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
					<label>Изменить картинку в статье</label>				
					<input type="file" name="picture" id="picture">
				</div>

				<div class="row">
					<div class="col-md-6">
						<button type="submit" class="btn btn-primary" v-on:click.prevent="save">Сохранить</button>
					</div>
					<div class="col-md-6">
						<button type="submit" class="btn btn-primary" v-on:click.prevent="del">Удалить</button>
					</div>
				</div>

			  </form>

				<div class="row">
					<div class="col-md-6">
						<button class="btn btn-default" v-on:click="dec"><<</button>
					</div>
					<div class="col-md-6">
						<button class="btn btn-default" v-on:click="inc">>></button>
					</div>
				</div>
			</div>
		</div>

		<script>
			var post = <?php echo $posts; ?>;		
			var index = <?php echo $index; ?>;
			var formheader = "Правка, статья #";
			var indexStr = formheader + post[index].id;

			new Vue ({
				el: "#app",
				data:{
					blogpost:{
						id: 		post[index].id,
						name: 		post[index].name,
						header: 	post[index].header,
						article: 	post[index].article,
						picture: 	post[index].picture,
					},					
				},
				methods:{
					save: function(e)
					{
						if(!this.isChanged(this.blogpost))
						{
							alert('нет изменений для сохранения');
						}
						else
						{
							this.updatePost(this.blogpost);

							$.ajax({
								type: 'get',
								url: '/update',
								data: post[index],
								success:function(data){ 
									console.log("Успешная операция");
								},
								error: function(data){ 
									console.log("Ошибка передачи: " + data.error);
								}
							});							
						}
					},
					del: function()
					{
						var v = this;
						if(confirm('Подтвердите удаление записи?'))
						{
							$.ajax({
								type: 'get',
								url: '/delete',
								data: {"id": post[index].id},
								success:function(data)
								{
									if(data.length == 0)
									{
										window.location.href="/showlist";
									}
									console.log("Успешная операция");
									// метод '/delete' возвращает список уже без удаленной записи - заносим его в массив
									post = JSON.parse(data);
									v.updateFormFields(v.blogpost);
								},
								error: function(data){
									console.log("Ошибка передачи: " + data.error);
								}
							});
						}
					},
					// Переход к следующей записи
					inc: function()
					{
						index++;
						this.updateFormFields(this.blogpost);
					},
					// Переход к предыдующей записи
					dec: function()
					{
						index--;
						this.updateFormFields(this.blogpost);
					},
					// Обновляем основной массив post
					updatePost: function(obj)
					{
						for (var key in obj)
						{
							post[index][key] = obj[key];
						}
					},
					updateFormFields: function(obj)
					{
						// проверка превышения указателем index размера post
						index = (index > (post.length-1)) ? 0 : index;
						index = (index < 0) ? (post.length-1) : index;
						
						indexStr = formheader + post[index].id;

						for (var key in obj)
						{
							obj[key] = post[index][key];
						}
					},
					isChanged: function(obj)
					{
						// проверяем все поля на наличие изменений
						var chg = false;
						for (var key in obj)
						{
							if(obj[key] != post[index][key])
							{
								chg = true; // если хоть одно поле изменено
								break;
							}
						}
						return chg;
					},
				}
			});

		</script>

@endsection