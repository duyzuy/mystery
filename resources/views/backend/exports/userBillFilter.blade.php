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
</table>

<table>
    <thead>
      <tr>
        <th>STT</th>
        <th>Tên khách</th>
        <th>Số TK</th>
        <th>Tên Ngân hàng</th>
        <th>Chi Nhánh</th>
        <th>Mã hoá đơn</th>
        <th>Số điện thoại</th>
        <th>Người thụ hưởng</th>
      </tr>
    </thead>
    <tbody>
        @foreach($surveys as $key => $survey)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $survey->user->name }}</td>
            <td>{{ $survey->bank_number }}</td>
            <td>{{ $survey->bank_name }}</td>
            <td>{{ $survey->bank_address }}</td>
            <td>{{ $survey->receipt_number }}</td>
            <td>{{ $survey->user->phone_number }}</td>
            <td>{{ $survey->beneficiary }}</td>
        </tr>
        @endforeach
    </tbody>
</table>