<?php

    namespace App\Http\Controllers;

    use App\Models\Comment;
    use App\Models\Task;
    use App\Models\TaskGroup;
    use App\Models\User;
    use App\Models\UserType;
    use Illuminate\Auth\Events\Registered;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Validation\Rules;

    class AdminController extends Controller
    {
        public function index()
        {
            if (Auth::check() && Auth::user()->user_type_id == 1) {
                return view('roles.admin');
            }
            return redirect('/');
        }

        public function show($id)
        {
            $task = Task::find($id);
            // You can return the task data to a view or as JSON
            return view('roles.admin.task_details_admin', ['task' => $task]);
        }

        public function returnNewUserTypeAdmin()
        {
            return view('roles.admin.create_user_type');
        }

        public function createNewUserTypeAdmin(Request $request)
        {
            $request->validate([
                'user_type' => ['required', 'string'],
            ]);

            UserType::create([
                'user_type' => $request->input('user_type'),
            ]);


            return redirect()->back()->with('success', 'Tip je uspešno kreiran.');
        }

        public function returnUpdateUserTypeAdmin()
        {
            $user_types = UserType::all();

            return view('roles.admin.update_user_type', compact('user_types'));
        }

        public function updateUserTypeAdmin(Request $request)
        {

            $request->validate([
                'id' => ['required', 'exists:user_types,id'],
                'user_type' => ['required', 'string'],
            ]);

            $id = $request->id;
            $name = $request->input('user_type');

            $user_type = UserType::findOrFail($id);

            $user_type->update([
                'user_type' => $name,
            ]);

            return redirect()->back()->with('success', 'Tip je uspešno izmenjen.');
        }

        public function allUserTypes()
        {
            $user_types = UserType::all();
            return view('roles.admin.all_user_types', compact('user_types'));
        }

        public function showCreateUserAdmin()
        {
            $user_types = UserType::all();
            return view('roles.admin.create_user', compact('user_types'));
        }

        public function createUserAdmin(Request $request)
        {
            $request->validate([
                'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', Rules\Password::defaults()],
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['nullable', 'string'],
                'birthday' => ['nullable', 'date'],
            ]);

            $user = User::create([
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'name' => $request['name'],
                'user_type_id' => 3,  // Set default value for user_type_id
                'phone' => $request['phone'],
                'birthday' => $request['birthday'],
                'email_verified_at' => now()->format('Y-m-d H:i'),
            ]);

            event(new Registered($user));

            return redirect()->back()->with('success', 'Korisnik je uspešno kreiran.');
        }

        public function chooseUserForUpdate(Request $request)
        {
            $users = User::all();

            return view('roles.admin.pre_update_user', compact('users'));
        }

        public function forwardUserForUpdate(Request $request)
        {
            $user_id = $request->user_id;
            // kako se vrednost ne bi gubila ukoliko se korisnik vrati unazad stranicu
            session(['user_id' => $user_id]);

            return redirect()->route('update_user_admin', ['user_id' => $user_id]);
        }

        public function showUpdateAdmin()
        {
            $user = User::findOrFail(session('user_id'))->attributesToArray();
            $user_types = UserType::all();
            return view('roles.admin.update_user', compact('user', 'user_types'));
        }

        public function updateUserAdmin(Request $request)
        {
            $validatedData = $request->validate([
                'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', Rules\Password::defaults()],
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['nullable', 'string'],
                'birthday' => ['nullable', 'date'],
                'user_type_id' => ['required', 'exists:user_types,id'],
                'id' => ['required', 'exists:users,id'],
            ]);

            $user = User::find($validatedData['id']);
            if (!$user) {
                return redirect()->back()->withErrors(['id' => 'Pogrešan ID korisnika'])->withInput();
            }

            $user->username = $validatedData['username'];
            $user->password = Hash::make($validatedData['password']);
            $user->name = $validatedData['name'];
            $user->phone = $validatedData['phone'];
            $user->email = $validatedData['email'];
            $user->birthday = $validatedData['birthday'];
            $user->user_type_id = $validatedData['user_type_id'];

            $user->save();

            return redirect()->back()->with('success', 'Korisnik je uspešno izmenjen.');
        }

        public function allUsers()
        {
            $users = User::all();
            return view('roles.admin.all_users', compact('users'));
        }

        public function returnNewTaskGroupAdmin()
        {
            return view('roles.admin.create_task_group');
        }

        public function createTaskGroupAdmin(Request $request)
        {
            $request->validate([
                'name' => ['required', 'string'],
            ]);

            $taskGroup = TaskGroup::create([
                'name' => $request->input('name'),
            ]);

            return redirect()->back()->with('success', 'Grupa je uspešno kreirana.');
        }

        public function returnUpdateTaskGroupAdmin()
        {
            $task_groups = TaskGroup::all();

            return view('roles.admin.update_task_group', compact('task_groups'));
        }

        public function updateTaskGroupAdmin(Request $request)
        {
            $request->validate([
                'task_group_id' => ['required', 'exists:task_groups,id'],
                'name' => ['required', 'string'],
            ]);

            $id = $request->task_group_id;
            $name = $request->input('name');

            $taskGroup = TaskGroup::findOrFail($id);

            $taskGroup->update([
                'name' => $name,
            ]);

            return redirect()->back()->with('success', 'Grupa je uspešno izmenjena.');
        }

        public function allGroup()
        {
            $groups = TaskGroup::all();

            return view('roles.admin.all_task_groups', compact( 'groups'));
        }


        public function returnNewTaskAdmin()
        {
            $executors = User::all();
            $managers = User::where('user_type_id', 2)->get();
            $task_groups = TaskGroup::all();

            return view('roles.admin.create_task', compact('executors', 'managers', 'task_groups'));
        }

        public function createNewTaskAdmin(Request $request)
        {
            $request->validate([
                'title' => ['required', 'string', 'max:191'],
                'description' => ['required', 'string'],
                'list_executors' => ['required', 'array'],
                'list_executors.*' => ['required', 'exists:users,id'],
                'deadline' => ['required', 'date'],
                'priority' => ['required', 'integer', 'between:1,10'],
                'task_group_id' => ['required', 'exists:task_groups,id'],
                'file' => ['file'],
            ]);
            $list_executors = User::whereIn('id', $request->input('list_executors'))->where('user_type_id', 3)->get();
            $list_executors = $list_executors->pluck('id')->toArray();


            Task::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'list_executors' => implode(',', $list_executors),
                'manager' => $request->manager,
                'deadline' => $request->input('deadline'),
                'priority' => $request->input('priority'),
                'task_group_id' => $request->task_group_id,
                'file' => $request->file('file')->storeAs('', $request->file->getClientOriginalName(), 'public'),
                'status' => 'Nezavršen',
            ]);

            return redirect()->back()->with('success', 'Zadatak je uspešno kreiran.');
        }

        public function chooseUpdateTask(Request $request)
        {
            $tasks = Task::all();

            return view('roles.admin.pre_update_task', compact('tasks'));
        }

        public function forwardUpdateTask(Request $request)
        {
            $task_id = $request->task_id;
            // kako se vrednost ne bi gubila ukoliko se korisnik vrati unazad stranicu
            session(['task_id' => $task_id]);

            return redirect()->route('update_task_admin', ['task_id' => $task_id]);
        }

        public function returnUpdateTaskAdmin(Request $request)
        {
            $task = Task::findOrFail(session('task_id'))->attributesToArray();
            $task_groups = TaskGroup::all();
            $executors = User::where('user_type_id', 3)->get();
            $managers = User::where('user_type_id', 2)->get();

            return view('roles.admin.update_task', compact('task', 'task_groups', 'executors', 'managers'));
        }

        public function updateTaskAdmin(Request $request)
        {
            $task_id = session('task_id');
            $task = Task::findOrFail($task_id);

            $request->validate([
                'title' => ['required', 'string', 'max:191'],
                'description' => ['required', 'string'],
                'list_executors' => ['required', 'array'],
                'list_executors.*' => ['required', 'exists:users,id'],
                'deadline' => ['required', 'date'],
                'priority' => ['required', 'integer', 'between:1,10'],
                'task_group_id' => ['required', 'exists:task_groups,id'],
                'file' => ['file'],
            ]);

            $list_executors = User::whereIn('id', $request->input('list_executors'))->where('user_type_id', 3)->get();
            $list_executors = $list_executors->pluck('id')->toArray();

            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->list_executors = implode(',', $list_executors);
            $task->manager = $request->manager;
            $task->deadline = $request->input('deadline');
            $task->priority = $request->input('priority');
            $task->task_group_id = $request->input('task_group_id');
            $task->file = $request->file('file')->storeAs('', $request->file->getClientOriginalName(), 'public');


            $task->save();

            return redirect()->back()->with('success', 'Zadatak je uspešno ažuriran.');
        }

        public function allTask()
        {
            $tasks = Task::all();
            return view('roles.admin.all_tasks', compact('tasks'));
        }

        public function returnNewCommentAdmin()
        {
            $tasks = Task::all();

            return view('roles.admin.create_comment', compact('tasks'));
        }

        public function createNewCommentAdmin(Request $request)
        {
            $request->validate([
                'task_id' => ['required', 'exists:tasks,id'],
                'content' => ['required', 'string'],
            ]);

            $taskId = $request->input('task_id');
            $userId = Auth::id();
            $commentText = $request->input('content');

            $comment = new Comment();
            $comment->task_id = $taskId;
            $comment->user_id = $userId;
            $comment->content = $commentText;
            $comment->save();

            return redirect()->back()->with('success', 'Komentar je uspešno dodat.');
        }

        public function returnUpdateCommentAdmin()
        {
            $comments = Comment::all();

            return view('roles.admin.update_comment', compact('comments'));
        }

        public function updateCommentAdmin(Request $request)
        {
            $request->validate([
                'id' => ['required', 'exists:comments,id'],
                'content' => ['required', 'string'],
            ]);

            $id = $request->id;
            $content = $request->input('content');

            $comment = Comment::findOrFail($id);
            $comment->update([
                'content' => $content,
            ]);
            $comment->save();

            return redirect()->back()->with('success', 'Komentar je uspešno izmenjen.');
        }

        public function allComments()
        {
            $comments = Comment::all();

            return view('roles.admin.all_comments', compact('comments'));
        }

        public function indexSortAdmin(Request $request)
        {
            $tasks = Task::all();

            $sort = $request->input('sort', 'title'); // Default sort column
            $order = $request->input('order', 'asc'); // Default order

            $tasks = $this->sortTasksAdmin($tasks, $sort, $order);

            return view('roles.admin.all_tasks', compact('tasks', 'sort', 'order'));
        }

        private function sortTasksAdmin($tasks, $sort, $order)
        {
            // Validate sort and order parameters
            $validSorts = ['id', 'title', 'list_executors', 'manager', 'deadline', 'priority', 'task_group_id', 'status'];
            $validOrders = ['asc', 'desc'];

            //default vrednosti
            if (!in_array($sort, $validSorts)) {
                $sort = 'id';
            }
            if (!in_array($order, $validOrders)) {
                $order = 'asc';
            }

            // sortiranje
            return $tasks->sortBy($sort, SORT_REGULAR, $order === 'desc');
        }

        public function completeTask(Task $task)
        {
            $task->status = 'Završeno';
            $task->save();

            return redirect()->back();
        }

        public function cancelTask(Task $task)
        {
            $task->status = 'Otkazano';
            $task->save();

            return redirect()->back();
        }

        public function addComment(Request $request)
        {
            $request->validate([
                'task_id' => 'required|exists:tasks,id',
                'comment' => 'required|string|max:255',
            ]);

            $comment = new Comment();
            $comment->task_id = $request->input('task_id');
            $comment->user_id = Auth::id();
            $comment->content = $request->input('comment');
            $comment->save();


            return redirect()->back();
        }

        public function deleteComment(Comment $comment)
        {
            $comment->delete();

            return redirect()->back();
        }

        public function store(Request $request)
        {
            $requestData = $request->all();
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $requestData["photo"] = '/storage/'.$path;
            Task::create($requestData);
            return redirect('create_task_admin')->with('flash_message', 'Employee Addedd!');
        }
    }
