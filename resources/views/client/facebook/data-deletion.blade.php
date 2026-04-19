@extends('client.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
    @include('client.layout.breadcrumb')
    <div class="container">
        <h1>USER DATA DELETION</h1>
        <p>Last updated: {{ now()->format('F d, Y') }}</p>

        <p>
            If you would like to delete your account and all associated data from our website, please follow the instructions below.
        </p>

        <h3>1. Request Data Deletion</h3>
        <p>
            You can request deletion of your personal data by contacting us via email. Please provide the following information:
        </p>
        <ul>
            <li>Your Facebook ID or registered email address</li>
            <li>A brief description of your request</li>
        </ul>

        <h3>2. Contact Information</h3>
        <p>
            Email: <a href="mailto:nguyenanh.film93@gmail.com">nguyenanh.film93@gmail.com</a><br>
            Facebook: <a href="https://www.facebook.com/HLStore.net" target="_blank">https://www.facebook.com/HLStore.net</a><br>
            Website: <a href="https://sunsethoian.com" target="_blank">https://sunsethoian.com</a>
        </p>

        <h3>3. Processing Time</h3>
        <p>
            We will process your request within 3-7 business days after receiving your request.
        </p>

        <h3>4. Data Removal</h3>
        <p>
            Once your request is verified, all your personal data will be permanently deleted from our system.
        </p>

        <h3>5. Additional Information</h3>
        <p>
            If you have any questions regarding data deletion, please contact us using the information above.
        </p>
    </div>
@endsection