<div class="">

    <div class="mb-5">

        <h1 class="titulo-seccion text-3xl font-thin text-gray-500 mb-3">Solicitudes</h1>

        <div>

            <input type="text" wire:model="search" placeholder="Buscar" class="bg-white rounded-full text-sm">

            @can('Crear solicitud')

                <a href="{{ route('requests.create') }}" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right mb-5 text-sm py-2 px-4 text-white rounded-full focus:outline-none hidden md:block">Agregar nueva solicitud</a>

                <a href="{{ route('requests.create') }}" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right mb-5 text-sm py-2 px-4 text-white rounded-full focus:outline-none md:hidden">+</a>

            @endcan

        </div>

    </div>

    @if($requests->count())

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

                        <th wire:click="order('location')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Ubicaión

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

                                    @can('Borrar solicitud')

                                        @if ($request->status != 'entregada')

                                            <button
                                                wire:click="openModalDelete({{$request}})"
                                                wire:loading.attr="disabled"
                                                wire:target="openModalDelete({{$request}})"
                                                class="bg-red-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-2 rounded-full hover:bg-red-700 flex focus:outline-none mr-2"
                                            >

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>

                                                <p>Eliminar</p>

                                            </button>

                                        @endif

                                    @endcan

                                    @can('Editar solicitud')

                                        @if ($request->status == 'aceptada' || $request->status == 'solicitada')

                                            <a
                                                href="{{ route('requests.edit', $request) }}"
                                                    class="bg-blue-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-2 rounded-full hover:bg-blue-700 flex focus:outline-none"
                                                >

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>

                                                <p>Editar</p>

                                            </a>

                                        @endif

                                    @endcan

                                </div>

                            </td>
                        </tr>

                    @endforeach

                </tbody>

                <tfoot class="border-gray-300 bg-gray-50">

                    <tr>

                        <td colspan="8" class="py-2 px-5">
                            {{ $requests->links()}}
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

            <div class="mb-5 w-full">

                <table class="rounded-lg w-full">

                    <thead class="border-b border-gray-300 bg-gray-50">

                        <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                            <th class="px-3 py-3 hidden lg:table-cell">Cantidad</th>

                            <th wire:click="order('name')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                                Nombre

                            </th>

                            @if ($request_status != 'rechazada' && $request_status != 'entregada')

                                @can("Aceptar solicitud")
                                    <th class="px-3 py-3 hidden lg:table-cell">Disponibilidad</th>
                                @endcan

                            @endif

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
                                @if ($request_status != 'rechazada' && $request_status != 'entregada')

                                    @can("Aceptar solicitud")

                                        <td>

                                            @livewire('request-available-article', ['article_id' => $item['id']], key($item['id']))

                                        </td>
                                    @endcan

                                @endif

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="text-sm">

                <p>Comentario:</p>

                <div class=" font-thin text-gray-600 mb-3">

                    {{ $request_comment }}

                </div>

            </div>

        </x-slot>

        <x-slot name="footer">

            @if (auth()->user()->roles[0]->id != 4 && ($request_status === 'solicitada' || $request_status === 'aceptada'))

                <div class="float-righ">

                    @can("Aceptar solicitud")

                        @if($request_status === 'solicitada' || !$request_status === 'aceptada')
                            <button
                                wire:click="process(1)"
                                wire:loading.attr="disabled"
                                wire:target="process(1)"
                                class="bg-green-400 hover:shadow-lg text-white px-4 py-2 rounded-full text-sm mb-2 hover:bg-green-700 flaot-left mr-1 focus:outline-none">
                                Aceptar
                            </button>
                        @endif

                    @endcan

                    <button
                        wire:click="process(2)"
                        wire:loading.attr="disabled"
                        wire:target="process(2)"
                        class="bg-gray-400 hover:shadow-lg text-white px-4 py-2 rounded-full text-sm mb-2 hover:bg-gray-700 flaot-left mr-1 focus:outline-none">
                        Entregar
                    </button>

                    <button
                        wire:click="process(3)"
                        wire:loading.attr="disabled"
                        wire:target="process(3)"
                        type="button"
                        class="bg-red-400 hover:shadow-lg text-white px-4 py-2 rounded-full text-sm mb-2 hover:bg-red-700 flaot-left focus:outline-none">
                        Rechazar
                    </button>

                </div>

                <div class="text-sm text-left">

                    <p class="textr-sm">Comentarios:</p>

                    <textarea  wire:model.defer="comment" class="bg-white rounded text-sm w-full"></textarea>

                    <div>

                        @error('comment') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            @endif

            @if ($request_status == 'entregada')

                <a
                    href="{{ route('requests.receipt', $request_id) }}"
                    target="_blank"
                    class="bg-gray-400 hover:shadow-lg text-white  px-4 py-2 rounded-full text-sm mb-2 hover:bg-gray-700 flaot-left focus:outline-none">
                    Imprimir Recibo
                </a>

            @endif

        </x-slot>

    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="modalDelete">

        <x-slot name="title">
            Eliminar Solicitud
        </x-slot>

        <x-slot name="content">
            ¿Esta seguro que desea eliminar la solicitud?, No sera posible recuperar la información.
        </x-slot>

        <x-slot name="footer">

            <x-jet-secondary-button
                wire:click="$toggle('modalDelete')"
                wire:loading.attr="disabled"
            >
                No
            </x-jet-secondary-button>

            <x-jet-danger-button
                class="ml-2"
                wire:click="delete()"
                wire:loading.attr="disabled"
                wire:target="delete"
            >
                Borrar
            </x-jet-danger-button>

        </x-slot>

    </x-jet-confirmation-modal>

    <script>

        window.addEventListener('receipt', event => {
            window.open(event.detail, "_blank");
        });

    </script>

</div>