<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Carbon\Carbon;
use Session;

use Illuminate\Http\Request;



class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tasks = Task::orderBy('id','desc')->get();
        return view('index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = [
            [
            'label' => 'Todo',
            'value' => 'Todo',
        ],
        [
            'label' => 'Done',
            'value' => 'Done',
        ]
        ];
        return view('create',compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // $dt = new Carbon();
        // $dt->timezone('Asia/Dhaka');
        // echo $dt->format('H:i:s A');
        $request->validate([
            'title' => 'required'
        ]);
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        //$task->time = $request->time->format('h:i:s a');
        $task->time = \Carbon\Carbon::parse($request->time)->format('h:i:s A');

        //$task->time = date("h:i:s A", strtotime(request('time')));
        $task->date = $request->date;
        //$task->time = Carbon\Carbon::parse($request->time)->format('h:i:s a');
       
        $task->save();
        return redirect()->route('index')->with('msg','Task Inserted Successfully');
        
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
        $task = Task::findOrFail($id);
        $statuses = [
            [
            'label' => 'Todo',
            'value' => 'Todo',
        ],
        [
            'label' => 'Done',
            'value' => 'Done',
        ]
        ];
        return view('edit',compact('statuses','task'));
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
        $task = Task::findOrFail($id);
        $request->validate([
            'title' => 'required'
        ]);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('index');
    }
}
