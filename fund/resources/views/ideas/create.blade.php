@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5  class="card-title">Add new idea</h5>
                        <form method="post" action="{{ route('ideas-store') }}">
                            <div class="mb-3">
                                    <label  class="form-label">User</label>
                                    <input name="user_id" type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                              </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Default file input example</label>
                                <input name="main_image" class="form-control" type="file" id="formFile">
                              </div>
                           
                            <button type="submit" class="btn btn-primary">Add</button>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection