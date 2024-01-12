<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\AvatarController;
use OpenAI\Laravel\Facades\OpenAI;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return view('welcome');

    // fetch all users
    // $fetch = DB::select('select * from users');

    // create new users
    // $user = DB::insert('insert into users (name,email,password) values (?,?,?)',[
    //     "Jake", 
    //     'jake@gmail.com', 
    //     "abcdefgh",
    // ]);

    // Update user
    // $user = DB::update('update users set name = "Vitoka K Swu" where id = 1');
    // $user = DB::update('update users set name = ? where id = ?',[
    // 'Vitoka K Swu',
    // 3,
    //);

    // Delete User
    // $user = DB::delete('delete from users where id = 2');

    // get all users
    // $users = DB::table('users')->find(1);

    // $user = DB::table('users')->insert([
    //     'name' => "John",
    //     'email' => "john@gmail.com",
    //     'password' => "password"
    // ]);

    // Upating a user
    // $user = DB::table('users')->where('email', 'john@gmail.com')->update([
    //     'email' => "abcd@gmail.com",
    // ]);

    // Deleting a user
    // $user = DB::table('users')->where('email', 'abcd@gmail.com')->delete();

    // Eloquent ORM
    // $user = User::find(10);

    // Create User
    // $user = User::create([
    //     'name' => "John",
    //      'email' => "john2@gmail.com",
    //      'password' => bcrypt("password"),
    // ]);

    // Update User
    // $user = User::where('name','John')->update([
    //     'name' => "Jean",
    // ]);

    // Delete User
    // $user = User::where('name', 'Jean')->delete();

    // dd($user->name);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar',[AvatarController::class, 'update'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/openai', function(){

$result = OpenAI::chat()->create([
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        ['role' => 'user', 'content' => 'Hello!'],
    ],
]);

echo $result->choices[0]->message->content; // Hello! How can I assist you today?
});