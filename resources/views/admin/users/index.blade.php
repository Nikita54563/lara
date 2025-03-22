
<x-guest-layout>
<div  id="form_user">


    
    <h1>Пользователи</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Почта</th>
                <th>Админ</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? 'Да' : 'Нет' }}</td>
                    <td>
                        <!-- Кнопка удаления -->
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этого пользователя?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a  id="aa" href='{{route('admin.users.create')}}'>Создать нового пользователя</a> <br>
    <form  id="btn_form" method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button id="btn_adn" type="submit">Выйти</button>
    </form>
</div>
<footer id="footer_ad">
    <hr>
    2025г
</footer>
</x-guest-layout>
