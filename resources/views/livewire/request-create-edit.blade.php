<div>

    <div class="grid grid-1 md:grid-cols-3 gap-2 ">

        <div class="col-span-1 md:col-span-2 order-2 md:order-1 rounded-xl border-t-2 border-green-500 shadow-lg">

            <div class="flex justify-between items-center mt-2 mx-2">

                <p class="text-xl text-gray-500 my-3 ml-4">Artículos Disponibles</p>

                <input type="text" wire:model="search" placeholder="Buscar" class="bg-white rounded-full text-sm mb-2">

            </div>

            @if($articles->count())

            <div class="relative overflow-x-auto rounded-lg">

                <table class="rounded-lg w-full">

                    <thead class="border-b border-gray-300 bg-gray-50">

                        <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                            <th class="px-3 py-3 hidden lg:table-cell">Acciones</th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Nombre

                            </th>

                            <th class=" px-3 py-3 hidden lg:table-cell">

                                Descripción

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                        @foreach($articles as $article)

                            <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Acciones</span>

                                        @livewire('request-add-article', ['article' => $article], key($article->id))

                                </td>

                                <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>

                                    <p class="text-sm font-medium text-gray-900">{{ $article->name }} / {{ $article->brand }}</p>

                                    @if ($article->serial)
                                        <p># Serie: {{ $article->serial }}</p>
                                    @endif

                                </td>

                                <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">descripción</span>

                                    <p class="text-sm font-medium text-gray-900">{{ $article->description }}</p>

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

        </div>

        <div class="col-span-1 w-full order-1 md:order-2 rounded-xl border-t-2 border-blue-500 shadow-lg">

            <p class="text-xl text-gray-500 my-3 ml-4">Artículos Solicitados</p>

                @if(count($requestedArticles) > 0)

                    <div class="relative overflow-x-auto rounded-lg ">

                        <table class="rounded-lg w-full">

                            <thead class="border-b border-gray-300 bg-gray-50">

                                <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                                    <th class="px-3 py-3 hidden lg:table-cell">Cantidad</th>

                                    <th class="px-3 py-3 hidden lg:table-cell">

                                        Nombre

                                    </th>

                                    <th class="px-3 py-3 hidden lg:table-cell">Acciones</th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                                @foreach($requestedArticles as $article)

                                    <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>

                                            <p class="text-sm font-medium text-gray-900">{{ $article['quantity'] }}</p>

                                        </td>

                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>

                                            <p class="text-sm font-medium text-gray-900">{{ $article['article'] }} / {{ $article['brand'] }}</p>

                                            @if ($article['serial'])

                                            <p class="text-sm font-medium text-gray-900">#Serie: {{ $article['serial'] }}</p>

                                            @endif

                                        </td>

                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Acciones</span>

                                            <div class="flex items-center space-x-2">

                                                <button
                                                    wire:click="deleteArticle('{{ json_encode($article, JSON_FORCE_OBJECT) }}' )"
                                                    wire:loading.attr="disabled"
                                                    wire:target="deleteArticle('{{ json_encode($article, JSON_FORCE_OBJECT) }}' )"
                                                    class="bg-red-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-2 rounded-full hover:bg-red-700 flex focus:outline-none"
                                                >

                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>

                                                </button>

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                        <div class="p-2">

                            <p class="textr-sm">Comentarios:</p>

                            <textarea  wire:model.defer="comment" class="bg-white rounded text-sm w-full"></textarea>

                        </div>

                        @if ($request)

                            <button
                                wire:click="updateRequest({{ $request_id }})"
                                wire:loading.attr="disabled"
                                wire:target="updateRequest({{ $request_id }})"
                                class="rounded-full  text-white bg-green-500 my-2 py-2 px-4 float-right hover:bg-green-700"
                            > Actualizar Solicitud
                            </button>

                        @else

                            <button
                                wire:click=""
                                wire:loading.attr="disabled"
                                wire:target=""
                                class="rounded-full  text-white bg-green-500 my-2 py-2 px-4 float-right hover:bg-green-700"
                            > Finalizar Solicitud
                            </button>

                        @endif




                    </div>

                    @else

                        <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 w-full rounded-full text-lg">

                            No has solicitado artículos.

                        </div>

                @endif

        </div>

    </div>

</div>
