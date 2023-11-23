@extends('layouts.admin')

@section('title', 'Users')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Список всех пользователей</h5>

            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Birthdate</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Status</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">5</th>
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->birthday }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->is_online ? 'Online' : 'Offline' }}</td>
                        <td>{{ $user->getRoleNames() }}</td>
                        <td style="display: flex; gap: 10px">
                            <form action="{{ route('admin.users.delete', $user) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-primary">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- End Table with hoverable rows -->

        </div>

        <div class="card-body">
            <h5 class="card-title">Удаленные пользователи</h5>

            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Birthdate</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Status</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($onlyDeletedUsers as $user)
                    <tr>
                        <th scope="row">5</th>
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->birthday }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->is_online ? 'Online' : 'Offline' }}</td>
                        <td>{{ $user->getRoleNames() }}</td>
                        <td style="display: flex; gap: 10px">
                            <form action="{{ route('admin.users.restore', $user) }}" method="post">
                                @csrf
                                @method('POST')
                                <button class="btn btn-primary">Восстановить</button>
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
