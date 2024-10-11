@if($email_data['response'] === 'accept')
    <p>Chào anh/chị, </p>
    
    <p>Chúng tôi xin xác nhận lịch dùng bữa khảo sát cho anh/chị.</p>
    <p>Xin KHÔNG chọn thức ăn trong Set lunch/Set Menu/Buffet để tạo cơ hội gợi ý cho nhân viên và đánh giá đầy đủ các bước phục vụ.</p>
    <p>Anh/chị vui lòng đăng nhập vào tài khoản bên dưới và xem qua Bản khảo sát trước khi dùng bữa để nắm được nội dung cần khảo sát và gửi lại hình ảnh hóa đơn kèm bản khảo sát trong vòng 2 ngày sau khi dùng bữa.</p>
   
    <ul>
        <li>Tài khoản đăng nhập: {{ $email_data['email'] }}</li>
        <li>Mật khẩu đăng nhập: {{ $email_data['password'] }}</li>
        <li>Đăng nhập <a href="{{ route('user.login', $email_data['locale']) }}" target="_blank">tại đây</a></li>
    </ul>
    <p>Xin cảm ơn và chúc anh chị có một bữa ăn ngon miệng cùng những trải nghiệm thú vị tại nhà hàng.</p>
    <p>P/S: Trong trường hợp anh/chị có việc đột xuất không tham gia được vào ngày đã xác nhận, anh/chị có thể chọn thời gian khác nằm trong khung thời gian do chương trình nêu ra trong thư mời để tiến hành khảo sát (vẫn hợp lệ nếu chúng tôi không xác nhận kịp khi anh/chị muốn thay đổi vào thời gian cuối tuần).</p>
    <p>Lưu ý: Trong quá trình hoàn thành bảng khảo sát, nếu phát sinh lỗi không lưu dữ liệu, anh/chị vui lòng thực hiện theo hướng dẫn:</p>
    <ul>
        <li>Bước 1: Tại trang <a href="https://guestsurvey.afg.vn/vi" target="_blank">https://guestsurvey.afg.vn/vi</a>  nhấp chuột phải chọn KIỂM TRA/INSPECT </li>
        <li>Bước 2: Vào TAB NETWORK, tick chọn DISABLE CACHE </li>
        <li>Bước 3: Nhấn nút F5 hoặc Fn+F5 để tải lại trang</li>
        <li>Bước 4: Thực hiện lại khảo sát</li>
    </ul>
    <p>Trân trọng,</p>
@else
    <p>Chào Anh/Chị,</p>   
    <p>Chương trình xin cảm ơn phản hồi của anh/chị.</p>
    <p>Chúng tôi sẽ sắp xếp gửi thư mời đến anh/chị trong các đợt sắp tới.</p>
    <br>
    <p>Trân trọng.</p>
@endif
<table>
    <tr>
        <tr> <td>Mystery Diner Team</td></tr>
        <tr><td>Địa chỉ: 8/58 Dinh Tien Hoang, Dakao Ward, D.1, HCMC. Vietnam</td></tr>
        <tr><td>Support: (+84) 934 660 327 </td></tr>
        <tr><td>(9am – 5pm from Monday to Friday)</td></tr>
        <tr><td>Fax: (+84) 8 3910 3089</td></tr>

</table>

<p><img src="{{ asset('images/email-footer.png') }}" width="320" alt="AFG Vietnam"></p>