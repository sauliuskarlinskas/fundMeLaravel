@extends('layouts.app')


@section('content')
    <div class="container">

        @forelse($ideas as $idea)
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="row g-0">

                        <div class="col-md-4">
                            <img src="{{ asset($idea->main_image) }}" class="img-fluid rounded-start" alt="idea">
                        </div>

                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Name: {{ $idea->user->name }}</h5>
                                <p class="card-text">{{ $idea->description }}</p>
                                <p class="card-text">Money I need: {{ $idea->money_need }}</p>

                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100">25%</div>
                                </div>

                                <div class="button-group">
                                    <a class="btn btn-success">
                                        Edit
                                    </a>
                                    <a class="btn btn-danger" href="{{route('ideas-delete', $idea)}}">
                                        Delete
                                    </a>
                                    <button class="btn btn-danger bi bi-suit-heart-fill">
                                    </button>


                                </div>

                            </div>
                           
                        </div>


                    </div>
                </div>
            </div>
        @empty
            <div>
                {{ $ideas->links() }}
            </div>
        @endforelse


    </div>
@endsection
