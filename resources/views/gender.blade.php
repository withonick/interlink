<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/global-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/auth/style.css') }}">
    <link href='{{ asset('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css') }}' rel='stylesheet'>
    <script
        src="{{ asset('https://code.jquery.com/jquery-3.7.1.js') }}"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

</head>
<body @auth()>
<div class="mobile-container text-center" style="margin-top: 70px">
    <div class="skip-btn">
        <a href="#" style="text-align: right">Skip</a>
    </div>
    <form action="{{ route('gender.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="profile_detail_info">
            <h2>I am a</h2>


            <div class="custom-file-input">
                <label class="col-form-label">Gender</label>
                <select name="gender" class="form-control">
                    @foreach($genders as $gender)
                        <option value="{{ $gender->id }}" @if(\Illuminate\Support\Facades\Auth::user()->gender_id === $gender->id) selected @endif>
                            {{ $gender->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Continue</button>
            </div>
        </div>
    </form>
</div>

<script src="../js/script.js"></script>

</body @endauth>
</html>
