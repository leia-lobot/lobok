import React, { Fragment } from 'react'
import { InertiaLink } from '@inertiajs/inertia-react';

export default function Welcome() {
  return (
          <div className="w-screen h-screen bg-cover" style={{backgroundImage: "url('https://res.cloudinary.com/dimcuw4l3/image/upload/w_1000,ar_16:9,c_fill,g_auto,e_sharpen/v1565176364/lobok_background_zrepsk.png')"}}>
        <div className="w-screen h-screen fixed">
    
    </div>
    <div className="relative pt-40 flex justify-center">
        <div className="flex flex-col">
            <h2 className="text-red-700 text-3xl font-gobold">VÄLKOMMEN TILL</h2>
            <h1 className="text-red-700 font-gobold -mt-10" style={{fontSize: 200}}>LOBOK</h1>
            <div className="flex justify-center">
            <InertiaLink href={'/dashboard'} className="text-white rounded bg-red-700 px-5 py-2 shadow-2xl hover:bg-red-800">Boka nu</InertiaLink>
            </div>
        </div>
        
    </div>
    </div>
  )
}