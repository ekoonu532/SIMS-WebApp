<?php

namespace App\Exports;

use App\Models\Products;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromView, WithStyles
{
    protected $search;
    protected $filter;

    public function __construct($search, $filter)
    {
        $this->search = $search;
        $this->filter = $filter;
    }

    public function view(): View
    {
        $query = Products::query()
            ->leftJoin('categories as c', 'products.category_id', '=', 'c.id')
            ->select('products.*', 'c.nama as category_name');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('products.name', 'like', "%{$this->search}%")
                    ->orWhere('c.nama', 'like', "%{$this->search}%");
            });
        }

        if ($this->filter && $this->filter !== 'Semua') {
            $query->where('products.category_id', $this->filter);
        }

        $products = $query->get();

        return view('exports.products', ['products' => $products]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Styling untuk header (baris pertama)
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'], // Teks putih
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['rgb' => 'FF0000'], // Latar belakang merah
                ],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],
            ],
        ];
    }
}
