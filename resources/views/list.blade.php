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
            <br>
            <a href="{{route('task.create')}}?type=group" class="btn btn-raised btn-primary round mr-1 mb-1"><i
                        class="fa fa-plus-circle"></i> Create</a>

            <h1>Todo List</h1>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Task</th>
                    <th scope="col">Remaining Time</th>
                    <th scope="col">End DateTime</th>
                    <th scope="col">Type Zone</th>
                    <th scope="col">status</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <?php
                        $elapsed = 'Time Zone not set.';
                        if($zone == 'Asia/Karachi'){
                            date_default_timezone_set("Asia/Karachi");
                            $datetime1 = new DateTime();
                            $datetime2 = new DateTime($task->end_datetime);
                            $interval = $datetime1->diff($datetime2);

                        }elseif ($zone == 'Asia/Kolkata'){
                            date_default_timezone_set('Asia/Kolkata');
                            $datetime1 = new DateTime();
                            $datetime2 = new DateTime($task->end_datetime);
                            $interval = $datetime1->diff($datetime2);
                        }

                        if(!empty($datetime1) && !empty($datetime2)){
                            if ($datetime1 < $datetime2) {
                                $elapsed = $interval->format('%H : %I : %S ');
                            }else{
                                $elapsed = 'Time is our.';
                            }
                        }
                        ?>
                        <tr>
                        <td>
                            @if($elapsed != 'Time is our.' && $elapsed != 'Time Zone not set.')
                                <a href ={{url('/'.$task->id.'/complete')}}>{{ $task->id }} - Status Change</a>
                            @else
                                {{ $task->id }}
                            @endif
                        </td>
                        <td>{{$task->task}}</td>
                        <td>{{$elapsed}}</td>
                        <td>{{$task->end_datetime}}</td>
                        <td>{{$zone}}</td>
                        <td class="alert-danger">
                            InComplete
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h1>Completed List</h1>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Task</th>
                    <th scope="col">status</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($completed_tasks as $c_task)
                    <tr>
                        <td><a href ={{route('task.destory',$c_task->id)}}>{{$c_task->id}} - Delete</a></td>
                        <td>{{$c_task->task}}</td>
                        <td class="alert-primary">
                            Complete
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

</div>
@endsection
