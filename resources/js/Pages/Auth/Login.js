import React from 'react';

export default function() {

    return (

    <div className="container mx-auto h-full flex flex-1 justify-center items-center relative">
        <div className="w-full max-w-xs">

            <h1 className="text-red-700 font-gobold mb-6 text-center mx-auto" style={{fontSize: 80}}>LOBOK</h1>

            <form method="POST" className="bg-red-700 shadow-md px-8 pt-6 pb-8 mb-4">
                <div className="mb-4">
                    <label className="block text-white text-sm font-hairline mb-2" htmlFor="email">
                        {'E-postadress'}
                    </label>
                    <input id="email" type="email" className="shadow appearance-none border rounded w-full py-2 px-3 text-black" name="email" required autoFocus />
                </div>
                <div className="mb-6">
                    <label className="block text-white text-sm font-hairline mb-2" htmlFor="password">
                        {'Lösenord'}
                    </label>
                    <input className="shadow appearance-none border rounded w-full py-2 px-3 text-black" id="password" name="password" type="password" placeholder="******************" required />
                </div>
                <div className="flex items-center justify-between">
                    <button className="bg-white hover:bg-red-600 text-red-700 hover:text-white font-bold py-2 px-4 rounded hover:shadow-md" type="submit">
                        {'Login'}
                    </button>
                </div>
            </form>
        </div>
    </div>
  )}