@extends("layouts.app")
@section("content")
<div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Done !!!  </strong>{{ session()->get('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endif
            <h1>Create Task</h1>
            <form method="POST" action={{url('/task')}}>
                {{csrf_field()}}
                <div class="form-group m-5">
                    <label for="task">Task</label>
                    <input type="text" name="task" class="form-control" id="task" aria-describedby="task" placeholder="Enter Task">
                </div>
                <div class="form-group m-5">
                    <label for="task">End DateTime</label>
                    <input type="datetime-local" name="end_datetime" class="form-control" id="end_datetime" aria-describedby="end_datetime" placeholder="End Datetime">
                </div>
{{--                <div class="form-group m-5">--}}
{{--                    <label for="type">Time Zone</label>--}}
{{--                    <select name="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}">--}}
{{--                        <option value="">Please Select</option>--}}
{{--                        <option value="ist">IST</option>--}}
{{--                        <option value="pst">PST</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('task.list') }}"
                   class="btn btn-raised btn-raised btn-warning mr-1">
                    <i class="ft-x"></i> Back
                </a>
            </form>
</div>
@endsection
