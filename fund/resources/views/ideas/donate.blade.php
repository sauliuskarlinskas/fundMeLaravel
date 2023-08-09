{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="post" action="{{ route('ideas-addmoney', $idea) }}">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset($idea->main_image) }}" class="card-img-top" alt="idea">
                        <div class="card-body">
                            <h4 class="card-title">Donate once, help many</h4>
                            <h6 class="card-text">Money I have: {{ $idea->money_got }} € </h6>
                            <label>Select an amount</label>
                            <div>
                                <button type="button" class="btn btn-outline-primary">10 €</button>
                                <button type="button" class="btn btn-outline-primary">20 €</button>
                                <button type="button" class="btn btn-outline-primary">50 €</button>
                                <button type="button" class="btn btn-outline-primary">100 €</button>
                            </div>

                            <label for="amount">Enter the amount, €</label>
                            <input name="amount" type="0" class="form-control">
                            <button type="submit" class="btn btn-success" name="add">Donate</button>
                            <a href="{{ url('/home') }}" class="btn btn-secondary">Not decided yet</a>

                        </div>
                    </div>
                    @method('put')
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="post" action="{{ route('ideas-addmoney', $idea) }}">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset($idea->main_image) }}" class="card-img-top" alt="idea">
                        <div class="card-body">
                            <h4 class="card-title">Donate once, help many</h4>
                            <h6 class="card-text">Money I need: {{ $idea->money_need }} € </h6>
                            <h6 class="card-text">Money I have: {{ $idea->money_got }} € </h6>
                            <label>Select an amount</label>
                            <div>
                                <button type="button" class="btn btn-outline-primary" onclick="updateAmount(10)">10
                                    €</button>
                                <button type="button" class="btn btn-outline-primary" onclick="updateAmount(20)">20
                                    €</button>
                                <button type="button" class="btn btn-outline-primary" onclick="updateAmount(50)">50
                                    €</button>
                                <button type="button" class="btn btn-outline-primary" onclick="updateAmount(100)">100
                                    €</button>
                            </div>

                            <label for="amount">Enter the amount, €</label>
                            <input name="amount" id="amount" type="number" min="0" class="form-control">
                            <div class="mt-2">
                                <button type="submit" class="btn btn-success" name="add">Donate</button>
                                <a href="{{ url('/home') }}" class="btn btn-secondary">Not decided yet</a>
                            </div>
                        </div>
                    </div>
                    @method('put')
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateAmount(amount) {
            document.getElementById('amount').value = amount;
        }
    </script>
@endsection
