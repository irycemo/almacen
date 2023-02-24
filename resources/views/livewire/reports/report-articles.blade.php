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

    <div class="flex flex-col md:flex-row justify-between md:space-x-3 bg-white rounded-xl mb-5 p-4">

        <div class="flex-auto ">

            <div>

                <Label>Nombre</Label>
            </div>

            <div>

                <input type="text" class="bg-white rounded text-sm w-full" wire:model="article_name">

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

                <input type="text" class="bg-white rounded text-sm w-full" wire:model="article_brand">

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

                <select class="bg-white rounded text-sm w-full" wire:model="article_category_id">

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

                <select class="bg-white rounded text-sm w-full" wire:model="article_location">
                    <option value="" selected>Selecciona una ubicación</option>

                    @foreach ($ubicaciones as $ubicacion)

                        <option value="{{ $ubicacion }}">{{ $ubicacion }}</option>

                    @endforeach

                </select>

            </div>

            <div>

                @error('article_location') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

    </div>

    @if(count($articles))

            <div class="rounded-lg shadow-xl mb-5 p-4 font-thin md:flex items-center justify-between bg-white">

                <p class="text-xl font-extralight">Se encontraron: {{ number_format($articles->total()) }} registros con los filtros seleccionados.</p>

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

                        @foreach($articles as $article)

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

                        <tr>

                            <td colspan="10" class="py-2 px-5">
                                {{ $articles->links()}}
                            </td>

                        </tr>

                    </tfoot>

                </table>

                <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading>

                    <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

                </div>

            </div>

        @else

            <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                No hay resultados.

            </div>

        @endif

</div>
