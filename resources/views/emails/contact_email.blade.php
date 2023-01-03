<h2>Hello, {{ $receiver->name }}</h2>
<p>You received an email from : {{ $contact->name }} </p>
<p>Here are the details:</p>
<p><b>Name:</b> {{ $contact->name }}</p>
<p><b>Email:</b> {{ $contact->email }}</p>
<p><b>Phone Number:</b> {{ $contact->phone_number }} </p>
<p><b>Subject:</b> {{ $contact->subject }} </p>
<p><b>Message:</b> {{ $contact->user_message }} </p>
Thank You