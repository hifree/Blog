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
			
			<div class="container-fluid">
				<div class="row">

					<div class="col-md-8 col-md-push-0">
						<h1 v-html="blogpost.name"></h1>
					</div>
					<div class="col-md-8 col-md-pull+1">
						<h3 v-html="blogpost.header"></h3><p v-html="blogpost.article"></p>
					</div>			
			
				</div>
			</div>

			<div class="col-md-1">
				<button class="btn btn-default" v-on:click="dec"><<</button>
			</div>
			<div class="col-md-1">
				<button class="btn btn-default" v-on:click="inc">>></button>
			</div>				
			
		</div>

		<script>
			var post = <?php echo $posts; ?>;		
			var index = <?php echo $index; ?>;

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
					updateFormFields: function(obj)
					{
						// проверка превышения указателем index размера списка post
						index = (index > (post.length-1)) ? 0 : index;
						index = (index < 0) ? (post.length-1) : index;
						
						for (var key in obj)
						{
							obj[key] = post[index][key];
						}
					},
				},
			});

		</script>

@endsection