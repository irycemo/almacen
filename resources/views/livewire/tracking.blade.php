<div class="">

    <div class="mb-5">

        <h1 class="titulo-seccion text-3xl font-thin text-gray-500 mb-3">Seguimiento de artículos</h1>

    </div>

    <div class="mb-5">

        <h2 class="titulo-seccion text-2xl font-thin text-gray-500 mb-3">Artícluos</h2>

        <input type="text" wire:model="search" placeholder="Buscar artículo" class="bg-white rounded-full text-sm">

    </div>

    @if ($showArticles)

        @if (count($articles))

            <div class="relative overflow-x-auto rounded-lg shadow-xl mb-7">

                <table class="rounded-lg w-full">

                    <thead class="border-b border-gray-300 bg-gray-50">

                        <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Nombre / Marca / #Serie

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Ubicación

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">Acciones</th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none">

                        @foreach($articles as $article)

                            <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>

                                    <p>{{ $article->name }} / {{ $article->brand }}</p>

                                    @if ($article->serial)
                                        <p># Serie: {{ $article->serial }}</p>
                                    @endif

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3  text-gray-800 text-center md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Ubicación</span>

                                    {{ $article->location }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Acciones</span>

                                    <div class="flex justify-center lg:justify-start">

                                        <button
                                                wire:click="viewDetails({{ $article }})"
                                                wire:loading.attr="disabled"
                                                wire:target="viewDetails({{ $article }})"
                                                class="bg-green-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-2 rounded-full mr-2 hover:bg-green-700 flex focus:outline-none"
                                            >


                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Seleccionar
                                        </button>

                                    </div>

                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                    <tfoot class="border-gray-300 bg-gray-50">

                        <tr>

                            <td colspan="8" class="py-2 px-5">
                                {{ $articles->links()}}
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

    @endif

    @if ($articleDescription)

            <div class="rounded-lg shadow-xl mb-7 p-3 text-gray-500 bg-white">

                <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                    <div class="flex-auto ">

                        <div>

                            <Label class="text-gray-600">Nombre</Label>

                        </div>

                        <div>

                            <p class="bg-white rounded border border-gray-400 px-4 py-1">{{ $article->name }}</p>

                        </div>

                    </div>

                    <div class="flex-auto ">

                        <div>

                            <Label class="text-gray-600">Marca</Label>

                        </div>

                        <div>

                            <p class="bg-white rounded border border-gray-400 px-4 py-1">{{ $article->brand}}</p>

                        </div>

                    </div>

                    @if ($article->serial)

                        <div class="flex-auto ">

                            <div>

                                <Label class="text-gray-600"># Serie</Label>

                            </div>

                            <div>

                                <p class="bg-white rounded border border-gray-400 px-4 py-1">{{ $article->serial }}</p>

                            </div>

                        </div>

                    @else

                        <div class="flex-auto ">

                            <div>

                                <Label class="text-gray-600">Stock</Label>

                            </div>

                            <div>

                                <p class="bg-white rounded border border-gray-400 px-4 py-1">{{ $article->stock }}</p>

                            </div>

                        </div>

                    @endif

                    <div class="flex-auto ">

                        <div>

                            <Label class="text-gray-600">Ubicación</Label>

                        </div>

                        <div>

                            <p class="bg-white capitalize rounded border border-gray-400 px-4 py-1">{{ $article->location }}</p>

                        </div>

                    </div>

                    <div class="flex-auto ">

                        <div>

                            <Label class="text-gray-600">Categoría</Label>

                        </div>

                        <div>

                            <p class="bg-white capitalize rounded border border-gray-400 px-4 py-1">{{ $article->category->name }}</p>

                        </div>

                    </div>

                    @if ($article->created_by)

                        <div class="flex-auto ">

                            <div>

                                <Label class="text-gray-600">Registrado por:</Label>

                            </div>

                            <div>

                                <p class="bg-white capitalize rounded border border-gray-400 px-4 py-1">{{ $article->createdBy->name }}</p>

                            </div>

                        </div>

                    @endif

                    @if ($article->updated_by)

                        <div class="flex-auto ">

                            <div>

                                <Label class="text-gray-600">Actualizado por:</Label>

                            </div>

                            <div>

                                <p class="bg-white capitalize rounded border border-gray-400 px-4 py-1">{{ $article->updatedBy->name }}</p>

                            </div>

                        </div>

                    @endif

                </div>

                <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                    <div class="flex-auto ">

                        <div>

                            <Label class="text-gray-600">Descripción</Label>

                        </div>

                        <div>

                            <p class="bg-white capitalize rounded border border-gray-400 px-4 py-1">{{ $article->description }}</p>

                        </div>

                    </div>

                </div>

                <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">



                </div>

            </div>

            @if(count($article->entries))

                <h2 class="titulo-seccion text-2xl font-thin text-gray-500 mb-3">Entradas</h2>

                <div class="rounded-lg shadow-xl mb-7 p-3 text-gray-500 bg-white">

                    <div class="relative overflow-x-auto rounded-lg">

                        <table class="rounded-lg w-full">

                            <thead class="border-b border-gray-300 bg-gray-50">

                                <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                                    <th class="px-1 py-3 hidden lg:table-cell">

                                        Artículo / Marca

                                    </th>

                                    <th class="px-1 py-3 hidden lg:table-cell">

                                        Cantidad

                                    </th>

                                    <th class="px-1 py-3 hidden lg:table-cell">

                                        Costo

                                    </th>

                                    <th class="px-1 py-3 hidden lg:table-cell">

                                        Ubicación

                                    </th>

                                    <th class="px-1 py-3 hidden lg:table-cell">

                                        Origen

                                    </th>

                                    <th class=" px-1 py-3 hidden lg:table-cell">

                                        Descripción

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

                                @foreach($article->entries as $entrie)

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

                                            <p class="text-sm font-medium text-gray-900 capitalize">{{ $entrie->price }}</p>

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

                </div>

            @endif

    @endif

    @if($showRequests)

        <h2 class="titulo-seccion text-2xl font-thin text-gray-500 mb-3">Solicitudes</h2>

        @if(count($requests))

            <div class="relative overflow-x-auto rounded-lg shadow-xl">

                <table class="rounded-lg w-full">

                    <thead class="border-b border-gray-300 bg-gray-50">

                        <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                            <th wire:click="order('number')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                                Número

                                @if($sort == 'number')

                                    @if($direction == 'asc')

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                        </svg>

                                    @else

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                        </svg>

                                    @endif

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>

                                @endif

                            </th>

                            <th  class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                                Contenido

                            </th>

                            <th wire:click="order('created_by')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                                Solicitante

                                @if($sort == 'created_by')

                                    @if($direction == 'asc')

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                        </svg>

                                    @else

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                        </svg>

                                    @endif

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>

                                @endif

                            </th>

                            <th wire:click="order('status')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                                Estado

                                @if($sort == 'status')

                                    @if($direction == 'asc')

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                        </svg>

                                    @else

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                        </svg>

                                    @endif

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>

                                @endif

                            </th>

                            <th wire:click="order('location')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                                Ubicación

                                @if($sort == 'location')

                                    @if($direction == 'asc')

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                        </svg>

                                    @else

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                        </svg>

                                    @endif

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>

                                @endif

                            </th>

                            <th wire:click="order('created_at')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                                Registro

                                @if($sort == 'created_at')

                                    @if($direction == 'asc')

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                        </svg>

                                    @else

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                        </svg>

                                    @endif

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>

                                @endif

                            </th>

                            <th wire:click="order('updated_at')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                                Actualizado

                                @if($sort == 'updated_at')

                                    @if($direction == 'asc')

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                        </svg>

                                    @else

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                        </svg>

                                    @endif

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>

                                @endif

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">Acciones</th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none">

                        @foreach($requests as $request)

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

                                <td class="capitalize w-full lg:w-auto p-3  text-gray-800 text-center md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>

                                    {{ $request->createdBy->location }}

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

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Acciones</span>

                                    <div class="flex justify-center lg:justify-start">

                                        <button
                                                wire:click="openModalDetail({{$request}})"
                                                wire:loading.attr="disabled"
                                                wire:target="openModalDetail({{$request}})"
                                                class="bg-green-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-2 rounded-full mr-2 hover:bg-green-700 flex focus:outline-none"
                                            >


                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Ver
                                        </button>

                                    </div>

                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                    <tfoot class="border-gray-300 bg-gray-50">

                        <tr>

                            <td colspan="8" class="py-2 px-5">
                                {{-- {{ $requests->links()}} --}}
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

    @endif

    <x-jet-dialog-modal wire:model="modal" maxWidth="sm">

        <x-slot name="title">

            <div class="flex justify-between items-center">

                <p>Detalles de la solicitud</p>

                <button
                    wire:click="closeModal"
                    wire:loading.attr="disabled"
                    wire:target="closeModal"
                    type="button"
                    class="bg-gray-400 hover:shadow-lg text-white px-2 py-1 rounded-full text-xs hover:bg-gray-500 flaot-left focus:outline-none">
                    X
                </button>
            </div>

        </x-slot>

        <x-slot name="content">

            <div class=" font-thin text-gray-600 mb-3">

                <p>Número de solicitud: {{ $request_number }}</p>

                <p>Solicitante: {{ $request_author }}</p>

                <p>Fecha de solicitud: {{ $request_created_at }}</p>

            </div>

            <div class="flex flex-col md:flex-row justify-center md:space-x-3 mb-5">

                <table class="rounded-lg w-full">

                    <thead class="border-b border-gray-300 bg-gray-50">

                        <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                            <th class="px-3 py-3 hidden lg:table-cell">Cantidad</th>

                            <th wire:click="order('name')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                                Nombre

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                        @foreach($request_content as $item)

                            <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Cantidad</span>

                                    <p class="text-sm font-medium text-gray-900">{{ $item['quantity'] }}</p>

                                </td>

                                <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>

                                    <p class="text-sm font-medium text-gray-900">{{ $item['article'] }} / {{ $item['brand'] }}</p>

                                    @if ($item['serial'])

                                        <p class="text-sm font-medium text-gray-900">#Serie: {{ $item['serial'] }}</p>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="text-sm">

                <p>Comentarios:</p>

                <div class=" font-thin text-gray-600 mb-3">

                    {{ $request_comment }}

                </div>

            </div>

        </x-slot>

        <x-slot name="footer">

        </x-slot>

    </x-jet-dialog-modal>

</div>
