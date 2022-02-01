@extends('layouts.backend.app')
@section('title', 'Konten')
@section('content')
@include('admin-views.content.partials._headerPage')
<div class="container mt--8">
    <div class="row">
        <div class="col">
            <div class="card p-3">
                <div class="card-title">Add New Content</div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <textarea class="form-control" id="desc" name="desc"></textarea>
                        </div>
                        <div class="text-end w-100">
                            <button type="submit" class="btn btn-primary text-end">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
