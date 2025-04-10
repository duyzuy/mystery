<table>
    <thead>
      <tr>
        <th>STT</th>
        <th>Tên khách</th>
        <th>Email</th>
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
            <td>{{ $survey->user->email }}</td>
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