<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Http\Controllers\Menu;
$menu = new Menu();
Route::get('/', function () {
    return view('welcome');
});

//Route::get('hello', 'Hello@index');

Route::get('/hello/{name}/{id}/{fname}', 'Hello@index');

Route::get('/','MainCtrl@index');
Route::get('/products','ProductCtrl@products');
Route::get('/products/details/{id}','ProductCtrl@product_details');
Route::get('/products/categories','ProductCtrl@product_categories');
Route::get('/products/brands','ProductCtrl@product_brands');
Route::get('/blog','BlogCtrl@blog');
Route::get('/blog/post/{id}','BlogCtrl@blog_post');
Route::get('/contact-us','MainCtrl@contact_us');
Route::get('/login','AccountCtrl@login');
Route::get('/logout','AccountCtrl@logout');
Route::get('/cart','CartCtrl@cart');
Route::get('/checkout','CartCtrl@checkout');
Route::get('/search/{query}','MainCtrl@search');
Route::get('/login_setting','AuthLoginCtrl@LoginSetting');

Route::get('/insert', function() {
    App\Category::create(array('name' => 'Music'));
    return 'category added';
});

Route::get('/read', function() {
    $category = new App\Category();
    
    $data = $category->all(array('id','name'));
    echo '<table>';
    foreach ($data as $list) {
        echo '<tr><td>'.$list->id . '</td><td> ' . $list->name . '</td></tr>
';
    }
     echo '</table>';
});

Route::get('/update', function() {
    $category = App\Category::find(4);
    $data = array();
    if($category){
      $category->name = $category->name;
      $category->save();
      $data = $category->all(array('name','id'));
    }
    
if($data){
    foreach ($data as $list) {
        echo $list->id . ' ' . $list->name . '
';
    }
}
});

Route::get('/delete', function() {
    $category = App\Category::find(5);
    $category->delete();
    
    $data = $category->all(array('name','id'));

    foreach ($data as $list) {
        echo $list->id . ' ' . $list->name . '
';
    }
});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
   Route::get('/LoginSetting', ['as' => 'LoginSetting', 'users' => 'AuthLoginCtrl@LoginSetting']);
   Route::get('/HandleLoginSetting', ['as' => 'HandleLoginSetting', 'users' => 'AuthLoginCtrl@HandleLoginSetting']);
});
