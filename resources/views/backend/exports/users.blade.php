<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Bank name</th>
        <th>Card number</th>
        <th>Bank address</th>
        <th>Status</th>
        <th>Register day</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone_number }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->bank_name }}</td>
            <td>{{ $user->bank_number }}</td>
            <td>{{ $user->bank_address }}</td>
            <td>
                @if($user->actived == 1)
                    actived
                @else
                    unactive
                @endif
            </td>
            <td>{{ date('M j, Y h:ia', strtotime($user->created_at))  }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
