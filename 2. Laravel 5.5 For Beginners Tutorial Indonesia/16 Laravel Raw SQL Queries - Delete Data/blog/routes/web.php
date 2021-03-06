<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/about');
});

Route::get('/about', function() {
    return 'Hi, This about page';
});

Route::get('/blog', 'PostController@index');
Route::resource('post', 'PostController');

Route::get('/insert', function(){
    $data = [
        'title' => 'Disini isian title',
        'body' => 'Isian Body untuk table posts',
        'user_id' => 2
    ];
    DB::table('posts')->insert($data);
    
    echo "Data berhasil ditambah";
});

Route::get('/read', function(){
    $query = DB::table('posts')->select('title', 'body')->where('id', 1)->get();

    return var_dump($query);
});

Route::get('/update', function(){
    $data = [
        'title' => 'Isian Title',
        'body' => 'Isian Body baru'
    ];
    $updated = DB::table('posts')->where('id', 1)->update($data);
    
    return $updated;
});

Route::get('/delete', function(){
    // Cara ke 1
    $delete = DB::delete('delete from posts where id = ?', [1]);

    // Cara ke 2
    $delete = DB::table('posts')->where('id', 2)->delete();

    return $delete;
});