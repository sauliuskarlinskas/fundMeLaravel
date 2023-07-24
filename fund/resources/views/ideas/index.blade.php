@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">


                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h4 class="card-title">Ideas list</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse($ideas as $idea)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex">
                                            <div class="ms-2">
                                                <div>Name: {{ $idea->user->name }}</div>
                                                <div>{{ $idea->description }}</div>
                                                <img src="{{ $idea->main_image }}" class="img-thumbnail" alt="idea">
                                                <div>{{ $idea->money_need }} €</div>


                                                <div>
                                                    <a class="btn btn-success">
                                                        Edit
                                                    </a>
                                                    <a class="btn btn-danger">
                                                        Delete
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item">
                                    <p class="text-center">No Ideas</p>
                                </li>
                            @endforelse
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                {{ $ideas->links() }}
            </div>
        </div>
    </div>
@endsection
