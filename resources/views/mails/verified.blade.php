Hello {{ $email_data['name'] }} <br>
Congratulations you are successfully actived <br>
Your account:  <br>
Email:  {{ $email_data['email'] }}<br>
password:  {{ $email_data['password'] }}<br>

<br>
<br>
login and answer the question by click the <a href="{{ $email_data['survey'] }}">servey</a>

<br>
<br>
Thank you!