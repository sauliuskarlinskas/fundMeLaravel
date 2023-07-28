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
                                <p class="card-text">Money I need: {{ $idea->money_need }} € <a
                                        class="btn btn-secondary btn-lg">
                                        Donate
                                    </a></p>

                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100">25%</div>
                                </div>


                                <div class="button-group">
                                    <a class="btn btn-success" href="{{ route('ideas-edit', $idea) }}">
                                        Edit
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('ideas-delete', $idea) }}">
                                        Delete
                                    </a>
                                    <a class="btn btn-danger bi bi-suit-heart-fill"> <span
                                            class="badge bg-primary rounded-pill">0</span>
                                    </a>
                                    <form action="{{ route('ideas-add-tag', $idea) }}" method="post">
                                        <select name="tag_id">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-primary">Add tag</button>
                                        @csrf
                                    </form>
                                </div>

                            </div>

                        </div>

                        @foreach ($idea->tags as $tag)
                            <form class="tag-form" action="{{ route('ideas-remove-tag', [$idea, $tag]) }}" method="post">
                                <span class="badge bg-primary">#{{ $tag->name }}<button type="submit"
                                        class="btn-close"></button></span>
                                @csrf
                                @method('delete')
                            </form>
                        @endforeach

                    </div>
                </div>
            </div>

        @empty
            <li class="list-group-item">
                <p class="text-center">No ideas</p>
            </li>
            <div>
                {{ $ideas->links() }}
            </div>
        @endforelse


    </div>
@endsection
