@component('mail::message')
You have a new message.
@component('mail::table')

<tr>
    <th>Full Name:</th>
    <td>{{ $data['contact_name'] }}</td>
</tr>
<tr>
    <th>Email:</th>
    <td>{{ $data['contact_email'] }}</td>
</tr>
<tr>
    <th>Phone:</th>
    <td>{{ $data['contact_number'] }}</td>
</tr>
<tr>
    <th>Subject:</th>
    <td>{{ $data['contact_subject'] }}</td>
</tr>
<tr>
    <th>Message:</th>
    <td>{{ $data['contact_message'] }}</td>
</tr>

@endcomponent

@endcomponent