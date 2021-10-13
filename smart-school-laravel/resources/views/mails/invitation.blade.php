@component('mail::message')
    @include('vendor.mail.sunny.contentStart')
    <h2>Invitation to {{ $school->school_name }}</h2>
    <p>Hello {{ $user->name }}! You have been invited by {{ $school->school_name }} at
        <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>
        . This is your login credential.
    </p>
    <table class="table" style="width: 100%; margin-bottom: 2rem;">
        <tr>
            <th style="text-align: left !important;">Username</th>
            <th style="text-align: left !important;">Password</th>
            <th style="text-align: left !important;">School ID</th>
            <th style="text-align: left !important;">Email</th>
        </tr>
        <tr>
            <td>{{ $user->username }}</td>
            <td>{{ $password }}</td>
            <td>{{ $user->school_id }}</td>
            <td>{{ $user->email }}</td>
        </tr>
    </table>
    <p>Thank you.</p>
    @include('vendor.mail.sunny.contentEnd')
    @include('vendor.mail.sunny.button', ['title' => 'Open Login Page','link' => config('app.url').'/login'])
@endcomponent
