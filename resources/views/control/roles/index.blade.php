@extends('layouts.admin')

@section('title', 'Roles')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Список всех ролей</h5>

            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <th scope="row">5</th>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a href="{{ route('admin.roles.permissions', $role->id) }}" class="btn btn-primary">Разрешении</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- End Table with hoverable rows -->

        </div>
    </div>

@endsection
