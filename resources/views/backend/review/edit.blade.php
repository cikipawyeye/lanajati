@extends('backend.layouts.master')

@section('title','Review Edit')

@section('main-content')
<div class="card">
  <h5 class="card-header">Edit Ulasan</h5>
  <div class="card-body">
    <form action="{{route('review.update',$review->id)}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="name">Ditinjau Oleh:</label>
        <input type="text" disabled class="form-control" value="{{$review->user_info->name}}">
      </div>
      <div class="form-group">
        <label for="review">Ulasan</label>
      <textarea name="review" id="" cols="20" rows="10" class="form-control">{{$review->review}}</textarea>
      </div>
      <div class="form-group">
        <label for="status">Status :</label>
        <select name="status" id="" class="form-control">
          <option value="">--Pilih Status--</option>
          <option value="active" {{(($review->status=='active')? 'selected' : '')}}>Active</option>
          <option value="inactive" {{(($review->status=='inactive')? 'selected' : '')}}>Inactive</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
@endsection

@push('styles')


@endpush