@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit your idea</h5>
                        <form method="post" action="{{ route('ideas-update', $idea) }}" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label class="form-label">{{ Auth::user()->name }}</label>
                                <input name="user_id" type="text" class="form-control"
                                    value="{{ old('user_id', $idea->user_id) }}" hidden>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Edit description</label>
                                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"
                                    value={{ old('description', $idea->description) }}></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Change main image</label>
                                <input name="main_image" class="form-control" type="file" id="formFile">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Change amount of money you need</label>
                                <input name="money_need" type="text" class="form-control"
                                    value={{ old('money_need', $idea->money_need) }}>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('ideas-index') }}" class="btn btn-secondary">Cancel</a>
                            @method('put')
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
