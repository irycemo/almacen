<?php

namespace App\Exports;

use App\Models\Entrie;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class EntriesExport implements FromCollection,  WithProperties, WithDrawings, ShouldAutoSize, WithEvents, WithCustomStartCell, WithColumnWidths, WithHeadings, WithMapping
{

    public function __construct($article_id, $location, $origin, $price1, $price2, $date1, $date2)
    {
        $this->article_id = $article_id;
        $this->location = $location;
        $this->origin = $origin;
        $this->price1 = $price1;
        $this->price2 = $price2;
        $this->date1 = $date1;
        $this->date2 = $date2;
    }

    public function headings(): array
    {
        return [
            'Artículo',
            'Cantidad',
            'Precio',
            'Ubicación',
            'Origen',
            'Descripción',
            'Registrado por',
            'Actualizado por',
            'Registrado en',
            'Actualizado en'
        ];
    }

    public function collection()
    {

        $query = Entrie::query()->with('createdBy','updatedBy','article');

        $query->when(isset($this->article_id) && $this->article_id != "", function($query){
            return $query->where('article_id', $this->article_id);
        })
        ->when(isset($this->location) && $this->location != "", function($query){
            return $query->where('location', $this->location);
        })
        ->when(isset($this->origin) && $this->origin != "", function($query){
            return $query->where('origin', $this->origin);
        })
        ->when(isset($this->price1) && isset($this->price2) && $this->price1 != ""  && $this->price2 != "", function($query){
            return $query->whereBetween('price', [$this->price1, $this->price2]);
        });

        return $query->whereBetween('created_at', [$this->date1, $this->date2])->get();
    }

    public function properties(): array
    {
        return [
            'creator'        => auth()->user()->name,
            'title'          => 'Reporte de entradas (Sistema de Almacen)',
            'company'        => 'Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo',
        ];
    }

    public function map($entrie): array
    {
        return [
            $entrie->article->name,
            $entrie->quantity,
            $entrie->price,
            Str::ucfirst($entrie->location),
            Str::ucfirst($entrie->origin),
            $entrie->description,
            $entrie->createdBy ? $entrie->createdBy->name : 'N/A',
            $entrie->updatedBy ? $entrie->updatedBy->name : 'N/A',
            $entrie->created_at,
            $entrie->updated_at,
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath(storage_path('app/public/img/logo2.png'));
        $drawing->setHeight(90);
        $drawing->setOffsetX(10);
        $drawing->setOffsetY(10);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->mergeCells('A1:J1');
                $event->sheet->setCellValue('A1', "Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo\nReporte de entradas (Sistema de Almacen)\n" . now()->format('d-m-Y'));
                $event->sheet->getStyle('A1')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A1:J1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 13
                    ],
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    ],
                ]);
                $event->sheet->getRowDimension('1')->setRowHeight(90);
                $event->sheet->getStyle('A2:J2')->applyFromArray([
                        'font' => [
                            'bold' => true
                        ]
                    ]
                );
            },
        ];
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function columnWidths(): array
    {
        return [
            'F' => 55,
        ];
    }
}
