<p>Dear Mr/Ms,</p> 

<p>Thank you for agreeing to assist us in our Mystery Diner program. I would like to welcome you as a Mystery Diner and hope the experience will be enjoyable for you as well as providing us with important information.</p>
<p>We would like you to visit “<strong>{{ $email_data['store']->translate('vi')->store_name }}, {{ $email_data['store']->translate('en')->store_address }} </strong>” before <strong style="color: red">{{ $email_data['check_in'] }}</strong>, please respond by 16:00 tomorrow if you are unable to visit, this will enable us to find another guest to attend.</p>
<p>Before visiting the restaurant, please read the questionnaire carefully, to familiarize yourself with the points that you will need to provide feedback on during your visit. Please DO NOT take the questionnaire with you to the restaurant. You can identify the restaurant manager, they will be in:</p>
<ul style="padding-left: 15px">
    <li>Alfresco's: <br>Female & Male: Black or White Shirt</li>
    <li>Pepperonis: <br>Female & Male: Black or White Shirt</li>
    <li>Jaspas: <br>Male & Female: White shirt or Blue shirt</li>
    <li>Papa Joes: <br>Male & Female: White shirt</li>                      
</ul>

<p><strong>When completing your questionnaire, please remember:</strong></p>

<p>1. Please make sure to note the name of the Manager and your staff member looking after you.</p>
<p>2. Any "NO" or "YES" answer MUST have comments in the boxes beside.</p>
<p>3. To fully score the section B in this Questionnaire, when you begin to open the menu, do not order immediately, please hold for few seconds to wait for the suggestion. Same manner when you nearly finish the food, wait for the suggestion of drinks/deserts.</p>
<p>4. The "Other comments" boxes in the end MUST be filled with your contributing opinions, suggestions, any other complaints.</p>
<p>5. Please take time to pass/use the restroom to score the General Service (section D).</p>
<p>6. Please order from the main menu’s in restaurants, not set menu’s or buffets.</p>
<p>After your restaurant visit please fill in the Questionnaire as much as possible.</p>
<p>The Questionnaire should be completed within 2 days of your visit and emailed to us via the email address below, together with the image of the bill. As agreed previously, we will reimburse you to the value of:</p>
<ul style="padding-left: 15px">
    <li>Jaspas: 700,000 VND (Seven Hundred Thousand Vietnam Dong)</li>
    <li>Alfresco’s: 600,000 VND (Six Hundred Thousand Vietnam Dong)</li>
    <li>Pepperoni’s: 400,000 VND (Four hundred thousand Vietnam Dong)</li>
    <li>Papa Joes: 400,000 VND (Four hundred thousand Vietnam Dong)</li>
</ul>

<p>We will re-imburse you in 15 days later, depending on when the information has been received.</p>
<p>If you have any questions, please contact us as soon as possible. Your help in this program is important to us and we want to make it as easy as possible for you.</p>
<p>We look forward to receiving the completed Questionnaire and we hope you enjoy the experience.</p>
<table>
    <tr align="right">
        <td><a href="{{ route( 'user.response.email', [$email_data['locale'], $email_data['token'], 'cancel'] ) }}" style="color: red; margin-right: 20px">Declined</a></td>
        <td><a href="{{ route( 'user.response.email', [$email_data['locale'], $email_data['token'], 'accept'] ) }}" style="color: Green;">Accepted</a></td>
    </tr>
</table>
<br>
<p>Thank you,</p>

<table>
    <tr><td>Mystery Diner Team</td></tr>
    <tr><td>Add: 8/58 Dinh Tien Hoang, Dakao Ward, D.1, HCMC. Vietnam</td></tr>
    <tr><td>Support: (+84) 934 660 327 </td></tr>
    <tr><td>(9am – 5pm from Monday to Friday)</td></tr> 
    <tr><td>Fax: (+84) 8 3910 3089</td></tr>  
</table>
<p><img src="{{ asset('images/email-footer.png') }}" width="320" alt="AFG Vietnam"></p>



 

 


 

 






