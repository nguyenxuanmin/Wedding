@extends('client.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
    @include('client.layout.breadcrumb')
    <div class="container">
        <h1>PRIVACY POLICY</h1>
        <p>Last updated: {{ now()->format('F d, Y') }}</p>

        <p>We value your privacy. This Privacy Policy explains how we collect, use, and protect your information when you use our website.</p>

        <h3>1. Information We Collect</h3>
        <ul>
            <li>Your name</li>
            <li>Your email address (if available)</li>
            <li>Your Facebook ID</li>
        </ul>

        <h3>2. How We Use Your Information</h3>
        <ul>
            <li>Authenticating your account</li>
            <li>Displaying your profile information</li>
            <li>Improving user experience</li>
        </ul>

        <p>We do NOT sell, trade, or share your personal information with third parties.</p>

        <h3>3. Data Protection</h3>
        <p>We take appropriate security measures to protect your personal data from unauthorized access, alteration, or disclosure.</p>

        <h3>4. Third-Party Services</h3>
        <p>Our website uses Facebook Login. By using this feature, you agree to Facebook’s Privacy Policy.</p>

        <h3>5. Your Rights</h3>
        <p>You have the right to request access, update, or delete your personal data at any time.</p>

        <h3>6. Contact</h3>
        <p>
            Email: <a href="mailto:nguyenanh.film93@gmail.com">nguyenanh.film93@gmail.com</a><br>
            Facebook: <a href="https://www.facebook.com/HLStore.net" target="_blank">https://www.facebook.com/HLStore.net</a><br>
            Website: <a href="https://sunsethoian.com" target="_blank">https://sunsethoian.com</a>
        </p>
    </div>
@endsection