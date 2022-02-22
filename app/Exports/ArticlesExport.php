<?php

namespace App\Exports;

use App\Models\Article;
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

class ArticlesExport implements FromCollection,  WithProperties, WithDrawings, ShouldAutoSize, WithEvents, WithCustomStartCell, WithColumnWidths, WithHeadings, WithMapping
{

    public function __construct($name, $location, $brand, $category_id, $date1, $date2)
    {
        $this->name = $name;
        $this->location = $location;
        $this->brand = $brand;
        $this->category_id = $category_id;
        $this->date1 = $date1;
        $this->date2 = $date2;
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Marca',
            '# Serie',
            'Stock',
            'Descripción',
            'Categoría',
            'Ubicación',
            'Registrado por',
            'Actualizado por',
            'Registrado en',
            'Actualizado en'
        ];
    }

    public function collection()
    {

        $query = Article::query()->with('createdBy','updatedBy', 'category');

        $query->when(isset($this->name) && $this->name != "", function($query){
            return $query->where('name', 'LIKE', '%' . $this->name . '%');
        })
        ->when(isset($this->brand) && $this->brand != "", function($query){
            return $query->where('brand', 'LIKE', '%' . $this->brand . '%');
        })
        ->when(isset($this->category_id) && $this->category_id != "", function($query){
            return $query->where('category_id', $this->category_id);
        })
        ->when(isset($this->location) && $this->location != "", function($query){
            return $query->where('location', $this->location);
        });

        return $query->whereBetween('created_at', [$this->date1, $this->date2])->get();
    }

    public function properties(): array
    {
        return [
            'creator'        => auth()->user()->name,
            'title'          => 'Reporte de artículos (Sistema de Almacen)',
            'company'        => 'Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo',
        ];
    }

    public function map($article): array
    {
        return [
            $article->name,
            $article->brand,
            $article->serial ? $article->serial : 'N/A',
            $article->stock,
            $article->description,
            $article->category->name,
            Str::ucfirst($article->location),
            $article->createdBy ? $article->createdBy->name : 'N/A',
            $article->updatedBy ? $article->updatedBy->name : 'N/A',
            $article->created_at,
            $article->updated_at,
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
                $event->sheet->mergeCells('A1:K1');
                $event->sheet->setCellValue('A1', "Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo\nReporte de entradas (Sistema de Almacen)\n" . now()->format('d-m-Y'));
                $event->sheet->getStyle('A1')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A1:K1')->applyFromArray([
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
                $event->sheet->getStyle('A2:K2')->applyFromArray([
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
            'E' => 45,
            'F' => 20,

        ];
    }
}
