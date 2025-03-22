<x-guest-layout>
<div >
    <h1 id="h_ad">Админ панель </h1>
    <form id="form_ad" method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div>
            
            <input type="email" name="email" id="email" placeholder="Почта"  required>
        </div>
        <br>
        <div>
            
            <input type="password" name="password" id="password" placeholder="Пароль"  required>
        </div>
        <br>
        <div>
            <button id="btn_ad" type="submit">Войти</button>
        </div>
    </form>
</div>

<footer id="footer_ad">
    <hr>
    2025г
</footer>

</x-guest-layout>
