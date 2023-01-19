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

                <Label>Área</Label>
            </div>

            <div>

                <select class="bg-white rounded text-sm w-full" wire:model="expence_area">

                    <option value="" selected>Selecciona un artículo</option>

                    @foreach ($locations as $location)

                        <option value="{{ $location }}">{{ $location }}</option>

                    @endforeach

                </select>

            </div>

            <div>

                @error('expence_area') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

    </div>

    @if (count($expences))

        <div class="rounded-lg shadow-xl mb-5 p-4 font-thin flex justify-between bg-white">

            <p class="text-xl font-extralight">Se encontraron: {{ count($expences) }} solicitudes entreagas con los filtros seleccionados. Sumando ${{ $expencesSum }}</p>

        </div>

    @else

        <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

            No hay resultados.

        </div>

    @endif

</div>
