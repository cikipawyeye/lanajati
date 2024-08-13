@extends('user.layouts.master')

@section('title','Edit Komentar')

@section('main-content')
<div class="card">
  <h5 class="card-header">Edit Komentar</h5>
  <div class="card-body">
    <form action="{{route('user.post-comment.update',$comment->id)}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="name">Oleh:</label>
        <input type="text" disabled class="form-control" value="{{$comment->user_info->name}}">
      </div>
      <div class="form-group">
        <label for="comment">Komentar</label>
      <textarea name="comment" id="" cols="20" rows="10" class="form-control">{{$comment->comment}}</textarea>
      </div>
      <div class="form-group">
        <label for="status">Status :</label>
        <select name="status" id="" class="form-control">
          <option value="">--Pilih Status--</option>
          <option value="active" {{(($comment->status=='active')? 'selected' : '')}}>Aktif</option>
          <option value="inactive" {{(($comment->status=='inactive')? 'selected' : '')}}>Non Aktif</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
@endsection

@push('styles')

@endpush