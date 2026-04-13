<x-user.layout>
    <form action="{{ url('/userRegister') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Register</h2>

        <label for="name">Name: </label>
        <input type="text" name="name">
        @error('name')
            <p>{{$message}}</p>
        @enderror

        <label for="avater">Avatar: </label>
        <input type="file" name="avatar">
          @error('avatar')
            <p>{{$message}}</p>
        @enderror

        <label for="username">Username: </label>
        <input type="text" name="username">
          @error('username')
            <p>{{$message}}</p>
        @enderror

        <label for="password">Password</label>
        <input type="password" name="password" id="registerPassword">

        <button class="toggledBtn" type="button" onclick="togglePassword('registerPassword', this)">Show Password</button>
          @error('password')
            <p>{{$message}}</p>
        @enderror

        <input type="submit" value="Register">
    </form>

   <form action="{{ url('/userLogin') }}" method="POST">
        @csrf
        <h2>Log In</h2>

        <label for="username">Username: </label>
        <input type="text" name="username">
        @error('usernameLogin')
            <p>{{$message}}</p>
        @enderror


        <label for="password">Password</label>
        <input type="password" name="password" id="loginPassword">
         <button type='button' class="toggledBtn" onclick="togglePassword('loginPassword', this)">Show Password</button>
        @error('passwordLogin')
            <p>{{$message}}</p>
        @enderror

        <input type="submit" value="Log In">
    </form>

    <script>

        function togglePassword(inputId,btn)
        {
           
            const input = document.getElementById(inputId);
            
            if(input.type === 'password')
                {
                    input.type = 'text';
                    btn.textContent = 'Hide Password';
                }
            else 
            {
                input.type = 'password';
                btn.textContent = 'Show Password';
            }
            
        }

    </script>

</x-user.layout>