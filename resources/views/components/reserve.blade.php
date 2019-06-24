@component('components.modal', ['name' => 'reserve-modal', 'style' => 'bg-red-900'])

<form action="/reservations" method="post">
  @csrf
  <div class="flex flex-wrap -mx-3 mb-3">    
    <label class="block tracking-wide text-gray-200 text-xs font-bold mb-2" for="grid-name">
        {{__('Namn')}}
    </label>
    <input 
      class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
      id="grid-name" name="name" type="text" placeholder="Jane">
    @error('grid-name')
    <p class="text-red-500 text-xs italic">Please fill out this field.</p>
    @enderror
  </div>

  <div class="flex flex-wrap -mx-3 mb-3">
    <label class="block tracking-wide text-gray-200 text-xs font-bold mb-2" for="grid-company">
    {{__('Företag')}}
    </label>
    <input 
      class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
      id="grid-company" name="company" type="text" placeholder="Leia Företagshotell">
    @error('grid-company')
    <p class="text-red-500 text-xs italic">Please fill out this field.</p>
    @enderror
  </div>

  <div class="flex flex-wrap -mx-3 mb-3">
      <label class="block tracking-wide text-gray-200 text-xs font-bold mb-2" for="grid-resource">
        {{__('Resurs')}}
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
        id="grid-resource" name="resource" type="text" placeholder="Leia Företagshotell">
      @error('grid-resource')
      <p class="text-red-500 text-xs italic">Please fill out this field.</p> 
      @enderror   
    </div>

  <div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-full mb-6 md:mb-0">
      <label class="block tracking-wide text-gray-200 text-xs font-bold mb-2" for="grid-start-date">
        {{ __('Från') }}
      </label>
      <input 
        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
        id="grid-start-date" name="start-time" type="datetime-local">
    </div>
     
  </div>
  <div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/2 md:pr-3 mb-6 md:mb-0">
      <label class="block tracking-wide text-gray-200 text-xs font-bold mb-2" for="grid-end-date">
        {{ __('Till') }}
      </label>
      <input 
        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
        id="grid-end-date" name="end-time" type="time" value="{{ \Carbon\Carbon::now('Europe/Stockholm')->locale('sv')->format('H:i') }}">
    </div> 
    <div class="w-full md:w-1/2 md:pl-3 mb-6 md:mb-0">
      <label class="block tracking-wide text-gray-200 text-xs font-bold mb-2" for="grid-attendants">
          {{ __('Deltagare') }}
      </label>
      <input 
        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
        id="grid-attendants" name="attendants" type="number" placeholder="10">
      @error('grid-resource')
      <p class="text-red-500 text-xs italic">Please fill out this field.</p> 
      @enderror   
    </div>
  </div>

  
  <div class="flex flex-wrap -mx-3 mb-2">
      <div class="w-full mb-6 md:mb-0">
        <label class="block tracking-wide text-gray-200 text-xs font-bold mb-2" for="extras">
          {{ __('Tillval') }}
        </label>
        <input 
          class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
          id="grid-extras" name="extras" type="textarea" rows="5" placeholder="Tillval"> 
      </div>
  </div>

  <div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-1/2 md:pr-3 mb-6 md:mb-0">
      <button type="submit" class="text-white rounded bg-red-700 px-5 py-2 shadow-2xl hover:bg-red-800 mr-10">Boka</button>
    </div>
    <div class="w-1/2 md:pl-3 mb-6 md:mb-0">
      <button type="button" class="text-white rounded bg-red-700 px-5 py-2 shadow-2xl hover:bg-red-800 mr-10">Avbryt</button>
    </div>
      
  </div>
</form>
@endcomponent