<?php

namespace App\Http\Controllers;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Response;
use Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $user = Auth::user();
        $tasks = Task::where('complete', 0)->orderBy('id', 'desc')->get();
        return Response::json(
            ['status' => true,
            'tasks' => $tasks,
            'user' => $user
            ], 200
        );
    }

    public function getCompleteTask(Request $request){
        $user =  User::find($request->userid);
        $tasks = $user->tasks()->where('complete', 1)->get();
        return Response::json(
            ['status' => true,
            'tasks' => $tasks
            ], 200
        );
    }

    public function changeTaskStatus(Request $request){
        $task = Task::find($request->id);
        $task->complete = 0;
        $task->save();
        return Response::json(
            ['status' => true,
            'message' => 'task added'
            ], 200
        );
    }

    public function getAllTasks(Request $request){
        $user =  User::find($request->userid);
        $tasks = $user->tasks()->where('complete', 0)->get();
        if($user){
            return Response::json(
                ['status' => true,
                'tasks' => $tasks
                ], 200
            );
        }else{
            return Response::json(
                ['status' => true,
                'message' => 'user not found'
                ], 200
            );
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'user_id' => 'required',
                    ]);
        if($validator->fails()) {
            $messages = $validator->messages();
            return Response::json([
                'status' => false,
                'message' => $messages->toArray()
            ], 422);
        }
        $task = Task::create($request->all()); 
        return Response::json([
            'status' => true,
            'task' => $task
        ], 200);           
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required',
            ]);
        if($validator->fails()) {
            $messages = $validator->messages();
            return Response::json([
                'status' => false,
                'message' => $messages->toArray()
            ], 422);
        }
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return Response::json([
            'status' => true,
            'task' => $task
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->complete = 1;
        $task->save();
        return Response::json([
            'status' => true,
            'message' => 'Task removed'
        ], 200);
    }
}
