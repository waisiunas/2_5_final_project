@extends('partials.admin.layout')

@section('title', 'Topics')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="h3 mb-3">Topics</h1>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.topic.create') }}" class="btn btn-outline-primary">Add topic</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @include('partials.flash-messages')
                            @if (count($topics))
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Subject</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($topics as $topic)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $topic->subject->name }}</td>
                                                <td>{{ $topic->name }}</td>
                                                <td>{{ $topic->slug }}</td>
                                                <td>
                                                    <a href="{{ route('admin.topic.edit', $topic) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        onclick="deletetopic({{ $topic }})">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
