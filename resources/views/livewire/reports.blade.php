<div class="mb-5">

    <h1 class="text-3xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-thin mb-6  bg-white">Reportes</h1>

    <div class="mb-5 bg-white rounded-xl p-4">

        <div>

            <Label>Área</Label>

        </div>

        <div>

            <select class="bg-white rounded text-sm " wire:model="area">
                <option selected value="">Selecciona una área</option>
                <option value="1">Entradas</option>
                <option value="2">Artículos</option>
                <option value="3">Solicitudes</option>
                <option value="4">Gastos</option>
            </select>

        </div>

    </div>

    @if($showArticles)

        @livewire('reports.report-articles', ['date1' => $this->date1, 'date2' => $this->date2])

    @endif

    @if ($showEntries)

        @livewire('reports.report-entrie', ['date1' => $this->date1, 'date2' => $this->date2])

    @endif

    @if ($showRequests)

        @livewire('reports.report-request', ['date1' => $this->date1, 'date2' => $this->date2])

    @endif

    @if ($showExpences)

        @livewire('reports.report-expences', ['date1' => $this->date1, 'date2' => $this->date2])

    @endif

</div>
