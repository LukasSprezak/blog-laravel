@extends('base')
@section('body')
<table class="table mb-0" id="formTable" data-sortable>
    <thead>
    <tr>
        <th>id</th>
        <th>Title</th>
    </tr>
    </thead>
    <tbody id="sortThis">
    @foreach($posts as $post)
        <tr data-index="{{ $post->id }}" data-position="{{ $post->position }}">
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection