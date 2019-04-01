<header class="bg-nav">
        <div class="flex justify-between">
            <div class="p-1 mx-3 inline-flex">
                <h1 class="text-white">LoBok</h1>
                <i class="fas fa-bars p-3 text-white" onclick="sidebarToggle()"></i>
            </div>
            <div class="p-1 flex flex-row">
                <img onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full" src="https://avatars0.githubusercontent.com/u/4323180?s=460&v=4" alt="">
                <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block">Adam Wathan</a>
                <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
                    <ul class="list-reset">
                      <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">My account</a></li>
                      <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Notifications</a></li>
                      <li><hr class="border-t mx-2 border-grey-light"></li>
                      <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>