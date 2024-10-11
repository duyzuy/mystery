<table>
    <tr>
        <td>Region:</td>
        <td>{{ $region }}</td>
    </tr>
    <tr>
        <td>Brand:</td>
        <td>{{ $brand }}</td>
    </tr>
    <tr>
        <td>Restaurant:</td>
        <td>{{ $restaurant }}</td>
    </tr>
    <tr>
        <td>Date From:</td>
        <td>{{ $dateFrom }}</td>
    </tr>
    <tr>
        <td>Date To:</td>
        <td>{{ $dateTo }}</td>
    </tr>
    <tr>
        <td>Answer Type:</td>
        <td>{{ $answerType }}</td>
    </tr>
</table>

<table>
    <thead>
      <tr>
        <th>Top</th>
        <th>Question Number</th>
        <th>Question Name</th>
        <th>Count</th>
      </tr>
    </thead>
    <tbody>
        @foreach($questions as $key => $question)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $question->id }}</td>
            <td>{{ $question->translate('en')->question }}</td>
            <td>{{ $question->resSum }}</td>
        </tr>
        @endforeach
    </tbody>
</table>