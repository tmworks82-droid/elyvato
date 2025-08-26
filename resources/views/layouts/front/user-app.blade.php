<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- head content goes here --}}
        @include('components.front.user-head', [
            'title' => $title ?? config('app.name'),
        ])

        @yield(section: 'styles')
        
    </head>
    <body class="overflow-x-hidden">
        
        @include('components.front.navbar')

        <main>
            <section class="section-padding-top section-padding-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            @include('components.front.user-sidebar')
                        </div>
                        <div class="col-lg-9 ps-lg-4">
                            @yield('pageContent')
                        </div>
                    </div>
                </div>
            </section>
        </main>

        
        @include('components.front.footer')

       @yield('scripts')
    </body>
</html>
