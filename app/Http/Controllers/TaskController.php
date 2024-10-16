<?php

    namespace App\Http\Controllers;

    use Illuminate\Support\Facades\Response;

    class TaskController extends Controller
    {
        public function download($file)
        {
            $filePath = storage_path('app/public/' . $file);

            return Response::download($filePath);
        }
}
