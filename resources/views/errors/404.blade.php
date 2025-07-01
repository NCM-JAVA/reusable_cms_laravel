
@extends('layouts.app')
@section('title', '404 - Page Not Found')
@section('content')
<title>@yield('title')</title>
<style>
 /* General Fullscreen Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    height: 100%;
    /* overflow: hidden; */
    /* overflow: auto; */
    overflow-x: hidden;
    font-family: 'Arial', sans-serif;
}

.error-page {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    /* height: 80vh; */
    /* background: linear-gradient(135deg, #4e54c8, #8f94fb); */
    background: #fff;
    color: #000000;
    position: relative;
}

/* Header Styles (Project Name) */
.error-header {
    width: 100%;
    padding: 20px 0;
    background-color: #1a202c;
    text-align: center;
    color: #000;
    font-size: 24px;
    font-weight: bold;
    box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.3);
}

/* 404 Content Styles */
.error-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding-bottom: 80px;
}

.error-code {
    font-size: 160px;
    font-weight: 800;
    color: #e53e3e; 
    text-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
}

.error-message {
    font-size: 28px;
    margin: 20px 0;
    /* color: rgba(255, 255, 255, 0.9); */
    color: #000;
    font-family: auto !important;
}

/* Button Styles */
.error-btn {
    padding: 14px 32px;
    font-size: 20px;
    font-weight: bold;
    color: #fff;
    background-color: #3182ce;
    border-radius: 30px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.error-btn:hover {
    background-color: #2b6cb0;
    transform: translateY(-3px);
    box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.2);
}

 /* Background Effects */
.error-page::before, .error-page::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    opacity: 0.15;
    filter: blur(120px);
    animation: float 10s infinite alternate ease-in-out;
}

.error-page::before {
    width: 450px;
    height: 450px;
    background-color: #f56565;
    top: 10%;
    left: -100px;
}

.error-page::after {
    width: 350px;
    height: 350px;
    background-color: #48bb78;
    bottom: 10%;
    right: -80px;
}

/* Animations */
@keyframes float {
    from {
        transform: translateY(0);
    }
    to {
        transform: translateY(-20px);
    }
}

 /* Responsive Design */
@media (max-width: 768px) {
    .error-header {
        font-size: 20px;
    }
    .error-code {
        font-size: 100px;
    }
    .error-message {
        font-size: 20px;
    }
    .error-btn {
        font-size: 16px;
        padding: 12px 24px;
    }
}


</style>

<!-- <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <h1 class="text-7xl font-bold text-red-500">404</h1>
    <p class="text-xl text-gray-700 mt-4">Oops! The page you are looking for could not be found.</p>
    <a href="{{ url('/') }}" class="mt-6 px-6 py-3 bg-blue-500 text-white text-lg rounded-lg hover:bg-blue-600 transition">
        Go Back to Home
    </a>
</div> -->

<div class="error-page">
    <!-- <header class="error-header">
        <h2 class="project-name">Department of Consumer Affairs</h2>
    </header> -->

    <div class="error-content">
        <h1 class="error-code">404</h1>
        <p class="error-message">Oops! The page you requested could not found.</p>
    </div>
</div>

@endsection
