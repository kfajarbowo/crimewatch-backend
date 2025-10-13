@php
    
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrimeWatch - Admin</title>
    @vite(['resources/css/app.css'])
    
    <!-- Red Colors CSS -->
    <link href="{{ asset('css/red-colors.css') }}" rel="stylesheet">
    <style>
        body, html {
            overflow-x: hidden;
            max-width: 100%;
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Custom styling untuk partial visibility */
        .tiktok-slide {
            scroll-snap-align: start;
            margin-right: 12px;
        }

        .tiktok-slide:last-child {
            margin-right: 0;
        }

        /* TikTok Slider Navigation Arrows */
        #tiktok-prev, #tiktok-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 10;
            transition: background 0.3s ease;
            display: none;
        }

        #tiktok-prev:hover, #tiktok-next:hover {
            background: rgba(0, 0, 0, 0.7);
        }

        #tiktok-prev {
            left: 10px;
        }

        #tiktok-next {
            right: 10px;
        }

        @media (max-width: 640px) {
            #tiktok-prev, #tiktok-next {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        /* Featured News Slider Styles */
        .featured-slider-container {
            position: relative;
        }

        .featured-slider-wrapper {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .featured-slide {
            flex: 0 0 100%;
            scroll-snap-align: start;
        }

        .featured-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 10;
            transition: background 0.3s ease;
        }

        .featured-nav:hover {
            background: rgba(0, 0, 0, 0.7);
        }

        .featured-prev {
            left: 15px;
        }

        .featured-next {
            right: 15px;
        }

        @media (min-width: 641px) {
            #tiktok-prev, #tiktok-next {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .featured-nav {
                display: none;
            }
        }

        .featured-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 10;
        }

        .featured-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .featured-dot.active {
            background: #dc2626;
        }

        /* TikTok Embed Styles */
        .tiktok-embed-container {
            width: 100%;
            height: 100%;
            border-radius: 8px;
            overflow: hidden;
        }

        .tiktok-embed-container iframe {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 8px;
        }

        .tiktok-fallback {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #000;
            color: white;
            height: 100%;
            text-align: center;
            padding: 20px;
            border-radius: 8px;
        }
    </style>
</head>
<body class="bg-gray-50">
    @include('backend.partials.header')
    
    @yield('content')
    
    @include('backend.partials.footer')

    <script async src="https://www.tiktok.com/embed.js"></script>
    @stack('scripts')
</body>
</html>
