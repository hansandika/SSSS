<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;

if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::get("/", HomeController::class)->name("home");
Route::get("/about", AboutController::class)->name("about");
Route::get("/faq", FAQController::class)->name("faq");

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
Route::get('/settings', [UserController::class, 'settings'])->name('settings');
Route::patch('/settings', [UserController::class, 'update'])->name('settings.update');

Route::get("/login", [Auth\LoginController::class, "index"])->name("show.login");
Route::post("/login", [Auth\LoginController::class, "login"])->name("login");

Route::get("/register", [Auth\RegisterController::class, "index"])->name("show.register");
Route::post("/register", [Auth\RegisterController::class, "register"])->name("register");

Route::get("/auth/{provider}", [Auth\LoginController::class, 'providerLogin'])->name('provider.login');
Route::get("/auth/{provider}/callback", [Auth\LoginController::class, 'providerCallback'])->name('provider.callback');

Route::get("/logout", [Auth\LoginController::class, "logout"])->name("logout");

Route::get("/posts/create", [PostController::class, "create"])->name("posts.create");
Route::post("/posts", [PostController::class, "store"])->name("posts.store");
Route::get("/posts/{slug}", [PostController::class, "show"])->name("posts.show");
Route::get("/posts/{slug}/edit", [PostController::class, "edit"])->name("posts.edit");
Route::patch("/posts/{slug}", [PostController::class, "update"])->name("posts.update");
Route::delete("/posts/{slug}", [PostController::class, "destroy"])->name("posts.destroy");

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::get("/terms-and-condition", TermsAndConditionsController::class)->name("show.terms-and-conditions");

Route::get("/admin", [AdminController::class, "index"])->name("admin.index");
Route::get("/admin/posts", [AdminController::class, "posts"])->name("admin.posts");
Route::get("/admin/users", [AdminController::class, "users"])->name("admin.users");
Route::patch("/admin/users", [AdminController::class, "updateUserGlcStatus"])->name("admin.users.updateGlcStatus");
Route::get("/admin/comments", [AdminController::class, "comments"])->name("admin.comments");
Route::get("/admin/categories", [AdminController::class, "categories"])->name("admin.categories");
Route::get("/admin/categories/create", [AdminController::class, "createCategory"])->name("admin.categories.create");
Route::post("/admin/categories", [AdminController::class, "storeCategory"])->name("admin.categories.store");
