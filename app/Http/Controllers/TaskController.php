<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\Post;

class TaskController extends Controller
{
	/**
	 * Изменение записи таблицы в базе
	 *
	 * @param  Request  $request
	 * 
	 */
	public function update(Request $request)
	{
		// получаем все статьи из базы
		$posts = Post::orderBy('id')->get();
			
		$records = count($posts);

		if($records === 0)
		{
			// если список пуст - переход на страницу отображения ошибок
			return view('tasks.notice', 
			['notice' => 'База не содержит информации<br>Добавьте статью']);
		}
		else
		{
			// валидация полей запроса
			$this->validate($request,[
				'id' => 'integer',
				'name' => 'required|max:255',
				'header' => 'required|max:255',
				'article' => 'required',
				'picture' => 'max:255',		
			]);

			// проверяем существование в базе указанного id
			$this->validate($request,[
				'id' => 'exists:posts,id'
			]);

			$id = $request->input('id');	

			$post = [];
			$post['name'] 		= $request->input('name');
			$post['header'] 	= $request->input('header');
			$post['article'] 	= $request->input('article');
			$post['picture'] 	= $request->input('picture');
			
			// Вносим изменения в запись $id в таблице
			Post::where('id', $id)->update($post);
		}
	}

	/**
	 * Удаление записи из таблицы
	 *
	 * @param  Request  $request
	 * @return view
	 */
	public function delete(Request $request)
	{
		// получаем все статьи из базы
		$posts = Post::orderBy('id')->get();
		
		$records = count($posts);
		if($records === 0)
		{
			// если список пуст - переход на страницу отображения ошибок
			return view('tasks.notice', 
			['notice' => 'База не содержит информации<br>Добавьте статью']);
		}
		else
		{
			$id = $request->input('id');

			$id = (int)$id;

			if($id >= 0)
			{
				// Удаляем запись $id в таблице
				Post::where('id', '=', $id)->delete();
				
				// если записей в базе до удаления было больше одной, тогда
				if($records > 1)
				{
					// получаем все статьи из базы
					$posts = Post::orderBy('id')->get();
					
					// преобразовываем содержимое базы в json
					$post = json_encode($posts, true);
					
					// передаем в наше представление (ajax на клиенте получит)
					echo $post;
				}
			}			
		}
	}

	/**
	 * Изменение статей
	 *
	 * @param  Request  $request
	 * @return view
	 */
	public function edit(Request $request, $id = 0)
	{
		// получаем все статьи из базы
		$posts = Post::orderBy('id')->get();
		
		//dd($posts);

		$records = count($posts);
		if($records === 0)
		{
			// если список пуст - переход на страницу отображения ошибок
			return view('tasks.notice', 
			['notice' => 'База не содержит информации<br>Добавьте статью']);
		}
		else
		{
			// проверяем полученный индекс и приводим к 0, если не валидный
			$id = (int)$id;
			$id = ($id < 0) ? 0 : $id;
			
			// проверяем количество записей в таблице И в запросе, исключаем превышение в запросе
			$index = ($records > $id) ? $id : 0;
			
			// передаем данные в представление
			return view('tasks.edit', ['posts' => $posts, 'index' => $index]);
		}
	}

	/**
	 * Изменение статей
	 *
	 * @param  Request  $request
	 * @return view
	 */
	public function show(Request $request, $id = 0)
	{
		// получаем все статьи из базы
		$posts = Post::orderBy('id')->get();
		
		//dd($posts);

		$records = count($posts);
		if($records === 0)
		{
			// если список пуст - переход на страницу отображения ошибок
			return view('tasks.notice', 
			['notice' => 'База не содержит информации<br>Добавьте статью']);
		}
		else
		{
			// проверяем полученный индекс и приводим к 0, если не валидный
			$id = (int)$id;
			$id = ($id < 0) ? 0 : $id;
			
			// проверяем количество записей в таблице И в запросе, исключаем превышение в запросе
			$index = ($records > $id) ? $id : 0;
			
			// передаем данные в представление
			return view('tasks.show', ['posts' => $posts, 'index' => $index]);
		}
	}
	
	/**
	 * Отображение списка статей
	 *
	 * @param  Request  $request
	 * @return view
	 */
	public function showlist(Request $request)
	{	
		// получаем все статьи из базы
		$posts = Post::orderBy('id')->get();
		
		$records = count($posts);
		if($records === 0)
		{
			// если список пуст - переход на страницу отображения ошибок
			return view('tasks.notice', 
			['notice' => 'База не содержит информации<br>Добавьте статью']);
		}
		else
		{
			// передаем их в наше представление
			return view('tasks.showlist', ['posts' => $posts, 'index' => 0]);
		}
	}

	/**
	 * Вставка статьи в таблицу
	 *
	 * @param  Request  $request
	 * @return redirect('/showlist');
	 */
	public function insert(Request $request)
	{
		// получаем все статьи из базы
		$posts = Post::orderBy('id')->get();

		$post = [];
		
		// если список пуст - устанавливаем id в 1, 
		$records = count($posts);
		if($records === 0)
		{
			$post['id'] = 1;
		}
		else
		{
			// находим свободный или следующий в списке id
			$post['id'] = $records + 1;
			
			$pst = json_decode($posts, true);
						
			for($i = 0; $i < $records; $i++)
			{
				if(($i + 1) != $pst[$i]['id'])
				{
					$post['id'] = $i+1;
					break;
				}
			}
		}

		// валидация полей запроса
		$this->validate($request,[			
			'name' => 'required|max:255',
			'header' => 'required|max:255',
			'article' => 'required',
			'picture' => 'max:255',
		]);

		$post['name'] 		= $request->input('name');
		$post['header'] 	= $request->input('header');
		$post['article'] 	= $request->input('article');
		$post['picture'] 	= $request->input('picture');		

		// вставка записи в БД
		Post::insert($post);
		
		// переход на показ списка
		return redirect('/showlist');

	}

	/**
	 * Отображение формы "Добавить статью"
	 *
	 * @param  Request  $request
	 * @return view
	 */
	public function addpost(Request $request)
	{		
		// получаем все статьи из базы
		$posts = Post::orderBy('id')->get();
		
		// передаем их в наше представление
		return view('tasks.addpost', ['posts' => $posts]);
	}
}