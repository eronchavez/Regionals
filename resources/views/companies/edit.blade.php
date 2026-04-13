<x-layout>

    <h2>Edit Company</h2>

    <form action="{{ url('/companies/' . $company->id ) }}" method="POST">
        @csrf
        @method('PUT')

         <div>
            <label for="name">Company Name</label>
            <input type="text" name="name">
                @error('name')
                    <p>{{$message}}</p>
                @enderror
        </div>

        <div>
            <label for="address">Company Address</label>
            <input type="text" name="address">
                @error('address')
                    <p>{{$message}}</p>
                @enderror
        </div>

        <div>
            <label for="telephone">Company telephone</label>
            <input type="text" name="telephone">
                @error('telephone')
                    <p>{{$message}}</p>
                @enderror
        </div>

        <div>
            <label for="email">Company email</label>
            <input type="text" name="email">
               @error('email')
                    <p>{{$message}}</p>
                @enderror
        </div>

          <div>
            <label for="owner_name">Owner Name</label>
            <input type="text" name="owner_name">
               @error('owner_name')
                    <p>{{$message}}</p>
                @enderror
        </div>

          <div>
            <label for="owner_mobile">Owner Mobile</label>
            <input type="text" name="owner_mobile">
               @error('owner_mobile')
                    <p>{{$message}}</p>
                @enderror
        </div>

        <div>
            <label for="owner_email">Owner Email</label>
            <input type="text" name="owner_email">
               @error('owner_email')
                    <p>{{$message}}</p>
                @enderror
        </div>

         <div>
            <label for="contact_name">Contact Name</label>
            <input type="text" name="contact_name">
               @error('contact_name')
                    <p>{{$message}}</p>
                @enderror
        </div>

          <div>
            <label for="contact_mobile">Contact Mobile</label>
            <input type="text" name="contact_mobile">
               @error('contact_mobile')
                    <p>{{$message}}</p>
                @enderror
        </div>

        <div>
            <label for="contact_email">Contact Email</label>
            <input type="text" name="contact_email">
               @error('contact_email')
                    <p>{{$message}}</p>
                @enderror
        </div>

        <input type="submit">
    </form>
    </form>
</x-layout>