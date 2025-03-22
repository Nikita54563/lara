<x-guest-layout>
<div id="form_user">
    <h1>Создание нового пользователя</h1>

    <form  id="form_ads" method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div>
           
            <input  placeholder="ФИО" type="text" name="name" id="name" value="{{ old('name') }}" required>
        </div>

        <div>
            
            <input placeholder="Почта" type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="password"></label>
            <input placeholder="Пароль" type="password" name="password" id="password" required>
        </div>

        <div>
          
            <input placeholder="Подтверждение пароля" type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
       
        <div>
            <button id="btn_usr" type="submit">Создать пользователя</button>
        </div>
    </form>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>

</x-guest-layout>