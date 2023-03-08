@extends('partials.web-pages.layout')

@section('title', 'Home')

@section('content')

    <main>

        <div class="container marketing">
            <div class="row my-5">

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center">
                                <span class="badge bg-primary ">Question <span id="current">1</span> of <span
                                        id="total">{{ $total }}</span></span>
                            </h4>

                            <div id="msg"></div>

                            <h5>Q. {{ $question->text }}</h5>

                            @csrf
                            <ul class="list-group">
                                @foreach ($question->choices as $choice)
                                    <li class="list-group-item">
                                        <label class="d-block">
                                            <input class="with-gap" name="choice" value="{{ $choice->id }}"
                                                type="radio">
                                            <span>{{ $choice->text }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                            <button class="btn btn-primary mt-2" id="btn-submit">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h2>Live Evaluation</h2>
                        </div>
                    </div>
                </div>


            </div>

        </div><!-- /.container -->


        @include('partials.web-pages.footer')
    </main>

    <script>
        function toggle(id) {
            let correctElement = document.getElementById(id);
            correctElement.classList.toggle('d-none');
        }

        const btnSubmitElement = document.getElementById('btn-submit');
        btnSubmitElement.addEventListener('click', function() {
            const selectedElement = document.querySelector('input[name="choice"]:checked');
            const token = document.querySelector('input[name="_token"]').value;

            let selectedValue = selectedElement.value;

            if (selectedElement) {
                const data = {
                    choice_id: selectedValue,
                    _token: token,
                };

                fetch('{{ route('question.check') }}', {
                        method: 'POST',
                        body: JSON.stringify(data),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(result) {
                        if (result === true) {
                            console.log('Correct Choice');
                        } else {
                            console.log('Incorrect Choice');
                        }
                        // console.log(result);
                        // topicElement.innerHTML = result;
                    });
            } else {
                const msgElement = document.getElementById('msg');
                const alertElement =
                    `<div class="alert alert-danger alert-dismissible fade show" role="alert">Please select any choice!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
                msgElement.innerHTML = alertElement;
            }
        });
    </script>
@endsection
