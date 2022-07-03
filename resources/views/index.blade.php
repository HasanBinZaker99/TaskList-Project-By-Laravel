@extends('layout')

@section('main-content')
@php


@endphp

<div>
    <div class="float-start">
        <h4 class="pb-3">My Tasks</h4>
    </div>
    <div class="float-end">
        <a href="{{route('task.create')}}" class="btn btn-info"><i class="fa-solid fa-circle-plus pe-1"></i>Create Task</a>
    </div>
    <div class="clearfix"></div>
</div>

@if(Session::has('msg'))
<p id="message" class=" bg-info fw-bolder fs-4 text-light alert {{ Session::get('alert-class', 'alert-info') }}">
    {{ Session::get('msg') }}
</p>
@endif
@foreach ($tasks as $task)
<div class="card mt-3">

    <span class="fs-3 text-warning text-center bg-success text dark "> Date : {{$task->date}} </span>
    <h5 class="card-header">
        @if ($task->status === "Todo")
        {{ $task->title }} 
        @else
        <del> {{$task->title}} </del>
        @endif


        <span class="badge  rounded-pill text-dark bg-warning pe-2">
            Created at :
            {{\Carbon\Carbon::parse($task['created_at'])->diffForHumans() }}
        </span>
    </h5>
    <div class="card-body">
        <div class="card-text">
            <div class="float-start fst-normal fs-3">
                @if ($task->status == 'Todo')
                {{ $task->description }}
                <br>
                Time: {{ $task->time}}
                <br>
                Date: {{ $task->date}}
                @else
                <del>{{ $task->description}} </del>
                <br>
                <del>Time: {{ $task->time}} </del>
                <br>
                <del> Date: {{ $task->date}} </del>
                @endif
                <br>
                @if ($task->status === "Todo")
                <span class="badge bg-info rounded-pill text-dark bg-info"> Todo</span>
                @else
                <span class="badge bg-success rounded-pill text-white bg-success"> Done</span>
                @endif
            </div>
            <div class="float-end">
                <a href="{{route('task.edit',$task->id)}}" class="btn btn-success"><i class="fa fa-edit pe-1"></i>Edit</a>
                {{-- <a href="{{route('task.edit',$task->id)}}" class="btn btn-danger"> Delete</a> --}}
                <form action="{{ route('task.destroy',$task->id) }}" style="display:inline" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash pe-1"></i>Delete</button>
                </form>
            </div>
            <div class="clearfix"></div>
            <br>
            First Task

            <small>Last Updated - {{\Carbon\Carbon::parse($task['created_at'])->diffForHumans() }} </small>
        </div>

    </div>
</div>

@endforeach

@if (count($tasks) == 0 )
<div class="alert alert-danger p-2">
    No Task Found . Please create a Task First
    <br>
    <br>
    <a href="{{route('task.create')}}" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-plus pe-1"></i>Create Task</a>

</div>
@endif







@endsection