<?php

    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\ExecutorController;
    use App\Http\Controllers\ManagerController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\CommentController;
    use App\Http\Controllers\TaskController;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', function () {
            $userType = Auth::user()->user_type_id;
            if ($userType == 1) {
                return redirect()->route('roles.admin');
            } elseif ($userType == 2) {
                return redirect()->route('roles.manager');
            } elseif ($userType == 3) {
                return redirect()->route('roles.executor');
            }
            return redirect('/');
        })->name('dashboard');

        // Admin routes
        Route::get('/roles/admin', [AdminController::class, 'index'])
            ->name('roles.admin')
            ->middleware(function ($request, $next) {
                if (Auth::user()->user_type_id != 1) {
                    return redirect('/');
                }
                return $next($request);
            });

        // Moderator routes
        Route::get('/roles/manager', [ManagerController::class, 'index'])
            ->name('roles.manager')
            ->middleware(function ($request, $next) {
                if (Auth::user()->user_type_id != 2) {
                    return redirect('/');
                }
                return $next($request);
            });

        // User routes
        Route::get('/roles/executor', [ExecutorController::class, 'index'])
            ->name('roles.executor')
            ->middleware(function ($request, $next) {
                if (Auth::user()->user_type_id != 3) {
                    return redirect('/');
                }
                return $next($request);
            });
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__ . '/auth.php';

    Route::get('/download/{file}', [TaskController::class, 'download'])->name('file.download');


// executor ------------------------------------------------------------------------------------------------------------
    Route::middleware('auth')->group(function () {
        Route::get('/executor-tasks/', 'App\Http\Controllers\ExecutorController@indexSortExec')->name('tasks.index');

        //Route::middleware('auth')->get('/executor-tasks', 'App\Http\Controllers\ExecutorController@returnTaskEx')->name('executor-tasks');
        Route::post('/executor-comment/{task}', [ExecutorController::class, 'addComment'])->name('add-comment');
        Route::delete('/executor-comment/{comment}', 'App\Http\Controllers\ManagerController@deleteComment')->name('delete_comment_exec');
        Route::post('/executor-complete/{task}', 'App\Http\Controllers\ExecutorController@completeTask')->name('executor-complete');
        Route::get('/task-detail/{id}', 'App\Http\Controllers\ExecutorController@show')->name('task-detail');

        Route::delete('/comments/{comment}', 'App\Http\Controllers\ExecutorController@deleteComment')->name('comments.delete');
        Route::post('/comments', 'App\Http\Controllers\ExecutorController@addComment')->name('comments.add');

        Route::get('/filter', 'App\Http\Controllers\ExecutorController@returnTaskExFilter')->name('filter');
        Route::post('/filter-deadline', 'App\Http\Controllers\ExecutorController@filterByDeadlineExec')->name('filterByDeadlineExec');
        Route::post('/filter-executor', 'App\Http\Controllers\ExecutorController@filterByExecExec')->name('filterByExecExec');
        Route::post('/filter-manager', 'App\Http\Controllers\ExecutorController@filterByManagerExec')->name('filterByManagerExec');
    });

// manager -------------------------------------------------------------------------------------------------------------
    Route::middleware('auth')->group(function () {
        Route::get('/task_list_mng', 'App\Http\Controllers\ManagerController@indexSortMng')->name('task_list_mng');
        Route::get('/task_details_mng/{id}', 'App\Http\Controllers\ManagerController@show')->name('task_details_mng');

        Route::get('/create_task_group_mng', 'App\Http\Controllers\ManagerController@returnCreateTaskGroup')->name('create_task_group_mng');
        Route::post('/create_task_group_mng', 'App\Http\Controllers\ManagerController@createTaskGroup');

        Route::get('/update_task_group_mng', 'App\Http\Controllers\ManagerController@returnUpdateTaskGroup')->name('update_task_group_mng');
        Route::post('/update_task_group_mng', 'App\Http\Controllers\ManagerController@updateTaskGroup');

        Route::get('/delete_task_group_mng', 'App\Http\Controllers\ManagerController@returnDeleteTaskGroup')->name('delete_task_group_mng');
        Route::post('/delete_task_group_mng', 'App\Http\Controllers\ManagerController@deleteTaskGroup');

        Route::get('/list_task_group_mng', 'App\Http\Controllers\ManagerController@returnTaskGroup')->name('list_task_group_mng');

        Route::get('/create_task_mng', 'App\Http\Controllers\ManagerController@returnNewTaskAdmin')->name('create_task_mng');
        Route::post('/create_task_mng', 'App\Http\Controllers\ManagerController@createNewTaskAdmin');

        Route::get('/pre_update_task_mng', 'App\Http\Controllers\ManagerController@chooseUpdateTask')->name('pre_update_task_mng');
        Route::post('/pre_update_task_mng', 'App\Http\Controllers\ManagerController@forwardUpdateTask');

        Route::get('/update_task_mng', 'App\Http\Controllers\ManagerController@returnUpdateTask')->name('update_task_mng');
        Route::post('/update_task_mng', 'App\Http\Controllers\ManagerController@updateTask')->name('update_task_action_mng');

        Route::get('/delete_task_mng', 'App\Http\Controllers\ManagerController@returnDeleteTask')->name('delete_task_mng');
        Route::post('/delete_task_mng', 'App\Http\Controllers\ManagerController@deleteTask');

        Route::post('/complete-manager_mng/{task}', 'App\Http\Controllers\ManagerController@completeTask')->name('complete_manager_mng');
        Route::post('/cancel-manager_mng/{task}', 'App\Http\Controllers\ManagerController@cancelTask')->name('cancel_manager_mng');

        Route::get('/filterMng', 'ManagerController@filter')->name('tasks_filter_mng');
        Route::get('/filterMng', 'App\Http\Controllers\ManagerController@returnTaskMngFilter')->name('filter_mng');
        Route::post('/filter-deadlineMng', 'App\Http\Controllers\ManagerController@filterByDeadlineMng')->name('filterByDeadlineMng');
        Route::post('/filter-executorMng', 'App\Http\Controllers\ManagerController@filterByExecMng')->name('filterByExecMng');
        Route::post('/filter-priorityMng', 'App\Http\Controllers\ManagerController@filterByPriorityMng')->name('filterByPriorityMng');
        Route::post('/filter-titleMng', 'App\Http\Controllers\ManagerController@filterByTitleMng')->name('filterByTitleMng');

        Route::post('/manager-comment', 'App\Http\Controllers\ManagerController@addComment')->name('comments.add.mng');
        Route::delete('/manager-comment/{comment}', 'App\Http\Controllers\ManagerController@deleteComment')->name('comments.delete.mng');
    });

// admin ---------------------------------------------------------------------------------------------------------------
    Route::middleware('auth')->group(function () {
        Route::get('/create_task_group', 'App\Http\Controllers\AdminController@returnNewTaskGroupAdmin')->name('create_task_group_admin');
        Route::post('/create_task_group', 'App\Http\Controllers\AdminController@createTaskGroupAdmin');

        Route::get('/update_task_group', 'App\Http\Controllers\AdminController@returnUpdateTaskGroupAdmin')->name('update_task_group_admin');
        Route::post('/update_task_group', 'App\Http\Controllers\AdminController@updateTaskGroupAdmin');

        Route::get('all_task_group', 'App\Http\Controllers\AdminController@allGroup')->name('all_task_group_admin');


        Route::get('/create_task', 'App\Http\Controllers\AdminController@returnNewTaskAdmin')->name('create_task_admin');
        Route::post('/create_task', 'App\Http\Controllers\AdminController@createNewTaskAdmin');

        Route::get('/pre_update_task', 'App\Http\Controllers\AdminController@chooseUpdateTask')->name('pre_update_task_admin');
        Route::post('/pre_update_task', 'App\Http\Controllers\AdminController@forwardUpdateTask');

        Route::get('/update_task', 'App\Http\Controllers\AdminController@returnUpdateTaskAdmin')->name('update_task_admin');
        Route::post('/update_task', 'App\Http\Controllers\AdminController@updateTaskAdmin');

        Route::get('/all_tasks', 'App\Http\Controllers\AdminController@indexSortAdmin')->name('all_tasks_admin');
        Route::get('/task_details_admin/{id}', 'App\Http\Controllers\AdminController@show')->name('task_details_admin');


        Route::get('/create_user', 'App\Http\Controllers\AdminController@showCreateUserAdmin')->name('create_user_admin');
        Route::post('/create_user', 'App\Http\Controllers\AdminController@createUserAdmin');

        Route::get('/update_user', 'App\Http\Controllers\AdminController@showUpdateAdmin')->name('update_user_admin');
        Route::post('/update_user', 'App\Http\Controllers\AdminController@updateUserAdmin');

        Route::get('/pre_update_user', 'App\Http\Controllers\AdminController@chooseUserForUpdate')->name('pre_update_user_admin');
        Route::post('/pre_update_user', 'App\Http\Controllers\AdminController@forwardUserForUpdate');

        Route::get('/all_users', 'App\Http\Controllers\AdminController@allUsers')->name('all_users_admin');


        Route::get('/create_user_type', 'App\Http\Controllers\AdminController@returnNewUserTypeAdmin')->name('create_user_type_admin');
        Route::post('/create_user_type', 'App\Http\Controllers\AdminController@createNewUserTypeAdmin');

        Route::get('/update_user_type', 'App\Http\Controllers\AdminController@returnUpdateUserTypeAdmin')->name('update_user_type_admin');
        Route::post('/update_user_type', 'App\Http\Controllers\AdminController@updateUserTypeAdmin');

        Route::get('all_user_types', 'App\Http\Controllers\AdminController@allUserTypes')->name('all_user_types_admin');


        Route::get('/create_comment', 'App\Http\Controllers\AdminController@returnNewCommentAdmin')->name('create_comment_admin');
        Route::post('/create_comment', 'App\Http\Controllers\AdminController@createNewCommentAdmin');

        Route::get('/update_comment', 'App\Http\Controllers\AdminController@returnUpdateCommentAdmin')->name('update_comment_admin');
        Route::post('/update_comment', 'App\Http\Controllers\AdminController@updateCommentAdmin');

        Route::get('/all_comments', 'App\Http\Controllers\AdminController@allComments')->name('all_comments_admin');

        Route::post('/admin-comment/', 'App\Http\Controllers\AdminController@addComment')->name('comments.add.admin');
        Route::delete('/admin-comment/{comment}', 'App\Http\Controllers\AdminController@deleteComment')->name('comments.delete.admin');

        Route::post('/complete_admin/{task}', 'App\Http\Controllers\AdminController@completeTask')->name('complete_admin');
        Route::post('/cancel_admin/{task}', 'App\Http\Controllers\AdminController@cancelTask')->name('cancel_admin');
    });
