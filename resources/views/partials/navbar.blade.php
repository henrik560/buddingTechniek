
<nav class="bg-primary navbar border-gray-700 relative z-50">
  <div class="container mx-auto flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="/" class="flex items-center">
        <img src="{{ asset('assets/images/logo-white.png') }}" class="h-16 mr-3 p-2" alt="Budding Techniek Logo" />
    </a>
    <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 ml-3 text-sm rounded-lg md:hidden focus:outline-none focus:ring-2 text-gray-400 focus:text-secondary focus:ring-secondary" aria-controls="navbar-dropdown" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
      <ul class="flex navbar-list flex-col font-medium p-4 md:p-0 mt-4 md:flex-row md:space-x-8 md:mt-0 bg-primary">
        @foreach(Statamic::tag('nav:main_nav') as $page)
            @if (count($page["children"]) > 0)
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar-{{ $page["id"] }}" class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-2xl rounded md:hover:bg-transparent hover:text-secondary duration-300 navbar-link-item navbar-link-item-group md:border-0 md:p-0 md:w-auto text-white font-medium focus:text-white">
                        {{ $page["title"] }}
                        <svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar-{{ $page["id"] }}" class="z-10 dropdown-navbar bg-primary hidden shadow-2xl font-normal divide-y rounded-lg w-44">
                        <ul class="py-2 text-sm text-gray-400" aria-labelledby="dropdownLargeButton">
                            @foreach($page["children"] as $child)
                                <li>
                                    <a href="{{ $child["permalink"] }}" class="block navbar-link-item px-4 py-2 duration-300 hover:text-secondary">{{ $child["title"] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @else
                <li>
                    <a href="{{ $page["permalink"] }}" class="block py-2 pl-3 text-2xl pr-4 text-white font-medium navbar-link-item rounded hover:text-secondary duration-300 md:bg-transparent md:p-0 aria-current="page">{{ $page["title"] }}</a>
                </li>
            @endif
        @endforeach  
      </ul>
    </div>
  </div>
</nav>
