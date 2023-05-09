<div>

    <div class="flex items-center space-x-2 justify-center">

        <input type="number" min="1" wire:model.defer="quantity" class="bg-white rounded-full w-20 ">

        <button
            wire:click="addRequest({{$article}})"
            wire:loading.attr="disabled"
            class="bg-blue-400 hover:shadow-lg text-white text-xs md:text-sm px-2 py-2 rounded-full hover:bg-blue-700 flex items-center focus:outline-none"
        >

            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>

        </button>

    </div>

</div>
