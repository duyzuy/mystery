<table>
    <thead>
        <tr>
            <th>Question id</th>
            <th>Question name</th>
            <th>Number by {{ $filter }}</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($questions as $key => $question)
            <tr>
                <td>{{ $question->id }}</td>
                <td>{{ $question->translate('en')->question }}</td>
                <td>{{ $question->resSum }}</td>
            </tr>
        @endforeach
    </tbody>
</table>