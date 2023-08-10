@inject('role', 'App\Services\RolesService')
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $ideaCount }} ideas to fund</h1>
        <ul class="list-group list-group-flush">
            @forelse($ideas as $idea)
                @if ($idea->approved)
                    <div class="card border-success mb-2">
                        <div class="card-header bg-success text-center">
                            <h5 style="color: crimson" class="card-title">{{ $idea->user->name }}'s idea</h5>
                        </div>
                        <div class="card mb-3">
                            <div class="row g-0">

                                <div class="col-md-6">
                                    <img src="{{ asset($idea->main_image) }}" class="img-fluid rounded-start" alt="idea">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <p class="card-text">{{ $idea->description }}</p>
                                        <p class="card-text">Money I need: <b>{{ $idea->money_need }}</b> € </p>
                                        <p class="card-text">Money I have: <b>{{ $idea->money_got }} €</b></p>
                                        @if ($idea->money_need <= $idea->money_got)
                                            <p><b>I have reached my goal!!! THANK YOU!!!</b></p>
                                        @endif
                                        @if ($idea->money_need >= $idea->money_got)
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped" role="progressbar"
                                                    style="width: {{ ($idea->money_got / $idea->money_need) * 100 }}%;"
                                                    aria-valuenow="{{ $idea->money_got }}" aria-valuemin="0"
                                                    aria-valuemax="{{ $idea->money_need }}">
                                                    {{ round(($idea->money_got / $idea->money_need) * 100, 2) }}%
                                                </div>
                                            </div>
                                        @endif

                                        <div class="button-group">
                                            @if ($idea->money_need >= $idea->money_got)
                                                <a class="btn btn-success"
                                                    href="{{ route('ideas-donate', $idea) }}">Donate</a>
                                            @endif
                                            @auth
                                                <form action="{{ route('ideas-add-love', $idea) }}" method="post">
                                                    <button class="btn btn-danger bi bi-suit-heart-fill" type="submit">
                                                        <span class="badge bg-primary rounded-pill">{{ $idea->love }}</span>
                                                    </button>
                                                    @csrf
                                                </form>
                                            @endauth
                                        </div>

                                        <div class="add-tag">
                                            <div>
                                                <form action="{{ route('ideas-add-tag', $idea) }}" method="post">
                                                    <div class="input-group mb-2 mt-2">
                                                        <button class="btn btn-secondary" type="submit">Add tag from
                                                            list</button>
                                                        <select class="form-select" id="inputGroupSelect03"
                                                            aria-label="Example select with button addon" name="tag_id">
                                                            @foreach ($tags as $tag)
                                                                <option value="{{ $tag->id }}">
                                                                    {{ $tag->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @csrf
                                                </form>
                                            </div>

                                            <div>
                                                <form action="{{ route('ideas-create-tag', $idea) }}" method="post">
                                                    <div class="input-group mb-2">
                                                        <button class="btn btn-secondary" type="submit"
                                                            id="button-addon2">Create
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
                                        <span class="badge bg-primary">#{{ $tag->name }}</span>
                                    @endforeach
                                </div>

                                <div class="card-group">
                                    @if ($idea->img_1)
                                        <div class="card">
                                            <img src="{{ asset($idea->img_1) }}" class="card-img-top" alt="galery 1">
                                        </div>
                                    @endif
                                    @if ($idea->img_2)
                                        <div class="card">
                                            <img src="{{ asset($idea->img_2) }}" class="card-img-top" alt="galery 2">
                                        </div>
                                    @endif
                                    @if ($idea->img_3)
                                        <div class="card">
                                            <img src="{{ asset($idea->img_3) }}" class="card-img-top" alt="galery 3">
                                        </div>
                                    @endif
                                    @if ($idea->img_4)
                                        <div class="card">
                                            <img src="{{ asset($idea->img_4) }}" class="card-img-top" alt="galery 4">
                                        </div>
                                    @endif
                                </div>


                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <li class="list-group-item">
                    <p class="text-center">No approved ideas</p>
                </li>
            @endforelse
        </ul>

        <div class="footer">
            <nav>
                <ul class="pagination justify-content-center">
                    {{ $ideas->render() }}
                </ul>
            </nav>
            <div>
                <button type="button" class="btn btn-primary" id="btn-back-to-top">^</button>
            </div>
        </div>
    </div>

@endsection
