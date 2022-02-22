<div class="mb-5">

    <h1 class="titulo-seccion text-3xl font-thin text-gray-500 mb-3">Reportes</h1>

    <div class="p-4 mb-5 bg-white shadow-xl">

        <div class="mb-5">

            <div>

                <Label>Área</Label>

            </div>

            <div>

                <select class="bg-white rounded text-sm " wire:model="area">
                    <option selected>Selecciona una área</option>
                    <option value="1">Entradas</option>
                    <option value="2">Artículos</option>
                    <option value="3">Solicitudes</option>
                </select>

            </div>

        </div>

        <div class="mb-5 flex space-x-8">

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

        @if($showArticles)

            <div class="flex flex-col md:flex-row justify-between md:space-x-3">

                <div class="flex-auto ">

                    <div>

                        <Label>Nombre</Label>
                    </div>

                    <div>

                        <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="article_name">

                    </div>

                    <div>

                        @error('article_name') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto">

                    <div>

                        <Label>Marca</Label>
                    </div>

                    <div>

                        <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="article_brand">

                    </div>

                    <div>

                        @error('article_brand') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto">

                    <div>

                        <Label>Categoría</Label>

                    </div>

                    <div>

                        <select class="bg-white rounded text-sm w-full" wire:model.defer="article_category_id">

                            <option value="">Seleccione una categoría</option>

                            @foreach ($categories as $catgegory)


                                <option value="{{ $catgegory->id }}">{{ $catgegory->name }}</option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        @error('article_category_id') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto">

                    <div>

                        <Label>Ubicación</Label>
                    </div>

                    <div>

                        <select class="bg-white rounded text-sm w-full" wire:model.defer="article_location">
                            <option value="" selected>Selecciona una ubicación</option>
                            <option value="rpp">RPP</option>
                            <option value="catastro">Catastro</option>

                        </select>

                    </div>

                    <div>

                        @error('article_location') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex items-end">

                    <button
                        class="bg-blue-500 hover:shadow-lg hover:bg-blue-700  text-sm py-2 px-4 text-white rounded-full focus:outline-none mt-3 w-full"
                        wire:click="filterArticles"
                        wire:loading.attr="disabled"
                        wire:target="filterArticles"
                    >
                        Filtrar
                    </button>

                </div>

            </div>

        @endif

        @if ($showEntries)

            <div class="flex flex-col md:flex-row justify-between md:space-x-3">

                <div class="flex-auto">

                    <div>

                        <Label>Artículo</Label>
                    </div>

                    <div>

                        <select class="bg-white rounded text-sm w-full" wire:model.defer="entrie_article_id">
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

                        <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="entrie_price1">

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

                        <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="entrie_price2">

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

                        <select class="bg-white rounded text-sm w-full" wire:model.defer="entrie_location">
                            <option selected>Selecciona una ubicación</option>
                            <option value="rpp">RPP</option>
                            <option value="catastro">Catastro</option>

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

                        <select class="bg-white rounded text-sm w-full" wire:model.defer="entrie_origin">
                            <option selected>Selecciona un origen</option>
                            <option value="donación">Donación</option>
                            <option value="compra">Compra</option>

                        </select>

                    </div>

                    <div>

                        @error('entrie_origin') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex items-end">

                    <button
                        class="bg-blue-500 hover:shadow-lg hover:bg-blue-700  text-sm py-2 px-4 text-white rounded-full focus:outline-none mt-3 w-full"
                        wire:click="filterEntries"
                        wire:loading.attr="disabled"
                        wire:target="filterEntries"
                    >
                        Filtrar
                    </button>

                </div>

            </div>

        @endif

        @if ($showRequests)

            <div class="flex flex-col md:flex-row justify-between md:space-x-3">

                <div class="flex-auto">

                    <div>

                        <Label>Artículo</Label>
                    </div>

                    <div>

                        <select class="bg-white rounded text-sm w-full" wire:model.defer="request_article_id">
                            <option value="" selected>Selecciona un artículo</option>

                            @foreach ($articles as $article)
                                <option value="{{ $article->id }}">{{ $article->name }}</option>
                            @endforeach

                        </select>

                    </div>

                    <div>

                        @error('request_article_id') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto">

                    <div>

                        <Label>Status</Label>
                    </div>

                    <div>

                        <select class="bg-white rounded text-sm w-full" wire:model.defer="request_status">
                            <option value="{{ null }}" selected>Selecciona un status</option>
                            <option value="aceptada">Aceptada</option>
                            <option value="solicitada">Solicitada</option>
                            <option value="entregada">Entregada</option>
                            <option value="rechazada">Rechazada</option>
                        </select>

                    </div>

                    <div>

                        @error('request_status') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto">

                    <div>

                        <Label>Ubicación</Label>
                    </div>

                    <div>

                        <select class="bg-white rounded text-sm w-full" wire:model.defer="request_location">
                            <option value="{{ null }}" selected>Selecciona una ubicación</option>
                            <option value="rpp">RPP</option>
                            <option value="catastro">Catastro</option>

                        </select>

                    </div>

                    <div>

                        @error('request_location') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto">

                    <div>

                        <Label>Solicitante</Label>
                    </div>

                    <div>

                        <select class="bg-white rounded text-sm w-full" wire:model.defer="request_user">
                            <option selected>Selecciona un artículo</option>

                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach

                        </select>

                    </div>

                    <div>

                        @error('request_user') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex items-end">

                    <button
                        class="bg-blue-500 hover:shadow-lg hover:bg-blue-700  text-sm py-2 px-4 text-white rounded-full focus:outline-none mt-3 w-full"
                        wire:click="filterRequests"
                        wire:loading.attr="disabled"
                        wire:target="filterRequests"
                    >
                        Filtrar
                    </button>

                </div>

            </div>

        @endif

    </div>

    @if($requests_filtered)

        @if(count($requests_filtered))

            <div class="rounded-lg shadow-xl mb-5 p-4 font-thin flex justify-between">

                <p class="text-xl font-extralight">Se encontraron: {{ count($requests_filtered) }} registros con los filtros seleccionados.</p>

                <button wire:click="downloadExcel(3)" class="text-white flex border rounded-full px-2 py-1 bg-green-500 hover:bg-green-700">

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

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Número

                            </th>

                            <th  class="px-3 py-3 hidden lg:table-cell">

                                Contenido

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Ubicaión

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Solicitante

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Estado

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Registro

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Actualizado

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none">

                        @foreach($requests_filtered as $request)

                            <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                <td class="w-full lg:w-auto p-3 font-bold text-gray-800 text-center md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">#</span>

                                    {{ $request->number }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Contenido</span>

                                    @php
                                        $content = json_decode($request->content, true);
                                        $total=0;
                                    @endphp

                                    @foreach ($content as $article)

                                        @php
                                            $total = $total + $article['quantity']
                                        @endphp

                                    @endforeach

                                    <span class="bg-rojo text-white rounded-full py-1 px-2 mr-2">{{ $total }}</span><span>Artículos</span>

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800 text-center md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Ubicación</span>

                                    {{ $request->location }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Solicitante</span>

                                    {{ $request->createdBy->name }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800 text-center lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Stock</span>

                                    @if($request->status == 'solicitada')
                                        <span class="bg-blue-400 text-white rounded-full py-1 px-4">{{ $request->status }}</span>
                                    @elseif($request->status == 'aceptada')
                                        <span class="bg-green-400 text-white rounded-full py-1 px-4">{{ $request->status }}</span>
                                    @elseif($request->status == 'rechazada')
                                        <span class="bg-red-400 text-white rounded-full py-1 px-4">{{ $request->status }}</span>
                                    @elseif($request->status == 'entregada')
                                        <span class="bg-gray-400 text-white rounded-full py-1 px-4">{{ $request->status }}</span>
                                    @endif

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                    @if($request->created_by != null)

                                        <span class="font-semibold">Registrado por: {{$request->createdBy->name}}</span> <br>

                                    @endif

                                    {{ $request->created_at }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                    @if($request->updated_by != null)

                                        <span class="font-semibold">Actualizado por: {{$request->updatedBy->name}}</span> <br>

                                    @endif

                                    {{ $request->updated_at }}

                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                    <tfoot class="border-gray-300 bg-gray-50">

                        <tr>

                            {{-- <td colspan="8" class="py-2 px-5">
                                {{ $requests_filtered->links()}}
                            </td> --}}

                        </tr>

                    </tfoot>

                </table>

                <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading wire:target="requests_filtered">

                    <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

                </div>

            </div>

        @else

            <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                No hay resultados.

            </div>

        @endif

    @endif

    @if($articles_filtered)

        @if(count($articles_filtered))

            <div class="rounded-lg shadow-xl mb-5 p-4 font-thin flex justify-between">

                <p class="text-xl font-extralight">Se encontraron: {{ count($articles_filtered) }} registros con los filtros seleccionados.</p>

                <button wire:click="downloadExcel(2)" class="text-white flex border rounded-full px-2 py-1 bg-green-500 hover:bg-green-700">

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

                                Nombre

                            </th>

                            <th class="px-1 py-3 hidden lg:table-cell">

                                Marca / #Serie

                            </th>

                            <th class="px-1 py-3 hidden lg:table-cell">

                                Stock

                            </th>

                            <th class="px-1 py-3 hidden lg:table-cell">

                                Descripción

                            </th>

                            <th class="px-1 py-3 hidden lg:table-cell">

                                Categoría

                            </th>

                            <th class="px-1 py-3 hidden lg:table-cell">

                                Ubicación

                            </th>

                            <th class="px-1 py-3 hidden lg:table-cell">

                                Registro

                            </th>

                            <th class="px-1 py-3 hidden lg:table-cell">

                                Actualizado

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                        @foreach($articles_filtered as $article)

                            <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                <td class="px-3 py-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>

                                    <p class="text-sm font-medium text-gray-900">{{ $article->name }}</p>

                                </td>

                                <td class="px-3 py-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Marca / #Serie</span>

                                    <p class="text-sm font-medium text-gray-900 capitalize">{{ $article->brand }}</p>

                                    @if($article->serial)
                                        <p>#Serie: {{ $article->serial }}</p>
                                    @endif

                                </td>

                                <td class="px-3 py-3 w-full lg:w-auto text-gray-800 text-center lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Stock</span>

                                    @if ($article->serial)
                                        <span class="bg-blue-400 text-white rounded-full py-1 px-4">{{ $article->stock }}</span>

                                    @else

                                        @if($article->stock >= 20)
                                            <span class="bg-green-400 text-white rounded-full py-1 px-4">{{ $article->stock }}</span>
                                        @elseif($article->stock <= 20 && $article->stock > 10)
                                            <span class="bg-yellow-400 text-white rounded-full py-1 px-4">{{ $article->stock }}</span>
                                        @elseif($article->stock <= 10)
                                            <span class="bg-red-400 text-white rounded-full py-1 px-4">{{ $article->stock }}</span>
                                        @endif

                                    @endif

                                </td>

                                <td class="px-3 py-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">descripción</span>

                                    <p class="text-sm font-medium text-gray-900">{{ Str::limit($article->description, 100) }}</p>

                                </td>

                                <td class="px-3 py-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Categoría</span>

                                    <p class="text-sm font-medium text-gray-900">{{ $article->category->name }}</p>

                                </td>

                                <td class="px-3 py-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Ubicación</span>

                                    <p class="text-sm font-medium text-gray-900 capitalize">{{ $article->location }}</p>

                                </td>

                                <td class="px-3 py-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                    @if($article->created_by != null)

                                        <span class="font-semibold">Registrado por: {{$article->createdBy->name}}</span> <br>

                                    @endif

                                    {{ $article->created_at }}

                                </td>

                                <td class="px-3 py-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                    @if($article->updated_by != null)

                                        <span class="font-semibold">Actualizado por: {{$article->updatedBy->name}}</span> <br>

                                    @endif

                                    {{ $article->updated_at }}

                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                    <tfoot class="border-gray-300 bg-gray-50">

                        {{-- <tr>

                            <td colspan="10" class="py-2 px-5">
                                {{ $articles->links()}}
                            </td>

                        </tr> --}}

                    </tfoot>

                </table>

                <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading wire:target="articles_filtered">

                    <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

                </div>

            </div>

        @else

            <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                No hay resultados.

            </div>

        @endif

    @endif

    @if($entries_filtered)

        @if (count($entries_filtered))

            <div class="rounded-lg shadow-xl mb-5 p-4 font-thin flex justify-between">

                <p class="text-xl font-extralight">Se encontraron: {{ count($entries_filtered) }} registros con los filtros seleccionados.</p>

                <button wire:click="downloadExcel(1)" class="text-white flex border rounded-full px-2 py-1 bg-green-500 hover:bg-green-700">

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

                        @foreach($entries_filtered as $entrie)

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

                        {{-- <tr>

                            <td colspan="10" class="py-2 px-5">
                                {{ $entries->links()}}
                            </td>

                        </tr> --}}

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

    @endif


</div>
