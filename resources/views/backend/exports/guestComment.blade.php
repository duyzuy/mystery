<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>#ID</th>
        <th>Date</th>
        <th>Store Name</th>
        <th>Code</th>
        <th>Point</th>
        <th>Comment</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        @if(count($surveys) != 0)
            @php $count = count($surveys); @endphp
            @foreach($surveys as $survey)
            <tr>
                <td>{{ $count }}</td>
                <td>{{ date('M j, Y', strtotime($survey->created_at)) }}</td>
                <td>{{ $survey->store->translate('en')->store_name }}</td>
                <td>{{ $survey->store->code }}</td>
                <td>{{ $survey->total_point }}</td>
                <td>{{ html_entity_decode($survey->feedback)  }}</td>
            </tr>
            @php $count --;@endphp
            @endforeach
        @else
            <tr>
                <td colspan="5" align="center">No result</td>
            </tr>
        @endif
    </tbody>
  </table>