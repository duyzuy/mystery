
<p>Dear Mystery Diner,</p>   
<p>Hear is your new password</p>
<p>Account: {{ $email_data['email'] }}</p>
<p>New Password: {{ $email_data['password'] }}</p>
<li>Click <a href="{{ route('user.login', $email_data['locale']) }}" target="_blank">here</a> to login</li>
<p>We wish you good experiences and relaxed moments at our restaurant.</p>
<br>
<p>Yours sincerely,</p>


<table>
    <tr>
        <tr><td>Mystery Diner Team</td></tr>
        <tr><td>Add: 8/58 Dinh Tien Hoang, Dakao Ward, D.1, HCMC. Vietnam</td></tr>
        <tr><td>Support: (+84) 934 660 327 </td></tr>
        <tr><td>(9am – 5pm from Monday to Friday)</td></tr>
        <tr><td>Fax: (+84) 8 3910 3089</td></tr>

</table>

<p><img src="{{ asset('images/email-footer.png') }}" width="320" alt="AFG Vietnam"></p>