@extends('partials.admin.layout')

@section('title', 'Questions')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="h3 mb-3">Questions</h1>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.question.create') }}" class="btn btn-outline-primary">Add Question</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            @include('partials.flash-messages')
                            @if (count($questions))
                                @foreach ($questions as $question)
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    Subject: {{ $question->topic->subject->name }}
                                                </div>
                                                <div class="col-md-6">
                                                    Topic: {{ $question->topic->name }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body pb-0">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h5>Question: {{ $question->text }}</h5>
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="" class="btn btn-primary">Edit</a>
                                                    <a href="" class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <ol>
                                                        @foreach ($question->choices as $choice)
                                                        <li>
                                                            {{ $choice->text }} {{ $choice->is_correct == 1 ? "(Corrrect)" : "" }}
                                                        </li>
                                                        @endforeach

                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-danger">
                                    No record Found!
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function deletetopic(topic) {
            const deleteFormElement = document.getElementById('deleteForm');
            var url = "{{ route('admin.topic.delete', ':id') }}";
            url = url.replace(':id', topic.id);
            deleteFormElement.action = url;
        }
    </script>
@endsection
