<p>Chào Anh/Chị,</p> 

<p>Cám ơn Anh/Chị đã đồng ý tham gia Chương trình Khách hàng Thám tử của chúng tôi. Chương trình xin chào đón Anh/Chị như một khách hàng thám tử và hi vọng Anh/Chị sẽ có một bữa ăn ngon cùng những trải nghiệm thú vị. Chúng tôi cũng mong sẽ nhận được các phản hồi quý báu từ Anh/Chị để hệ thống nhà hàng của chúng tôi hoàn thiện hơn.</p>
<p>Chúng tôi trân trọng mời Anh/Chị đến dùng bữa tại: “<strong>{{ $email_data['store']->translate('vi')->store_name }}, {{ $email_data['store']->translate('vi')->store_address }}</strong>” trước <strong style="color: red">{{ $email_data['check_in'] }}</strong>, vui lòng nhẫn nút chọn cuối thư mời xác nhận tham gia hoặc từ chối, như vậy sẽ thuận tiện cho chúng tôi sắp xếp mời khách hàng khác trong khoảng thời gian mà Anh/Chị không tham gia được</p>
<p>Trước khi đến dùng bữa, Anh/Chị vui lòng đọc kỹ Bảng câu hỏi đính kèm để nắm bắt được các điểm chính mà Anh/Chị phải cho ý kiến trong cuộc khảo sát. Anh/Chị vui lòng KHÔNG mang theo Bảng câu hỏi đến nhà hàng. Anh/Chị có thể nhận diện người Quản lý nhà hàng qua đồng phục nhân viên,</p>
<ul style="padding-left: 15px">
    <li>Nhà hàng Alfresco’s: <br>Nam và nữ: Áo Đen hoặc Trắng</li>
    <li>Nhà hàng Pepperonis: <br>Nam và nữ : Áo Đen hoặc Trắng</li>
    <li>Nhà hàng Jaspas: <br>Nam và nữ: Áo Trắng hoặc Xanh</li>
    <li>Nhà hàng Papa Joes: <br>Nam và nữ: Áo Đen hoặc Trắng</li>                      
</ul>

<p><strong>Trong trả lời Bảng câu hỏi, xin Anh/Chị vui lòng lưu ý những điều sau:</strong></p>

<p>1. Vui lòng ghi lại tên của Quản lý nhà hàng và tên nhân viên phục vụ bữa ăn của Anh/Chị.</p>
<p>2. Với câu trả lời “NO” hoặc "YES", anh chị vui lòng điền lý do vào ô bên cạnh câu trả lời.</p>
<p>3. Để việc chấm điểm được phần B của Bảng câu hỏi được chính xác, khi xem menu, Anh/Chị vui lòng chờ trong vài giây để nhân viên có thể đưa ra gợi ý món ăn. Anh/Chị vui lòng thực hiện tương tự khi dùng xong món chính, chờ nhân viên gợi ý thức uống/món tráng miệng.</p>
<p>4. Với mục “Ý kiến khác” ở phần cuối cùng của bản câu hỏi, Anh/Chị PHẢI có ý kiến đóng góp, các đề xuất, cũng như các than phiền nếu có.</p>
<p>5. Anh/Chị vui lòng dành ít thời gian để xem qua khu vực nhà vệ sinh của nhà hàng để có thể cho điểm hạng mục Dịch vụ chung (mục D).</p>
<p>Sau khi dùng bữa, Anh/Chị vui lòng hoàn tất Bảng câu hỏi khảo sát với càng nhiều thông tin càng tốt.</p>
<p>Anh/Chị vui lòng hoàn tất Bảng khảo sát trong vòng 2 ngày sau khi dùng bữa và gởi đến cho chúng tôi cùng với hình chụp hóa đơn dùng bữa qua địa chỉ email bên dưới đây. Như đã thỏa thuận trước đó, chúng tôi sẽ thanh toán lại chi phí dùng bữa:</p>
<ul style="padding-left: 15px">
    <li>Nhà hàng Jaspas: 700.000đ (Bảy trăm ngàn đồng)</li>
    <li>Nhà hàng Alfresco’s: 600.000đ (Sáu trăm ngàn đồng)</li>
    <li>Nhà hàng Pepperonis: 400.000đ (Bốn trăm ngàn đồng)</li>
    <li>Nhà hàng Papa Joes: 400.000đ (Bốn trăm ngàn đồng)</li>
</ul>

<p>Chúng tôi sẽ thanh toán tiền sau 15 ngày, tùy theo thời gian mà chúng tôi nhận được thông tin từ Anh/Chị.</p>
<p>Nếu Anh/Chị có bất kỳ câu hỏi nào về chương trình, xin vui lòng liên hệ ngay với chúng tôi. Sự giúp đỡ của Anh/Chị trong chương trình này rất quan trọng đối với chúng tôi và chúng tôi cũng mong muốn tạo sự thoải mái cho các Anh/Chị khi tham gia chương trình này.</p>
<p>Chúng tôi rất mong nhận được Bảng câu hỏi được hoàn tất từ phía các Anh/Chị và chúc các Anh/Chị có bữa tối vui vẻ tại nhà hàng của chúng tôi.</p>
<table>
    <tr align="right">
        <td><a href="{{ route( 'user.response.email', [$email_data['locale'], $email_data['token'], 'cancel'] ) }}" style="color: red; margin-right: 20px">Không, Tôi không muốn tham gia</a></td>
        <td><a href="{{ route( 'user.response.email', [$email_data['locale'], $email_data['token'], 'accept'] ) }}" style="color: Green;">Tôi đồng ý tham gia</a></td>
    </tr>
</table>
<br>
<p>Trân trọng,</p>

<table>
    <tr><td>Mystery Dine Team</td></tr>
    <tr><td>Địa chỉ: 8/58 Dinh Tien Hoang, Dakao Ward, D.1, HCMC. Vietnam</td></tr>
    <tr><td>Support: (+84) 934 660 327 </td></tr>  
    <tr><td>(9am – 5pm from Monday to Friday)</td></tr> 
    <tr><td>Fax: (+84) 8 3910 3089</td></tr>  
</table>
<p><img src="{{ asset('images/email-footer.png') }}" width="320" alt="AFG Vietnam"></p>


