<!doctype html>
<html {!! get_language_attributes() !!} class="bg-white antialiased">
  @include('partials.head')
  <body @php body_class('text-gray-900 leading-normal bg-gray-100 flex flex-col min-h-screen') @endphp style="background-image:url(@asset('images/hexagons.svg'))">
    @php do_action('get_header') @endphp
    @include('partials.header')
    <div class="relative overflow-hidden  flex-1 ">
    <div class="wrap container pt-8 pb-16 static overflow-hidden" role="document">
      <div class="content">
        <main class="main">
          @yield('content')
        </main>
        @if (App\display_sidebar())
          <aside class="sidebar">
            @include('partials.sidebar')
          </aside>
        @endif
      </div>
    </div>
    </div>
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp
  </body>
</html>
