@extends('app')

@section('content')

		<style>
			
			.well {
				margin: 100px auto;
				max-width: 500px;
				background-color: #fafafa;
				border: 1px solid #bbb;
			}
			
			.form-control {				
				border: 1px solid #bbb;
			}
			
			.btn {
				width: 100%;	
				border-radius: 5px;
				background-color: red;
				color: white;
				border: 1px solid #bbb;
			}		
			
		</style>


		<div id="app">
			@include('common.errors')
			
			<div class="well">
				<label>ОШИБКА!</label>				
				<button class="btn"><?php echo $error; ?></button>
			</div>
		</div>
		
@endsection