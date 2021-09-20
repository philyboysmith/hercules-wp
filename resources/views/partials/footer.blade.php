<footer class="content-info w-full bg-blue-900 text-gray-100">
  <div class="container py-8 border-b-2 border-blue-800 ">
    <div class="md:flex items-center">
      <div class="flex-1">
        <img src="https://www.duchenneuk.org/wp-content/themes/duchenne/src/img/svgs/footer_logo.svg" class="w-24 mb-2" alt="Duchenne UK">
      </div>
      <ul class="flex">
        <li class="mr-4"><a target="_blank" href="https://twitter.com/DuchenneUK"><i class="mr-1 fab fa-twitter" aria-hidden="true"></i><span class="visuallyhidden">Twitter</span></a></li>
        <li class="mr-4"><a target="_blank" href="https://www.facebook.com/duchenneuk"><i class="mr-1 fab fa-facebook" aria-hidden="true"></i><span class="visuallyhidden">Facebook</span></a></li>
        <li class="mr-4"><a target="_blank" href="https://www.instagram.com/duchenneuk/"><i class="mr-1 fab fa-instagram" aria-hidden="true"></i><span class="visuallyhidden">Instagram</span></a></li>
        <li class="mr-4"><a href="mailto:hercules@duchenneuk.org"><i class="mr-1 fa fa-envelope" aria-hidden="true"></i><span class="visuallyhidden">Email</span></a></li>
      </ul>
    </div>
    </div>
    <div class="container py-8 text-center text-sm ">
                @if (has_nav_menu('footer_navigation'))
                  {!! wp_nav_menu(['depth'=>2, 'theme_location' => 'footer_navigation', 'menu_class' => 'flex justify-center']) !!}
                @endif
        <p>Registered Charity No. 1147094. © 2019 Duchenne UK. All rights reserved.
Duchenne UK, 56 Wood Lane, London, W12 7SB.</p>
    </div>
    @php dynamic_sidebar('sidebar-footer') @endphp
  </div>
</footer>
