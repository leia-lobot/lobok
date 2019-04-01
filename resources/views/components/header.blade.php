<header class="bg-nav">
        <div class="flex justify-between">
            <div class="p-1 mx-3 inline-flex">
                <h1 class="text-white">LoBok</h1>
                <i class="fas fa-bars p-3 text-white" onclick="sidebarToggle()"></i>
            </div>
            <div class="p-1 flex flex-row">
                    <i onclick="profileToggle()" class="fas fa-user inline-block rounded-full py-2 text-white fill-current"></i>
            <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block">{{ auth()->user()->name}}</a>
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
