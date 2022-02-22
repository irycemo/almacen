<?php

namespace App\Exports;

use App\Models\Request;
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

class RequestsExport implements FromCollection,  WithProperties, WithDrawings, ShouldAutoSize, WithEvents, WithCustomStartCell, WithColumnWidths, WithHeadings, WithMapping
{

    public function __construct($article_id, $location, $status, $user, $date1, $date2)
    {
        $this->article_id = $article_id;
        $this->location = $location;
        $this->status = $status;
        $this->user = $user;
        $this->date1 = $date1;
        $this->date2 = $date2;
    }

    public function headings(): array
    {
        return [
            'Número',
            'Contenido',
            'Estado',
            'Ubicación',
            'Comentario',
            'Registrado por',
            'Actualizado por',
            'Registrado en',
            'Actualizado en'
        ];
    }

    public function collection()
    {

        $query = Request::query()->with('createdBy','updatedBy');

        $query->when(isset($this->article_id) && $this->article_id != "", function($query){
            return $query->where('content', 'LIKE', '%' . $this->article_id . '%');
        })
        ->when(isset($this->status) && $this->status != "", function($query){
            return $query->where('status', $this->status);
        })
        ->when(isset($this->location) && $this->location != "", function($query){
            return $query->where('location', $this->location);
        })
        ->when(isset($this->user) && $this->user, function($query){
            return $query->where('created_by', $this->user);
        });

        return $query->whereBetween('created_at', [$this->date1, $this->date2])->get();
    }

    public function properties(): array
    {
        return [
            'creator'        => auth()->user()->name,
            'title'          => 'Reporte de solicitudes (Sistema de Almacen)',
            'company'        => 'Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo',
        ];
    }

    public function contentFormat($request){

        $content = json_decode($request->content, true);

        $string = "";

        foreach ($content as $item) {
            $string .= " - Articulo: " . $item['article'] . "\n";
            $string .= "\tMarca: " . $item['brand'] . "\n";
            $string .= "\t#Serie: " . $item['serial'] . "\n";
            $string .= "\tCantidad: " . $item['quantity'] . "\n";
        }

        return $string;
    }

    public function map($request): array
    {
        return [
            $request->number,
            $this->contentFormat($request),
            Str::ucfirst($request->status),
            Str::ucfirst($request->location),
            $request->comment,
            $request->createdBy ? $request->createdBy->name : 'N/A',
            $request->updatedBy ? $request->updatedBy->name : 'N/A',
            $request->created_at,
            $request->updated_at,
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
                $event->sheet->mergeCells('A1:I1');
                $event->sheet->setCellValue('A1', "Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo\nReporte de solicitudes (Sistema de Almacen)\n" . now()->format('d-m-Y'));
                $event->sheet->getStyle('A1')->getAlignment()->setWrapText(true);
                /* $event->sheet->getStyle('B')->getAlignment()->setWrapText(true); */
                $event->sheet->getStyle('A1:I1')->applyFromArray([
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
                $event->sheet->getStyle('A2:I2')->applyFromArray([
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
            'B' => 55,
            'E' => 55,
        ];
    }
}
