<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MyBlog - @yield('head.title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}"/>
    <!-- STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slippry.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
    
    <!-- GOOGLE FONTS -->
    <link href='{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic') }}' rel='stylesheet' type='text/css'>
    <link href='{{ asset('https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic') }}' rel='stylesheet' type='text/css'>
    <link href='{{ asset('https://fonts.googleapis.com/css?family=Sarina') }}' rel='stylesheet' type='text/css'>
    @yield('head.css')
</head>

<body>


    <!-- *****************************************************************
    ** Preloader *********************************************************
    ****************************************************************** -->

    <div id="preloader-container">
        <div id="preloader-wrap">
            <div id="preloader"></div>
        </div>
    </div>

    
    <!-- *****************************************************************
    ** Header ************************************************************ 
    ****************************************************************** --> 

    <header class="tada-container">
    
    
        <!-- LOGO -->    
        <div class="logo-container">
            <a href="index.html"><img src="{{ asset('img/logo.png') }}" alt="logo" ></a>
            <div class="tada-social">
                <a href="#"><i class="icon-facebook5"></i></a>
                <a href="#"><i class="icon-twitter4"></i></a>
                <a href="#"><i class="icon-google-plus"></i></a>
                <a href="#"><i class="icon-vimeo4"></i></a>
                <a href="#"><i class="icon-linkedin2"></i></a>
            </div>
        </div>

        @include('particals.blog.menu')
        
        
        
        
        <!-- SEARCH -->
        <div class="tada-search">
            <form>
                <div class="form-group-search">
                    <input type="search" class="search-field" placeholder="Search and hit enter...">
                    <button type="submit" class="search-btn"><i class="icon-search4"></i></button>
                </div>
            </form>
        </div>
        
        
        <!-- SLIDER -->
        <div class="tada-slider">
            <ul id="tada-slider">
                <li>
                    <img src="{{ asset('img/image-slider-1.jpg') }}" alt="image slider 1">
                    <div class="pattern"></div>
                    <div class="tada-text-container">
                        <h1>AENEAN AC DIAM</h1>
                        <h2>VIVAMUS <span class="main-color">TINCIDUNT</span> FERMENTUM</h2>
                        <span class="button"><a href="#">TEXT BUTTON</a></span>
                    </div>
                </li>
                <li>
                    <img src="{{ asset('img/image-slider-2.jpg') }}" alt="image slider 2">
                    <div class="pattern"></div>
                    <div class="tada-text-container">
                        <h1>MAECENAS CONSECTETUR</h1>
                        <h2>Lorem <span class="main-color">ipsum dolor</span> sit amet</h2>
                        <span class="button"><a href="#">READ ME</a></span>
                    </div>
                </li>
                <li>
                    <img src="{{ asset('img/image-slider-3.jpg') }}" alt="image slider 3">
                    <div class="pattern"></div>
                    <div class="tada-text-container">
                        <h1>AENEAN AC DIAM</h1>
                        <h2>VIVAMUS <span class="main-color">TINCIDUNT</span> FERMENTUM</h2>
                        <span class="button"><a href="#">TEXT BUTTON</a></span>
                    </div>                
                </li>
                <li>
                    <img src="{{ asset('img/image-slider-4.jpg') }}" alt="image slider 4">
                    <div class="pattern"></div>
                    <div class="tada-text-container">
                        <h1>AENEAN AC DIAM</h1>
                        <h2>VIVAMUS <span class="main-color">TINCIDUNT</span> FERMENTUM</h2>
                        <span class="button"><a href="#">TEXT BUTTON</a></span>
                    </div>                
                </li>
            </ul>
            
        </div><!-- #SLIDER -->
                
                
    </header><!-- #HEADER -->
   
