@if($email_data['response'] === 'accept')
    <p>Dear Mystery Diner,</p>
    
    <p>This is to confirm that we have noted your audit schedule as a Mystery Diner.</p>
    <p>Please do NOT order from Set Menu/Set lunch/or buffet to create a chance for server to give you introduction/suggestion on dishes.</p>
    <p>Please login the account below and go through the Questionnaire before dining and send us back the bill’s photo together and filled up Questionnaire within 24hrs after dining.</p>
    <ul>
        
        <li>Account: {{ $email_data['email'] }}</li>
        <li>Password: {{ $email_data['password'] }}</li>
        <li>Click <a href="{{ route('user.login', $email_data['locale']) }}" target="_blank">here</a> to login</li>
    </ul>
    <p>We wish you good experiences and relaxed moments at our restaurant.</p>
    <p>P/S: If you are unable to attend on the confirmed date, please notify us and choose another date and time. We will confirm as soon as possible the changes. Your login and password to complete the Mystery Diner survey is only valid according to the scheduled invitation time. It can be used during that time, if you have not received a confirmation from us.</p>
    <p>Note: In the process of completing the survey, if there is an error that does not save data, please follow the instruction below:</p>
    <ul>
        <li>Step 1: On <a href="https://guestsurvey.afg.vn/vi" target="_blank">https://guestsurvey.afg.vn/vi</a>, do a right click and select INSPECT</li>
        <li>Step 2: Go to TAB NETWORK, tick the box to select DISABLE CATCHE</li>
        <li>Step 3: Press F5 or Fn+F5</li>
        <li>Step 4: Do the survey again.</li>
    </ul> 
    <p>Yours sincerely,</p>
@else
    <p>Dear Mystery Diner,</p>   
    <p>Thank you for your reply. We will arrange an invitation to you in the coming times.</p>
    <br>
    <p>Yours sincerely,</p>

@endif

<table>
    <tr>
        <tr> <td>Mystery Diner Team</td></tr>
        <tr><td>Add: 8/58 Dinh Tien Hoang, Dakao Ward, D.1, HCMC. Vietnam</td></tr>
        <tr><td>Support: (+84) 934 660 327 </td></tr>
        <tr><td>(9am – 5pm from Monday to Friday)</td></tr>
        <tr><td>Fax: (+84) 8 3910 3089</td></tr>

</table>

<p><img src="{{ asset('images/email-footer.png') }}" width="320" alt="AFG Vietnam"></p>