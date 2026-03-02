@extends('layouts.app')

@section('title', 'My Profile')

@section('breadcrumb')
    Home &rsaquo; Account / Profile
@endsection

@section('page-title', 'Account Information')

@section('content')

    <p><em>This page is read-only. Contact your administrator to update your information.</em></p>

    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>ID</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Employee ID</th>
            <td>{{ $user->employee_id }}</td>
        </tr>
        <tr>
            <th>First Name</th>
            <td>{{ $user->first_name }}</td>
        </tr>
        <tr>
            <th>Middle Name</th>
            <td>{{ $user->middle_name }}</td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td>{{ $user->last_name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Username</th>
            <td>{{ $user->username }}</td>
        </tr>
        <tr>
            <th>Designation / Position</th>
            <td>{{ $user->designation }}</td>
        </tr>
        <tr>
            <th>Office / Department / Division</th>
            <td>
                @if($user->office)
                    [{{ $user->office->office_code }}] {{ $user->office->name }}
                @else
                    &mdash;
                @endif
            </td>
        </tr>
        <tr>
            <th>Account Role</th>
            <td>
                @if($user->accountRole)
                    [{{ $user->accountRole->role_code }}] {{ $user->accountRole->name }}
                @else
                    &mdash;
                @endif
            </td>
        </tr>
        <tr>
            <th>Member Since</th>
            <td>{{ $user->created_at->format('F d, Y h:i A') }}</td>
        </tr>
        <tr>
            <th>Last Updated</th>
            <td>{{ $user->updated_at->format('F d, Y h:i A') }}</td>
        </tr>
    </table>

@endsection