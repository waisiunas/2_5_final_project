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

                            <h5 id="question">Q. {{ $question->text }}</h5>

                            @csrf
                            <ul class="list-group">
                                @foreach ($question->choices as $choice)
                                    <li class="list-group-item">
                                        <label class="d-block">
                                            <input class="with-gap" name="choice" value="{{ $choice->id }}"
                                                type="radio">
                                            <span id="choice_{{ $loop->iteration }}">{{ $choice->text }}</span>
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
                            <ol id="list">
                            </ol>
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
        const questionElement = document.getElementById('question');
        const choiceOneElement = document.getElementById('choice_1');
        const choiceTwoElement = document.getElementById('choice_2');
        const choiceThreeElement = document.getElementById('choice_3');
        const choiceFourElement = document.getElementById('choice_4');
        currentQuestion = 1;
        btnSubmitElement.addEventListener('click', function() {
            const selectedElement = document.querySelector('input[name="choice"]:checked');
            const tokenElement = document.querySelector('input[name="_token"]');
            const token = tokenElement.value;

            let selectedValue = '';
            if (selectedElement) {
                selectedValue = selectedElement.value;
            }

            if (selectedElement) {
                const data = {
                    choice_id: selectedValue,
                    currentQuestion: currentQuestion,
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
                        tokenElement.value = result['new_token'];
                        currentQuestion++;
                        const listElement = document.getElementById('list');
                        if (result.status == 'Correct') {
                            listElement.innerHTML += '<li class="text-success">Correct</li>';
                        } else {
                            listElement.innerHTML += '<li class="text-danger">Incorrect</li>';
                        }
                        questionElement.innerText = 'Q. ' + result.next_question.text;
                        console.log(result);
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
