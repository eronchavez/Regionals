<x-user.layout>
    <form action="{{ url('/profile/update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

      
        <h2>Edit</h2>

        <label for="name">Name: </label>
        <input type="text" name="name" value="{{ Auth::user()->name }}">
        @error('name')
            <p>{{$message}}</p>
        @enderror

        <label for="avater">Avatar: </label>
        <input type="file" name="avatar">
          @error('avatar')
            <p>{{$message}}</p>
        @enderror

        <label for="username">Username: </label>
        <input type="text" name="username" value="{{ Auth::user()->username }}">
          @error('username')
            <p>{{$message}}</p>
        @enderror

        <label for="password">Password</label>
        <input type="password" name="password">
          @error('password')
            <p>{{$message}}</p>
        @enderror

        <input type="submit" value="Update">
    </form>


    <form action="{{ url('/profile/removeAvatar') }}" method="POST">
        @csrf
        @method('PUT')

        <h2>Remove Avatar</h2>

        <input type="submit" value="Remove Avatar">
    </form>
   

</x-user.layout>