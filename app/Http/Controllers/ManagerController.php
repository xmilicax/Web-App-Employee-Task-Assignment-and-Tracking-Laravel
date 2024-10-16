<?php

    namespace App\Http\Controllers;

    use App\Models\Comment;
    use App\Models\Task;
    use App\Models\TaskGroup;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;


    class ManagerController extends Controller
    {
        public function index()
        {
            if (Auth::check() && Auth::user()->user_type_id == 2) {
                return view('roles.manager');
            }
            return redirect('/');
        }

        public function show($id)
        {
            $task = Task::find($id);
            // You can return the task data to a view or as JSON
            return view('roles.manager.task_details_mng', ['task' => $task]);
        }

        public function returnTaskMng()
        {
            $user = Auth::user();

            $tasks = Task::where('manager', 'LIKE', '%' . $user->id . '%')->get();

            return view('roles.manager.task_list_mng', ['tasks' => $tasks]);
        }

        public function returnTaskMngFilter()
        {
            $user = Auth::user();

            $tasks = Task::where('manager', 'LIKE', '%' . $user->id . '%')->get();

            return view('roles.manager.filter_mng', ['tasks' => $tasks]);
        }

        public function showTaskDetails($id)
        {
            $task = Task::findOrFail($id);
            return view('task_detail_mng', compact('task'));
        }

        public function completeTask(Task $task)
        {
            $task->status = 'Završeno';
            $task->save();

            return redirect()->back()->with('success', 'Zadatak je označen kao završen.');
        }

        public function cancelTask(Task $task)
        {
            $task->status = 'Otkazano';
            $task->save();

            return redirect()->back()->with('success', 'Zadatak je označen kao otkazan.');
        }


        public function filter()
        {
            $tasks = Task::all();
            return view('roles.executor.filter_mng', compact('tasks'));
        }

        public function filterByDeadlineMng(Request $request)
        {
            // filtriranje od trenutka do unetog datuma
            $tasks = Task::where('deadline', '>=', now())
                ->where('deadline', '<=', $request->date)
                // zadaci samo trenutnog rukovodioca
                ->where('manager', 'like', '%' . Auth::user()->id . '%')
                ->get();

            return view('roles.manager.filter_mng', compact('tasks'));

        }

        public function filterByExecMng(Request $request)
        {
            $tasks = Task::where('list_executors', 'like', '%' . $request->executor . '%')
                // zadaci samo trenutnog rukovodioca
                ->where('manager', 'like', '%' . Auth::user()->id . '%')
                ->get();
            return view('roles.manager.filter_mng', compact('tasks'));
        }

        public function filterByPriorityMng(Request $request)
        {
            $tasks = Task::where('priority', 'like', '%' . $request->priority . '%')
                // zadaci samo trenutnog izvršioca
                ->where('manager', 'like', '%' . Auth::user()->id . '%')
                ->get();
            return view('roles.manager.filter_mng', compact('tasks'));
        }

        public function filterByTitleMng(Request $request)
        {
            $tasks = Task::where('title', 'like', '%' . $request->title . '%')
                // zadaci samo trenutnog izvršioca
                ->where('manager', 'like', '%' . Auth::user()->id . '%')
                ->get();
            return view('roles.manager.filter_mng', compact('tasks'));
        }

        // GRUPE ZADATAKA ----------------------------------------------------------------------------------------------

        public function returnCreateTaskGroup()
        {
            return view('roles.manager.create_task_group_mng');
        }

        public function createTaskGroup(Request $request)
        {
            $request->validate([
                'name' => ['required', 'string'],
            ]);

            TaskGroup::create([
                'name' => $request->input('name'),
            ]);

            return redirect()->back()->with('success', 'Grupa je uspešno kreirana.');
        }

        public function returnUpdateTaskGroup()
        {
            $task_groups = TaskGroup::all();

            return view('roles.manager.update_task_group_mng', compact('task_groups'));
        }

        public function updateTaskGroup(Request $request)
        {
            // provera da li hvata dobru vrednost
            //dd($request->task_group_id);

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

        public function returnDeleteTaskGroup()
        {
            $task_groups = TaskGroup::all();

            return view('roles.manager.delete_task_group_mng', compact('task_groups'));
        }

        public function deleteTaskGroup(Request $request)
        {
            $request->validate([
                'task_group_id' => ['required', 'exists:task_groups,id'],
            ]);

            $taskGroup = TaskGroup::findOrFail($request->task_group_id);
            $taskGroup->delete();

            return redirect()->back()->with('success', 'Grupa je uspešno obrisana.');
        }

        public function returnTaskGroup()
        {
            $groups = TaskGroup::all();

            return view('roles.manager.list_task_group_mng', ['groups' => $groups]);
        }

        // ZADACI ------------------------------------------------------------------------------------------------------
        public function returnNewTaskAdmin()
        {

            $executors = User::all();
            $task_groups = TaskGroup::all();


            return view('roles.manager.create_task_mng', compact('executors', 'task_groups'));
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

            //dd($request->list_executors);

            $list_executors = User::whereIn('id', $request->input('list_executors'))->where('user_type_id', 3)->get();
            $list_executors = $list_executors->pluck('id')->toArray();

            Task::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'list_executors' => implode(',', $list_executors),
                'manager' => Auth::user()->id,
                'deadline' => $request->input('deadline'),
                'priority' => $request->input('priority'),
                'task_group_id' => $request->input('task_group_id'),
                'file' => $request->file('file')->storeAs('', $request->file->getClientOriginalName(), 'public'),
                'status' => 'Nezavršen',
            ]);

            // dd($file->getClientOriginalName(),$file->getClientOriginalExtension(),$file->getRealPath(), $file->getMimeType());

            return redirect()->back()->with('success', 'Zadatak je uspešno kreiran.');
        }


        public function chooseUpdateTask(Request $request)
        {
            $tasks = Task::all();

            return view('roles.manager.pre_update_task_mng', compact('tasks'));
        }

        public function forwardUpdateTask(Request $request)
        {
            $task_id = $request->task_id;
            // kako se vrednost ne bi gubila ukoliko se korisnik vrati unazad stranicu
            session(['task_id' => $task_id]);

            return redirect()->route('update_task_mng', ['task_id' => $task_id]);
        }

        public function returnUpdateTask(Request $request)
        {
            //dd($request->task_id);

            $task = Task::findOrFail(session('task_id'))->attributesToArray();
            $task_groups = TaskGroup::all();
            $executors = User::where('user_type_id', 3)->get();

            return view('roles.manager.update_task_mng', compact('task', 'task_groups', 'executors'));
        }


        public function updateTask(Request $request)
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
            $task->manager = Auth::user()->id;
            $task->deadline = $request->input('deadline');
            $task->priority = $request->input('priority');
            $task->task_group_id = $request->input('task_group_id');
            $task->file = $request->file('file')->storeAs('', $request->file->getClientOriginalName(), 'public');

            $task->save();

            return redirect()->back()->with('success', 'Zadatak je uspešno ažuriran.');
        }

        public function returnDeleteTask(Request $request)
        {
            $tasks = Task::all();

            return view('roles.manager.delete_task_mng', compact('tasks'));
        }

        public function deleteTask(Request $request)
        {
            $request->validate([
                'task_id' => ['required', 'exists:tasks,id'],
            ]);

            $task = Task::findOrFail($request->task_id);
            $task->delete();

            return redirect()->back()->with('success', 'Zadatak je uspešno obrisan.');
        }

        public function indexSortMng(Request $request)
        {
            $user = Auth::user();
            $tasks = Task::where('manager', 'LIKE', '%' . $user->id . '%')->get();

            $sort = $request->input('sort', 'title'); // Default sort column
            $order = $request->input('order', 'asc'); // Default order

            $tasks = $this->sortTasksMng($tasks, $sort, $order);

            return view('roles.manager.task_list_mng', compact('tasks', 'sort', 'order'));
        }

        private function sortTasksMng($tasks, $sort, $order)
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


    }
