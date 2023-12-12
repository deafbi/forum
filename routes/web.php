<?php

use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ExtraController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\VouchController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UpgradeController;
use App\Http\Controllers\ReputationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AwardsController;
use App\Http\Controllers\Admin\TopicsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ReputationController as AdminReputationController;
use App\Http\Controllers\Admin\VouchController as AdminVouchController;
use App\Http\Controllers\Admin\PostController as AdminPostsController;
use App\Http\Controllers\Admin\ReportController as AdminReportsController;
use App\Http\Controllers\Admin\GroupController as AdminGroupsController;
use App\Http\Controllers\Admin\TagController as AdminTagsController;
use App\Http\Controllers\Admin\RoleController as AdminRolesController;
use App\Http\Controllers\Admin\PermissionController as AdminPermissionsController;

use App\Http\Livewire\Messages;

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

Route::get('/', [ForumController::class, 'index'])->name('home');

// Extra
Route::prefix('extra')->name('extra.')->group(function () {
    Route::get('members', [ExtraController::class, 'members'])->name('members');
    Route::get('awards', [ExtraController::class, 'awards'])->name('awards');
    Route::get('groups', [ExtraController::class, 'groups'])->name('groups');
    Route::get('leaderboard', [ExtraController::class, 'leaderboard'])->name('leaderboard');
});

Route::get('/upgrade', [UpgradeController::class, 'index'])->name('upgrade.index');
Route::get('/latest', [ForumController::class, 'latestPosts'])->name('home.latest');
Route::get('/search', [ForumController::class, 'search'])->name('home.search');

Route::get('/latests-topics', [ForumController::class, 'latestTopics'])->name('latest-topics.index');
Route::get('/rep-logs', [ReputationController::class, 'index'])->name('rep-logs.index');
Route::get('/vouch-logs', [VouchController::class, 'index'])->name('vouch-logs.index');

// User
Route::get('/profiles/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profiles/{user}/scan', [ProfileController::class, 'scan'])->name('users.scan');

Route::middleware('auth')->group(function () {
    Route::get('/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/settings', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::put('/avatar-bg', [ProfileController::class, 'updateAvatarBackground'])->name('profile.avatarbg.update');
    Route::put('/cover', [ProfileController::class, 'updateCover'])->name('profile.cover.update');
    Route::put('/profile/signature', [ProfileController::class, 'updateSignature'])->name('profile.signature.update');
    Route::put('/profile/min', [ProfileController::class, 'min'])->name('profile.min.update');
    Route::get('/settings/account', [ProfileController::class, 'account'])->name('profile.account');
    Route::get('/settings/security', [ProfileController::class, 'security'])->name('profile.security');
    Route::get('/settings/notifications', [ProfileController::class, 'notifications'])->name('profile.notifications');
    Route::get('/settings/privacy', [ProfileController::class, 'privacy'])->name('profile.privacy');
    Route::put('avatar-delete', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
    Route::put('cover-delete', [ProfileController::class, 'deleteCover'])->name('profile.cover.delete');
});

// Posts
Route::post('topics/{topic:slug}/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('topics/{topic:slug}/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::patch('posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Vouch
Route::get('/users/{user}/vouch', [VouchController::class, 'show'])->name('users.vouch.show');
Route::get('/users/{user}/vouch/given', [VouchController::class, 'given'])->name('users.vouch.given');
Route::get('/users/{user}/vouch/give', [VouchController::class, 'give'])->name('users.vouch.give');
Route::post('/users/{user}/vouch', [VouchController::class, 'store'])->name('users.vouch.store');

Route::post('/posts/{post}/like', [LikeController::class, 'store'])->middleware(['auth'])->name('posts.like.store');
Route::delete('/posts/{post}/like', [LikeController::class, 'destroy'])->middleware(['auth'])->name('posts.like.destroy');


Route::get('/users/{user}/reputation', [ReputationController::class, 'show'])->name('users.reputation.show');
Route::get('/users/{user}/reputation/given', [ReputationController::class, 'given'])->name('users.reputation.given');
Route::get('/users/{user}/reputation/give', [ReputationController::class, 'give'])->name('users.reputation.give');
Route::post('/users/{user}/reputation', [ReputationController::class, 'store'])->name('users.reputation.store');

Route::get('users/{user}/report', [ReportController::class, 'create'])->middleware('auth')->name('report.create');
Route::post('/report', [ReportController::class, 'store'])->middleware('auth')->name('report.store');

/**
 * Admin
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['checkAdminRole']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('users', UsersController::class);
    Route::resource('topics', TopicsController::class);
    Route::resource('awards', AwardsController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('reports', AdminReportsController::class);
    Route::resource('reputations', AdminReputationController::class);
    Route::resource('vouches', AdminVouchController::class);
    Route::resource('posts', AdminPostsController::class);
    Route::resource('groups', AdminGroupsController::class);
    Route::resource('roles', AdminRolesController::class);
    Route::resource('permissions', AdminPermissionsController::class);
    Route::resource('tags', AdminTagsController::class);
});

require __DIR__ . '/auth.php';

// Topics
Route::prefix('{category:slug}')->group(function () {
    Route::get('/', [TopicController::class, 'index'])->name('topics.index');
    Route::get('create', [TopicController::class, 'create'])->name('topics.create');
    Route::post('/', [TopicController::class, 'store'])->middleware('rate_limit_create_topic')->name('topics.store');

    Route::get('{subcategory}/topics', [TopicController::class, 'subcategoryIndex'])->name('subcategory.topics.index');
    Route::get('{subcategory}/topics/create', [TopicController::class, 'createSubcategory'])->name('subcategory.topics.create');
    Route::post('{subcategory}/store', [TopicController::class, 'storeSubcategory'])->middleware('rate_limit_create_topic')->name('subcategory.topics.store');

    Route::get('{subcategory}/{topic:slug}', [TopicController::class, 'show'])->name('subcategory.topics.show')->middleware(['auth', 'check_hidden_topic', 'checklogin']);

    Route::prefix('{topic:slug}')->group(function () {
        Route::get('/', [TopicController::class, 'show'])->name('topics.show')->middleware(['auth', 'check_hidden_topic', 'checklogin']);
        Route::get('edit', [TopicController::class, 'edit'])->name('topics.edit');
        Route::patch('update', [TopicController::class, 'update'])->name('topics.update');
        Route::delete('delete', [TopicController::class, 'destroy'])->name('topics.destroy');
    });
});
