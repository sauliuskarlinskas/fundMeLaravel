@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add new idea</h5>
                        <form method="post" action="{{ route('ideas-store') }}" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label class="form-label">{{ Auth::user()->name }}</label>
                                <input name="user_id" type="text" class="form-control" value="{{ Auth::user()->id }}"
                                    hidden>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('description')}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Main image</label>
                                <input name="main_image" class="form-control" type="file" id="formFile" value="{{ old('main_image') }}">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">More images (optional)</label>
                                <input name="img_1" class="form-control" type="file" id="formFile1" value="{{ old('img_1') }}">
                            </div>
                            <div class="mb-3">
                                <input name="img_2" class="form-control" type="file" id="formFile2" value="{{ old('img_2') }}">
                            </div>
                            <div class="mb-3">
                                <input name="img_3" class="form-control" type="file" id="formFile3" value="{{ old('img_3') }}">
                            </div>
                            <div class="mb-3">
                                <input name="img_4" class="form-control" type="file" id="formFile4" value="{{ old('img_4') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Amount of money you need</label>
                                <input name="money_need" type="text" class="form-control" value={{ old('money_need') }}>
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
