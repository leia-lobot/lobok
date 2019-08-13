import { InertiaLink } from 'inertia-react'
import React from 'react'

export default function Layout({ children }) {
  return (
    <main  className="bg-cover w-screen h-screen relative" style={{backgroundImage: "url('https://res.cloudinary.com/dimcuw4l3/image/upload/w_1000,ar_16:9,c_fill,g_auto,e_sharpen/v1565176364/lobok_background_zrepsk.png')"}}>
      

      <div className="flex flex-wrap">
        <div className="w-1/5 bg-red-900 opacity-75 inline-flex">
          <h1 className="text-white absolute items-center justify-center w-auto h-auto" style={{fontSize: 32}}>LOBOK</h1>
        </div>
      
      <header className="w-4/5 h-32">
        
      </header>
      <aside className="w-1/5 h-screen bg-red-900 opacity-75">
      
        <nav className="ml-12">
          <InertiaLink href="/dashboard">Home</InertiaLink>
          <br/>
          <InertiaLink href="/reservation">Reservation</InertiaLink>
          <br/>
          <InertiaLink href="/overview">Overview</InertiaLink>
        </nav>
      </aside>

      <article className="w-4/5 bg-gray-900 opacity-75">{children}</article>
      </div>
    </main>
  )
}
/*
<div>
        <!-- Left -->
        <div class="flex justify-center w-1/5 opacity-75 bg-red-900">
            <h1 class="text-gray-100 text-6xl pt-16">LOBOK</h1>
            
        </div>

        <!-- Right -->
        <div class="w-4/5">
            <div class="absolute w-4/5 h-screen"></div>
            <div class="pt-40 flex justify-center relative">
                    <div class="flex flex-col">
                        <div class="flex justify-center">
                                <a href="#reserve-modal" class="text-white rounded bg-red-700 px-5 py-2 shadow-2xl hover:bg-red-800 mr-10">Boka nu</a>
                                <a href="#overview-modal" class="text-white rounded bg-red-700 px-5 py-2 shadow-2xl hover:bg-red-800">Översikt</a>
                        </div>
                    </div>
                    
                </div>
            
               @include('components.reserve')
                
                @component('components.modal', ['name' => 'overview-modal', 'style' => 'bg-white'])
                    <div id="calendar"></div>
                @endcomponent
        </div>
    </div>
    */