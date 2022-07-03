@extends('layout')

@section('main-content')

<div>
    <div class="float-start">
        <h4 class="pb-3">Edit Tasks - <span class="badge bg-info">{{ $task->title }} </span> </h4>
    </div>
    <div class="float-end">
        <a href="{{route('index')}}" class="btn btn-info">All Task</a>
    </div>
    <div class="clearfix"></div>
</div>

    <div class="card card-bo9dy bg-light p-4">
    <form action="{{ route('task.update', $task->id) }}" method="post">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" id="title" value="{{ $task->title }}">
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" rows="5" > {{$task->description }} </textarea>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Status</label>
        <select name="status" id="status" name="status" class="form-select"  aria-label="Default select example">
            @foreach ($statuses as $status)
            <option value="{{ $status['value'] }}" {{ $task->status == $status['value'] ? 'selected' : '' }}> {{ $status['label'] }} </option> 
            @endforeach
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
    </form>
        </div>









@endsection