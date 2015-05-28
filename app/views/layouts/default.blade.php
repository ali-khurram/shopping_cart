<!DOCTYPE html>
<!--[if lt IE 9]>      <html class="lt-ie9" dir="ltr" lang="en" class="no-js"> <![endif]-->
<!--[if IE 9]>         <html class="ie9" class="no-js"> <![endif]-->
<!--[if gt IE 9]><!--><html class="mt-ie9" dir="ltr" lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <title>{{{ $title or 'Shopping Cart' }}}</title>
        {{-- Meta --}}
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=9,chrome=1">
        <meta name="author" content="Shopping Cart">
        <meta name="description" content="{{{ $description or 'Shopping Cart, an ecommerce site' }}}">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        {{-- Favicon --}}
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
        
        <!-- CSS are placed here -->
        {{ HTML::style('components/bootstrap/css/bootstrap.min.css') }}
        <!--[if lt IE 9]>
                <script type="text/javascript" src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
        <![endif]-->
        @yield('js')
    </head>
    <body>
        {{-- Header --}}
        @include('header')
        {{-- Content --}}
        {{ (isset($content)) ? $content : "" }}


        @yield('content')


        {{-- Footer --}}
        @include('footer')
        {{-- JS --}}
        @section('footer-js')

        @show
    </body>
</html>
