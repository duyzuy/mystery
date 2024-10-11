<p>Hello Admin,</p> 

<p>user was confirmed</p>
<p>Name: {{ $email_data['name'] }}</p>
<p>Email: {{ $email_data['email'] }}</p>
<p>City: {{ $email_data['store']->city->translate('en')->name }}</p>
<p>Brand: {{ $email_data['store']->brand->name }}</p>
<p>Restaurant: {{ $email_data['store']->translate('en')->store_name }}</p>

<p>Status: {{ $email_data['response'] }}</p>

