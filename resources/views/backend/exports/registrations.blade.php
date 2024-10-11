<table class="table table-bordered">
    <thead>
     <tr>
        <th>ID</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Phone number</th>
        <th>Day of birth</th>
        <th>Register at</th>
        <th>Outlet</th> 
        <th>Restaurant Confirmed</th>
        <th>Time</th>
        <th>Status</th>
     </tr>
    </thead>
     <tbody>
       
         @foreach($data as $key => $d)
            @php 
                $numberRestaurant = count($d['user']->userRestaurents);
            
            @endphp

            <tr>
                <td rowspan="{{ $numberRestaurant == 1 ? $numberRestaurant : $numberRestaurant + 1 }}">{{ $d['user']->id }}</td>
                <td rowspan="{{ $numberRestaurant == 1 ? $numberRestaurant : $numberRestaurant + 1 }}">{{ $d['user']->name }}</td>
                <td rowspan="{{ $numberRestaurant == 1 ? $numberRestaurant : $numberRestaurant + 1 }}">{{ $d['user']->email }}</td>
                <td rowspan="{{ $numberRestaurant == 1 ? $numberRestaurant : $numberRestaurant + 1 }}">{{ $d['user']->phone_number }}</td>
                <td rowspan="{{ $numberRestaurant == 1 ? $numberRestaurant : $numberRestaurant + 1 }}">{{ $d['user']->day_of_birth }}</td>
                @if($numberRestaurant == 1)
                    @foreach($d['restaurants'] as $restaurant)
                        <td>{{ $restaurant['register_at'] }}</td>
                        <td>
                            @foreach($restaurant['stores'] as $store)
                                {{ $store->translate('en')->store_name }}
                            @endforeach
                        </td>
                        <td>
                            @foreach($restaurant['stores'] as $store)
                                @if($store->id == $restaurant['store_id'])
                                {{ $store->translate('en')->store_name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            {{ $restaurant['check_in'] }}
                        </td>
                        <td>
                            {{ $restaurant['response_status'] }}
                        </td>
                    @endforeach
                @endif
               
            </tr>
            @if($numberRestaurant > 1)
                @foreach($d['restaurants'] as $restaurant)
                    <tr>
                        <td>{{ $restaurant['register_at'] }}</td>
                        <td>
                            @foreach($restaurant['stores'] as $store)
                                {{ $store->translate('en')->store_name }}
                            @endforeach
                        </td>
                        <td>
                            @foreach($restaurant['stores'] as $store)
                                @if($store->id == $restaurant['store_id'])
                                {{ $store->translate('en')->store_name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            {{ $restaurant['check_in'] }}
                        </td>
                        <td>
                            {{ $restaurant['response_status'] }}
                        </td>
                    </tr>
                @endforeach
            @endif
         @endforeach
     </tbody>
 </table>