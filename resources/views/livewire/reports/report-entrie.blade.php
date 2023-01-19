<div>

    <div class="mb-5 flex space-x-8 bg-white rounded-xl p-4">

        <div>

            <div>

                <Label>Fecha inicial</Label>

            </div>

            <div>

                <input type="date" class="bg-white rounded text-sm " wire:model="date1">

            </div>

            <div>

                @error('date1') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div>

            <div>

                <Label>Fecha final</Label>

            </div>

            <div>

                <input type="date" class="bg-white rounded text-sm " wire:model="date2">

            </div>

            <div>

                @error('date2') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-3 bg-white rounded-xl p-4 mb-5">

        <div class="flex-auto">

            <div>

                <Label>Artículo</Label>
            </div>

            <div>

                <select class="bg-white rounded text-sm w-full" wire:model="entrie_article_id">
                    <option value="" selected>Selecciona un artículo</option>

                    @foreach ($articles as $article)
                        <option value="{{ $article->id }}">{{ $article->name }}</option>
                    @endforeach

                </select>

            </div>

            <div>

                @error('entrie_article_id') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="flex-auto">

            <div>

                <Label>Precio inicial</Label>
            </div>

            <div>

                <input type="text" class="bg-white rounded text-sm w-full" wire:model="entrie_price1">

            </div>

            <div>

                @error('entrie_price1') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="flex-auto">

            <div>

                <Label>Precio final</Label>
            </div>

            <div>

                <input type="text" class="bg-white rounded text-sm w-full" wire:model="entrie_price2">

            </div>

            <div>

                @error('entrie_price2') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="flex-auto">

            <div>

                <Label>Ubicación</Label>
            </div>

            <div>

                <select class="bg-white rounded text-sm w-full" wire:model="entrie_location">
                    <option selected value="">Selecciona una ubicación</option>

                    @foreach ($locations as $ubicacion)

                        <option value="{{ $ubicacion }}">{{ $ubicacion }}</option>

                    @endforeach


                </select>

            </div>

            <div>

                @error('entrie_location') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="flex-auto">

            <div>

                <Label>Origen</Label>
            </div>

            <div>

                <select class="bg-white rounded text-sm w-full" wire:model="entrie_origin">
                    <option selected value="">Selecciona un origen</option>
                    <option value="donación">Donación</option>
                    <option value="compra">Compra</option>

                </select>

            </div>

            <div>

                @error('entrie_origin') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

    </div>

    @if (count($entries))

            <div class="rounded-lg mb-5 p-4 font-thin flex justify-between bg-white items-center">

                <p class="text-xl font-extralight">Se encontraron: {{ $entries->total() }} registros con los filtros seleccionados.</p>

                <button wire:click="downloadExcel" class="text-white flex items-center border rounded-full px-4 py-2 bg-green-500 hover:bg-green-700 mt-2 md:mt-0 w-full md:w-auto justify-center">

                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                      </svg>

                      Exportar a Excel

                </button>

            </div>


            <div class="relative overflow-x-auto rounded-lg shadow-xl">

                <table class="rounded-lg w-full">

                    <thead class="border-b border-gray-300 bg-gray-50">

                        <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                            <th class="px-1 py-3 hidden lg:table-cell">

                                Artículo / Marca

                            </th>

                            <th wire:click="order('quantity')" class="px-1 py-3 hidden lg:table-cell">

                                Cantidad

                            </th>

                            <th wire:click="order('price')" class="px-1 py-3 hidden lg:table-cell">

                                Precio

                            </th>

                            <th wire:click="order('location')" class="px-1 py-3 hidden lg:table-cell">

                                Ubicación

                            </th>

                            <th wire:click="order('origin')" class="px-1 py-3 hidden lg:table-cell">

                                Origen

                            </th>

                            <th wire:click="order('description')" class="px-1 py-3 hidden lg:table-cell">

                                Descripción

                            </th>

                            <th wire:click="order('created_at')" class="px-1 py-3 hidden lg:table-cell">

                                Registro

                            </th>

                            <th wire:click="order('updated_at')" class="px-1 py-3 hidden lg:table-cell">

                                Actualizado

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                        @foreach($entries as $entrie)

                            <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                <td class="px-3 py-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Artículo</span>

                                    <p class="text-sm font-medium text-gray-900">{{ $entrie->article->name }}  / {{ $entrie->article->brand }}</p>

                                </td>

                                <td class="px-3 py-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Cantidad</span>

                                    <p class="text-sm font-medium text-gray-900 capitalize">{{ $entrie->quantity }}</p>

                                </td>

                                <td class="px-3 py-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Precio</span>

                                    <p class="text-sm font-medium text-gray-900 capitalize">${{ $entrie->price }}</p>

                                </td>

                                <td class="capitalize px-3 py-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Ubicación</span>

                                    <p class="text-sm font-medium text-gray-900">{{ $entrie->location }}</p>

                                </td>

                                <td class="capitalize px-3 py-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Origen</span>

                                    <p class="text-sm font-medium text-gray-900">{{ $entrie->origin }}</p>

                                </td>

                                <td class="px-3 py-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Descripción</span>

                                    <p class="text-sm font-medium text-gray-900 capitalize">{{ $entrie->description }}</p>

                                </td>

                                </td>

                                <td class="px-3 py-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                    @if($entrie->created_by != null)

                                        <span class="font-semibold">Registrado por: {{$entrie->createdBy->name}}</span> <br>

                                    @endif

                                    {{ $entrie->created_at }}

                                </td>

                                <td class="px-3 py-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                    @if($entrie->updated_by != null)

                                        <span class="font-semibold">Actualizado por: {{$entrie->updatedBy->name}}</span> <br>

                                    @endif

                                    {{ $entrie->updated_at }}

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                    <tfoot class="border-gray-300 bg-gray-50">

                        <tr>

                            <td colspan="10" class="py-2 px-5">
                                {{ $entries->links()}}
                            </td>

                        </tr>

                    </tfoot>

                </table>

                <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading wire:target="search">

                    <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

                </div>

            </div>

        @else

            <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                No hay resultados.

            </div>

        @endif

</div>
