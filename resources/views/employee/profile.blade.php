
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Profile</h1>
        @if ($emp->image)
        <img src="{{ asset('storage/' .$emp->image) }}" alt="Profile Image" style="width: 300px; height: 300px;">
        @else
        <p>ไม่มีรูปภาพ</p>
    @endif
    
        <form method="POST" action="{{ route('profile.update', ['user' => $emp->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('POST')


                
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ $emp->name }}" required>

            <label for="lname">Last Name:</label>
            <input type="text" name="lname" value="{{ $emp->lname }}" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ $emp->email }}" required>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" value="{{ $emp->phone }}" required>

            <label for="address">Address:</label>
            <textarea name="address" required>{{ $emp->address }}</textarea>

            <label for="birthday">Birthday:</label>
            <input type="date" name="birthday" value="{{ $emp->birthday }}" required>

            <label for="image">Profile Image:</label>
            <input type="file" name="image">

            <button type="submit">save changes</button>

        </form>
    </div>
@endsection


