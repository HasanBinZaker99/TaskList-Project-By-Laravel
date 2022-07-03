@extends('layout')

@section('main-content')

<div>
  <div class="float-start">
    <h4 class="pb-3">Create Tasks</h4>
  </div>
  <div class="float-end">
    <a href="{{route('index')}}" class="btn btn-info"><i class="fa-solid fa-arrow-left pe-1"></i>All Task</a>
  </div>
  <div class="clearfix"></div>
</div>

<div class="card card-bo9dy bg-light p-4">
  <form action="{{ route('task.store') }}" method="post">
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" name="title" class="form-control" id="title">
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control" name="description" id="description" rows="5">  </textarea>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Status</label>
      <select name="status" id="status" name="status" class="form-select" aria-label="Default select example">
        @foreach ($statuses as $status)
        <option value="{{ $status['value'] }}"> {{ $status['label'] }} </option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label for="dob">Date *</label>
      <input type="date" class="form-control" id="dob" name="date" />
    </div>
    <div class="mb-3">
      <label for="dob"> Time *</label>
      <input type="time" class="form-control" id="dob" name="time" value={{time()}}/>
    </div>
    <a href="{{route('index')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left pe-1"></i>Cancel</a>
    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check pe-1"></i>Save</button>
  </form>
</div>









@endsection