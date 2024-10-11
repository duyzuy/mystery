
<p>Chào anh/chị, </p>
<p>Đây là mật khẩu mới, vui lòng đăng nhập theo thông tin bên dưới</p>
<ul>
    <li>Tài khoản đăng nhập: {{ $email_data['email'] }}</li>
    <li>Mật khẩu đăng nhập: {{ $email_data['password'] }}</li>
    <li>Đăng nhập <a href="{{ route('user.login', $email_data['locale']) }}" target="_blank">tại đây</a></li>
</ul>
<p>Xin cảm ơn và chúc anh chị có một bữa ăn ngon miệng cùng những trải nghiệm thú vị tại nhà hàng.</p>
<p>Trân trọng,</p>
<table>
    <tr>
        <tr><td>Mystery Diner Team</td></tr>
        <tr><td>Add: 8/58 Dinh Tien Hoang, Dakao Ward, D.1, HCMC. Vietnam</td></tr>
        <tr><td>Support: (+84) 934 660 327 </td></tr>
        <tr><td>(9am – 5pm from Monday to Friday)</td></tr>
        <tr><td>Fax: (+84) 8 3910 3089</td></tr>

</table>

<p><img src="{{ asset('images/email-footer.png') }}" width="320" alt="AFG Vietnam"></p>