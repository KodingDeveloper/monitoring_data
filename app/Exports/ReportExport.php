<?php


namespace App\Exports;

use App\Models\Pegawai;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport extends SharedStyle implements Responsable, WithHeadings, ShouldAutoSize, WithStyles, WithColumnFormatting, WithStrictNullComparison
{

    use Exportable;

    private $fileName = 'report.xlsx';
    private $writerType = Excel::XLSX;

    protected $data_pegawai;

    public function __construct(array $data_pegawai)
    {
        $this->data_pegawai = $data_pegawai;
    }

    public function styles(Worksheet $sheet)
    {
        $style = $this->defaultStyle();
        $sheet->mergeCells('A1:BL1');
        $sheet->getStyle('A1:BL1')->applyFromArray($style['title']);
        $sheet->getStyle('A3:BL3')->applyFromArray($style['header_table_one']);
        $sheet->mergeCells('A3:BL3');
        $sheet->getStyle('A4:BL4')->applyFromArray($style['header_table_two']);
        $sheet->getStyle('A7:BL7')->applyFromArray($style['header_table_one']);
        $sheet->mergeCells('A7:BL7');
        $sheet->getStyle('A8:BL8')->applyFromArray($style['header_table_two']);
        $sheet->getStyle('A3:BL5')->applyFromArray($style['border_table']);
        $sheet->getStyle('A7:BL9')->applyFromArray($style['border_table']);

        $sheet->mergeCells('A12:A14');
        $sheet->getStyle('A12:A14')->applyFromArray($style['header_table_one']);
        $sheet->mergeCells('A16:A18');
        $sheet->getStyle('A16:A18')->applyFromArray($style['header_table_one']);

        $sheet->getStyle('B13:B13')->applyFromArray($style['extra']);
        $sheet->getStyle('B17:B17')->applyFromArray($style['extra']);
    }

    public function headings(): array
    {
        $labels = config('constants.pegawai');

        foreach($labels as $label) {
            $coloumnName[] = $label === 'Updated At' ? 'Last Mode Date' : $label;
        }

        $dataEmpty = [];
        foreach ($labels as $label) {
            $fieldName = str_replace(' ', '_', strtolower($label));
            $dataEmpty[] = Pegawai::whereNull($fieldName)->where('status', 'A')->count();
        }

        $monitoring = [];
        foreach ($labels as $label) {
            $fieldName = str_replace(' ', '_', strtolower($label));
            $monitoring[] = Pegawai::join('pegawai_tmps', function ($join) use ($fieldName) {
                $join->on('pegawais.employee_code', '=', 'pegawai_tmps.employee_code')
                    ->where(DB::raw('pegawais.' . $fieldName), '<>', DB::raw('pegawai_tmps.' . $fieldName));
            })->count();
        }

        $totalPegawai = [
            'active' => Pegawai::where('status', 'A')->count(),
            'inactive' => Pegawai::where('status', 'Z')->count(),
        ];

        return [
            ['REPORT DEMOGRAPHY'],
            [''],
            ['Data Kolom yang Kosong'],
            $coloumnName,
            $dataEmpty,
            [''],
            ['Data Total Pegawai Belum di Update'],
            $coloumnName,
            $monitoring,
            [''],
            [''],
            ['Total Pegawai Active'],
            ['', $totalPegawai['active']],
            [''],
            [''],
            ['Total Pegawai Inactive'],
            ['', $totalPegawai['inactive']],
        ];
    }

    public function columnFormats(): array
    {
//        'C' => NumberFormat::FORMAT_TEXT,
//            'G' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
//            'H' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
//            'I' => NumberFormat::FORMAT_TEXT,
//            'J' => NumberFormat::FORMAT_TEXT,
//            'K' => NumberFormat::FORMAT_TEXT,
        return [
        ];
    }

}
