<table>
    <thead>
    <tr>
        <th>Тема</th>
        <th>Сообщение</th>
        <th>Имя клиента</th>
        <th>Почта клиента</th>
        <th>Ссылка на файл</th>
        <th>Время создания</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $feedback->title }}</td>
            <td>{{ $feedback->description }}</td>
            <td>{{ $feedback->user->name }}</td>
            <td>{{ $feedback->user->email }}</td>
            <td>
                @if($feedback->file)
                    <a href="{{ asset('storage/' . $feedback->file) }}">Скачать файл</a>
                @endif
            </td>
            <td>{{ $feedback->created_at }}</td>
        </tr>
    </tbody>
</table>
