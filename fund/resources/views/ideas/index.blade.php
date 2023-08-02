@extends('layouts.app')


@section('content')
    <div class="container">

        @forelse($ideas as $idea)
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="row g-0">

                        <div class="col-md-6">
                            <img src="{{ asset($idea->main_image) }}" class="img-fluid rounded-start" alt="idea">

                        </div>

                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Name: {{ $idea->user->name }}</h5>
                                <p class="card-text">{{ $idea->description }}</p>
                                <p class="card-text">Money I need: {{ $idea->money_need }} € </p>
                                <p class="card-text">Money I have: {{ $idea->money_got }} € </p>

                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped" role="progressbar"
                                        style="width: {{ ($idea->money_got / $idea->money_need) * 100 }}%;"
                                        aria-valuenow="{{ $idea->money_got }}" aria-valuemin="0"
                                        aria-valuemax="{{ $idea->money_need }}">
                                        {{ round(($idea->money_got / $idea->money_need) * 100, 2) }}%
                                    </div>
                                </div>


                                <div class="button-group">
                                    <a class="btn btn-success" href="{{ route('ideas-edit', $idea) }}">
                                        Edit
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('ideas-delete', $idea) }}">
                                        Delete
                                    </a>
                                </div>

                                <div class="add-tag">
                                    <div>
                                        <form action="{{ route('ideas-add-tag', $idea) }}" method="post">
                                            <div class="input-group mb-2 mt-2">
                                                <button class="btn btn-secondary" type="submit">Add tag from list</button>
                                                <select class="form-select" id="inputGroupSelect03"
                                                    aria-label="Example select with button addon" name="tag_id">
                                                    @foreach ($tags as $tag)
                                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @csrf
                                        </form>
                                    </div>

                                    <div>
                                        <form action="{{ route('ideas-create-tag', $idea) }}" method="post">
                                            <div class="input-group mb-2">
                                                <button class="btn btn-secondary" type="submit" id="button-addon2">Create
                                                    and add tag</button>
                                                <input type="text" class="form-control" placeholder="Tag name"
                                                    aria-describedby="button-addon2" name="tag_name">
                                            </div>
                                            @csrf
                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>

                        
                            <div class="tag-line">
                                @foreach ($idea->tags as $tag)
                                    <form class="tag-form" action="{{ route('ideas-remove-tag', [$idea, $tag]) }}"
                                        method="post">
                                        <span class="badge bg-primary">#{{ $tag->name }}<button type="submit"
                                                class="btn-close"></button></span>
                                        @csrf
                                        @method('delete')
                                    </form>
                                @endforeach
                            </div>

                            <div class="card-group">
                                <div class="card">
                                    <img src="{{ asset($idea->img_1) }}" class="card-img-top" alt="galery 1">
                                </div>
                                <div class="card">
                                    <img src="{{ asset($idea->img_2) }}" class="card-img-top" alt="galery 2">
                                </div>
                                <div class="card">
                                    <img src="{{ asset($idea->img_3) }}" class="card-img-top" alt="galery 3">
                                </div>
                                <div class="card">
                                    <img src="{{ asset($idea->img_4) }}" class="card-img-top" alt="galery 4">
                                </div>
                                
                            </div>

                        

                    </div>

                </div>
            </div>
    </div>

@empty
    <li class="list-group-item">
        <p class="text-center">No ideas</p>
    </li>
    @endforelse
    {{-- <div>
            {{ $ideas->links() }}
        </div> --}}

    </div>
@endsection
