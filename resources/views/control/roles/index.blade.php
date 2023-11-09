@extends('layouts.admin')

@section('title', 'Roles')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Список всех ролей</h5>

            <div class="mb-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRole">
                    Добавить роль
                </button>

                <div class="modal fade" id="createRole" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Добавить роль</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.roles.add') }}" method="post">
                                @csrf
                                @method('post')
                            <div class="modal-body">
                                <div class="mt-2">
                                    <input class="form-control" type="text" placeholder="Название роли" name="name">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Permissions</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <th scope="row">{{ $role->id }}</th>
                        <td>{{ $role->name }}</td>
                        <td>{{ count($role->permissions) }}</td>
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
