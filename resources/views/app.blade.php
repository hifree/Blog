<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.3/vue.min.js"></script>
		<script src="../../public/js/jquery.js"></script>
		<script src="../../public/js/bootstrap.min.js"></script>		
		<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">		
		<link href="../../public/css/bootstrap.min.css"
			  rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
			  crossorigin="anonymous">
		<link href="../../public/css/front.css">
        <title>SIMPLE BLOG</title>
    </head>
    <body>
	
		<nav class="navbar navbar-default">
		  <div class="container-fluid">			
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
					  data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="/">SIMPLE BLOG</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav">
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
					 aria-expanded="false">ДОСТУПНЫЕ ОПЕРАЦИИ<span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="/">ОТКРЫТЬ БЛОГ</a></li>
					<li><a href="/addpost">ДОБАВИТЬ СТАТЬЮ</a></li>
					<li><a href="/edit">ИЗМЕНИТЬ/УДАЛИТЬ СТАТЬЮ</a></li>
					<li><a href="/showlist">ПОКАЗАТЬ СПИСОК СТАТЕЙ</a></li>			
				  </ul>
				</li>
			  </ul>
			  </ul>
			</div>
		  </div>
		</nav>
					
		@yield('content')

    </body>
</html>