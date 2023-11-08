@extends('layouts.admin')

    @section('title', $role->name . ' permissions')

@section('content')

    <div class="card p-5">
        <h3>Разрешении {{ $role->name }}</h3>

        <div class="mt-4">
            <h4>Все разрешении</h4>
        </div>

        <div class="mt-2">

                @forelse($role->permissions as $per)
                    <span>{{ $per->name }}</span>
            @empty
                    <div class="mt-4">
                        <span>Пока нет разрешении</span>
                    </div>
                @endforelse
        </div>
        <div class="mt-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Добавить</button>
        </div>
    </div>

    <div class="modal fade" id="verticalycentered" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить разрешение</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.roles.permissions.add', $role->id) }}" method="post">
                    @csrf
                    @method('POST')
                <div class="modal-body">
                    <select name="permission" class="form-control">
                        @foreach($permissions as $permission)
                            <option value="{{ $permission->name }}">{{ $permission->value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
