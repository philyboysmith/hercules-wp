<div class="bg-gray-100 relative z-10">

      
        <div class="container">
          <div class="border-b-2 border-gray-200 flex flex-col justify-center ">
            <div class="md:flex items-center -mx-6">

              
              <div class="w-full md:w-1/3 max-w-xs px-6">
                <div class="flex items-center">
                  <a href="/" class="flex flex-col py-6 md:py-12 items-start">
                    <img src="@asset('images/logo.svg')" class="w-full mb-2"/>
                    <span class="font-bold text-xs text-center uppercase">A Duchenne UK Global Collaboration</span>
                  </a>
                </div>
              </div>

              <div class="md:flex flex-grow lg:w-3/4 xl:w-4/5 justify-end px-6">
              @if (has_nav_menu('primary_navigation'))
                  {!! wp_nav_menu(['depth'=>1, 'theme_location' => 'primary_navigation', 'menu_class' => 'nav md:flex']) !!}
                @endif
              </div>

            </div>
          </div>
        </div>
      

  
</div>