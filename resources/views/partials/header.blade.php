<div class="bg-gray-100 relative z-10">

      
        <div class="container">
          <div class="md:border-b-2 border-gray-200 flex flex-col justify-center ">
            <div class="flex flex-wrap md:flex-no-wrap justify-between items-center -mx-6">

              
              <div class="logo-wrapper md:w-1/3 max-w-xs px-6">
                <div class="flex items-center">
                  <a href="/" class="flex flex-col py-6 md:py-12 items-start">
                    <img src="@asset('images/logo.svg')" class="w-full mb-2"/>
                    <span class="font-bold text-xs md:text-center uppercase">A Duchenne UK Global Collaboration</span>
                  </a>
                </div>
              </div>

              <button class="md:hidden rounded-lg px-4 py-3 bg-blue-700 hover:bg-blue-600 md:text-lg text-white font-semibold leading-tight shadow-md mr-6" id="menuNav">
              <i class="fas fa-bars mr-2 flex-no-shrink"></i>Menu</button>

              <div id="menu" class="w-full md:w-auto hidden md:flex flex-grow lg:w-3/4 xl:w-4/5 justify-end px-6 border-t-2 border-b-2 pt-3 md:border-0 md:pt-0">
              @if (has_nav_menu('primary_navigation'))
                  {!! wp_nav_menu(['depth'=>1, 'theme_location' => 'primary_navigation', 'menu_class' => 'nav flex flex-col md:flex-row md:flex-wrap']) !!}
                @endif
              </div>

            </div>
          </div>
        </div>
      

  
</div>