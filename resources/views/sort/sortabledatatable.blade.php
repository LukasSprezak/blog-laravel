@extends('base')
@section('body')
<div class="search">
    <p>&nbsp;</p>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <table id="table" class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody id="tablecontents">
                @foreach($tasks as $task)
                    <tr class="row1" data-id="{{ $task->id }}">
                        <td>
                            <div style="color:rgb(124,77,255); padding-left: 10px; float: left; font-size: 20px; cursor: pointer;" title="change display order">
                                <i class="fa fa-ellipsis-v"></i>
                                <i class="fa fa-ellipsis-v"></i>
                            </div>
                        </td>
                        <td>{{ $task->title }}</td>
                        <td>{{ ($task->status == 1)? "Completed" : "Not Completed" }}</td>
                        <td>{{ date('d-m-Y h:m:s',strtotime($task->created_at)) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr>
</div>
@endsection