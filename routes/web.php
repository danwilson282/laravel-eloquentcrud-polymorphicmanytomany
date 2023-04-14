<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Video;
use App\Models\Tag;

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
    return view('welcome');
});
Route::get('/create', function () {
    $post = Post::create(['name'=>'My first post']);
    $tag1 = Tag::find(1);
    $post->tags()->save($tag1);
    $video = Video::create(['name'=>'video.mov']);
    $tag2 = Tag::find(2);
    $video->tags()->save($tag2);

});
Route::get('/read', function () {
    $post = Post::findOrFail(2);
    foreach($post->tags as $tag){
        echo $tag;
    }
});
Route::get('/update', function () {
    $post = Post::findOrFail(2);
    $tag = Tag::find(2);
    //foreach($post->tags as $tag){
    //    return $tag->whereName('Tag 1')->update(['name'=>'updated tag']);
    //}
    //another way
    //
    //echo $tag;
    //$post->tags()->save($tag);
    //$post->tags()->attach($tag);
    $post->tags()->sync([1,2]);
});
Route::get('/delete', function () {
    $post = Post::findOrFail(2);
    $post->tags()->delete();
});
