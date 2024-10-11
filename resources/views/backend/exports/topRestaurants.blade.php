<table>
    <tr>
        <td>Top Restaurant say</td>
        <td>{{ $answerType }}</td>
    </tr>
    <tr>
        <td>From</td>
        <td>{{ $dateFrom }}</td>
    </tr>
    <tr>
        <td>To</td>
        <td>{{ $dateTo }}</td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <td>Top</td>
            <td>Restaurant Name</td>
            <td>Count</td>
        </tr>
    </thead>
    <tbody>
        @foreach($restaurants as $key => $restaurant)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $restaurant->translate('en')->store_name }}</td>
                <td>{{ $restaurant->resSum  }}</td>
            </tr>
        @endforeach
    </tbody>
</table>