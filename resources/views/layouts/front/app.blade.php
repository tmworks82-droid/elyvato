<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- head content goes here --}}
        @include('components.front.head', [
            'title' => $title ?? config('app.name'),
            'metaDescription' => $metaDescription ?? 'Default meta description',
            'robotsMeta' => $robotsMeta ?? 'index, follow',
            'canonical' => $canonical ?? url()->current(),
            'featuredImage' => $featuredImage ?? asset('images/default-featured.jpg')
        ])

        @yield(section: 'styles')
        <style>
             .whatsapp-float {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
         background-color: #aeecc6; 
        border-radius: 50%;
        padding: 8px;
         box-shadow: 0 0 10px rgba(0,0,0,0.2); 
    }
    .whatsapp-float img {
        display: block;
    }
        </style>
        
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-P0G7G79VB6"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        
        gtag('config', 'G-P0G7G79VB6');
        </script>
        
        <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "sx4txiixfb");
    </script>
    
    <!--here meta pixels-->
    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1673774589850706');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1673774589850706&ev=PageView&noscript=1"
    />
    </noscript>
    <!-- End Meta Pixel Code -->


    </head>
    <body class="overflow-x-hidden">
        
        @include('components.front.navbar')

        <main>
            {{-- page content goes here --}}
            @yield('pageContent')
        </main>

        
        @include('components.front.footer')
<a href="https://wa.me/919289957538" class="whatsapp-float" target="_blank">
            <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp" width="50" height="50">
        </a>
       @yield('scripts')

       <script src="{{ asset('front/assets/js/main.js') }}"></script>
       <script src="{{ asset('front/assets/js/sweetalert2@11.js') }}"></script>
       

    </body>
</html>
