@extends('layouts.admin')

@section('title', 'Users')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Список запросов на подтверждение</h5>

            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Username</th>
                    <th scope="col">Profession</th>
                    <th scope="col">Article Links</th>
                    <th scope="col">File</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($verifications as $req)
                    <tr>
                        <th scope="row">5</th>
                        <td>{{ $req->fullname }}</td>
                        <td>{{ $req->user->username }}</td>
                        <td>{{ $req->profession }}</td>
                        <td><a href="{{ $req->article_link }}">{{ $req->article_link }}</a></td>
                        <td><a href="{{ $req->getFirstMediaUrl('verification_files') }}">{{ $req->getFirstMediaUrl('verification_files') }}</a></td>
                        <td style="display: flex; gap: 10px">
                            <form action="{{ route('admin.verifications.accept', $req->user->username) }}" method="post">
                                @csrf
                                @method('post')
                                <button class="btn btn-primary">Принять</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- End Table with hoverable rows -->

        </div>
    </div>

@endsection
