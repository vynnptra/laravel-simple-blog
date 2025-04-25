<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 ">
    
    <x-navbar></x-navbar>
    <main class="max-w-7xl mx-auto px-6 pb-6 pt-20">
           @yield('content')
           
           <x-footer></x-footer>
    </main>
    
</html>