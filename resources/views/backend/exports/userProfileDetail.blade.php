<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Phone number</th>
            <th>Register at</th>
            <th>Outlet</th>
            <th>Restaurant Confirmed</th>
            <th>Time</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @php 
            $number_register = count($storeRegistrations);
            $number_register = $number_register + 1;
        @endphp
        <tr>
            <td rowspan="{{ $number_register }}">{{ $user->id }}</td>
            <td rowspan="{{ $number_register }}">{{ $user->name }}</td>
            <td rowspan="{{ $number_register }}">{{ $user->email }}</td>
            <td rowspan="{{ $number_register }}">{{ $user->phone_number }}</td>
      
        </tr>
        @foreach($storeRegistrations as $key => $registration)
        <tr>
            <td>{{ $registration['register_at'] }}</td>
            <td>
                @foreach($registration['stores'] as $s => $store)
                    {{ $store->translate('en')->store_name }}
                    @if($s >= 1)
                        {{ '/n' }}
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($registration['stores'] as $s => $store)
                    @if($registration['store_id'] == $store->id)
                        {{ $store->translate('en')->store_name }}
                    @endif
                @endforeach
            </td>
            <td>
                {{ $registration['check_in'] }}
            </td>
            <td>{{ $registration['response_status'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>