
<footer class="bg-primary footer">
    <div class="w-full container p-4 py-6 lg:py-8 border-t-2 border-gray-200">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
              <a href="/" class="flex items-center">
                <img src="{{ asset('assets/images/logo-white.png') }}" class="h-16 mr-3 p-2" alt="Budding Techniek Logo" />
              </a>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-secondary uppercase">Links</h2>
                  <ul class="text-gray-600 dark:text-gray-400 font-medium">
                    @foreach(Statamic::tag('nav:main_nav') as $page)
                        <li class="mb-4">
                            <a href="{{ $page["permalink"] }}" class="hover:underline"> {{ $page["title"] }}</a>
                        </li>

                        @foreach($page["children"] as $child)
                            <li class="mb-4">
                                <a href="{{ $child["permalink"] }}" class="hover:underline">{{ $child["title"] }}</a>
                            </li>
                        @endforeach
                    @endforeach  
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-secondary uppercase">Juridisch</h2>
                  <ul class="text-gray-600 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="#" class="hover:underline">Privacy Policy</a>
                      </li>
                      <li>
                          <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
      <div class="sm:flex sm:items-center sm:justify-between">
          <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{ now()->format('Y') }} <a href="/" class="hover:underline">BuddingTechniek™</a>. All Rights Reserved.
          </span>
          <div class="flex company-social-media mt-4 space-x-6 sm:justify-center sm:mt-0">
            @foreach($company["social_media"] as $account)
                <a href="{{ $account["link"] }}" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                    <img src="{{ $account["icon"] }}" alt="{{ $account["title"] }} account icon" />
                    <span class="sr-only">F{{ $account["title"] }}</span>
                </a>
            @endforeach
          </div>
      </div>
    </div>
</footer>
