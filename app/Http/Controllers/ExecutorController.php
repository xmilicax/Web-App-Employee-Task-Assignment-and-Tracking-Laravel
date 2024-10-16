<?php

    namespace App\Http\Controllers;

    use App\Models\Comment;
    use App\Models\Task;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class ExecutorController extends Controller
    {
        public function index()
        {
            if (Auth::check() && Auth::user()->user_type_id == 3) {
                return view('roles.executor');
            }
            return redirect('/');
        }

        public function show($id)
        {
            $task = Task::find($id);
            // You can return the task data to a view or as JSON
            return view('roles.executor.task-detail', ['task' => $task]);
        }

        public function indexSort(Request $request)
        {
            // Collect all tasks
            $tasks = Task::all();

            // Get sorting parameters from the request
            $sort = $request->input('sort', 'title'); // Default sort column
            $order = $request->input('order', 'asc'); // Default order

            // Sort tasks based on sorting parameters
            $tasks = $this->sortTasks($tasks, $sort, $order);

            // Pass tasks and sorting parameters to the view
            return view('roles.executor.task', compact('tasks', 'sort', 'order'));
        }

        private function sortTasks($tasks, $sort, $order)
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

        public function returnTaskEx()
        {
            $user = Auth::user();

            $tasks = Task::where('list_executors', 'LIKE', '%' . $user->id . '%')->get();

            return view('roles.executor.task', ['tasks' => $tasks]);
        }

        public function returnTaskExFilter()
        {
            $user = Auth::user();

            $tasks = Task::where('list_executors', 'LIKE', '%' . $user->id . '%')->get();

            return view('roles.executor.filter', ['tasks' => $tasks]);
        }

        public function showTaskDetails($id)
        {
            $task = Task::findOrFail($id);
            return view('task-detail', compact('task'));
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

        public function completeTask(Task $task)
        {
            $task->status = 'Završeno';
            $task->save();

            return redirect()->back()->with('success', 'Vaš deo zadatka je označen kao završen.');
        }

        public function filter()
        {
            $tasks = Task::all();
            return view('roles.executor.filter', compact('tasks'));
        }

        public function filterByDeadlineExec(Request $request)
        {
            // filtriranje od trenutka do unetog datuma
            $tasks = Task::where('deadline', '>=', now())
                ->where('deadline', '<=', $request->date)
                // zadaci samo trenutnog izvršioca
                ->where('list_executors', 'like', '%' . Auth::user()->id . '%')
                ->get();

            return view('roles.executor.filter', compact('tasks'));

        }

        public function filterByExecExec(Request $request)
        {
            // provera koja je vrednost
            //dd($request->executor);

            $tasks = Task::where('list_executors', 'like', '%' . $request->executor . '%')
                // zadaci samo trenutnog izvršioca
                ->where('list_executors', 'like', '%' . Auth::user()->id . '%')
                ->get();
            return view('roles.executor.filter', compact('tasks'));
        }


        public function filterByManagerExec(Request $request)
        {
            $tasks = Task::where('manager', 'like', '%' . $request->manager. '%')
                // zadaci samo trenutnog izvršioca
                ->where('list_executors', 'like', '%' . Auth::user()->id . '%')
                ->get();
            return view('roles.executor.filter', compact('tasks'));
        }


        public function sortTask(Request $request)
        {
            $column = $request->input('column', 'deadline');
            $order = $request->input('order', 'asc');

            $validColumns = ['deadline', 'title', 'priority']; // Add valid columns here
            $validOrders = ['asc', 'desc'];

            if (!in_array($column, $validColumns)) {
                $column = 'deadline';
            }

            if (!in_array($order, $validOrders)) {
                $order = 'asc';
            }

            $tasks = Task::orderBy($column, $order)->get();

            return view('roles.executor.sort', compact('tasks', 'column', 'order'));
        }
        public function indexSortExec(Request $request)
        {
            $user = Auth::user();
            $tasks = Task::where('list_executors', 'LIKE', '%' . $user->id . '%')->get();

            $sort = $request->input('sort', 'title'); // Default sort column
            $order = $request->input('order', 'asc'); // Default order

            $tasks = $this->sortTasksExec($tasks, $sort, $order);

            return view('roles.executor.task', compact('tasks', 'sort', 'order'));
        }

        private function sortTasksExec($tasks, $sort, $order)
        {
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
    }
