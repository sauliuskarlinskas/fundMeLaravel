@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                                    value="{{ old('description', $idea->description) }}"></textarea>
                            </div>
                            <div class="card">
                                <img src="{{ asset($idea->main_image) }}" alt="idea">
                                <div class="card-body">
                                    <label for="formFile" class="form-label">Change main image</label>
                                    <input name="main_image" class="form-control mt-2" type="file" id="formFile">
                                </div>
                            </div>

                            <div class="card-group">
                                <div class="card">
                                    <img src="{{ asset($idea->img_1) }}" alt="galery img">
                                    @if ($idea->img_1)
                                        <div class="form-check mt-2">
                                            <input name="remove_img_1" class="form-check-input" type="checkbox"
                                                id="removeImg1">
                                            <label class="form-check-label" for="removeImg1">
                                                Remove image
                                            </label>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <input name="img_1" class="form-control mt-2" type="file" id="formFile1">
                                    </div>

                                </div>
                                <div class="card">
                                    <img src="{{ asset($idea->img_2) }}" alt="galery img">
                                    @if ($idea->img_2)
                                        <div class="form-check mt-2">
                                            <input name="remove_img_2" class="form-check-input" type="checkbox"
                                                id="removeImg2">
                                            <label class="form-check-label" for="removeImg2">
                                                Remove image
                                            </label>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <input name="img_2" class="form-control mt-2" type="file" id="formFile2">
                                    </div>
                                </div>
                            </div>
                            <div class="card-group">
                                <div class="card">
                                    <img src="{{ asset($idea->img_3) }}" alt="galery img">
                                    @if ($idea->img_3)
                                        <div class="form-check mt-2">
                                            <input name="remove_img_3" class="form-check-input" type="checkbox"
                                                id="removeImg3">
                                            <label class="form-check-label" for="removeImg3">
                                                Remove image
                                            </label>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <input name="img_3" class="form-control mt-2" type="file" id="formFile3">
                                    </div>
                                </div>
                                <div class="card">
                                    <img src="{{ asset($idea->img_4) }}" alt="galery img">
                                    @if ($idea->img_4)
                                        <div class="form-check mt-2">
                                            <input name="remove_img_4" class="form-check-input" type="checkbox"
                                                id="removeImg4">
                                            <label class="form-check-label" for="removeImg4">
                                                Remove image
                                            </label>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <input name="img_4" class="form-control mt-2" type="file" id="formFile4">
                                    </div>
                                </div>
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
