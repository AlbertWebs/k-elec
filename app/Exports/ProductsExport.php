<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ProductsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Product::with('category');

        // Apply the same filters as the index method
        if (isset($this->filters['search']) && $this->filters['search']) {
            $query->where('name', 'like', '%' . $this->filters['search'] . '%')
                  ->orWhere('description', 'like', '%' . $this->filters['search'] . '%');
        }

        if (isset($this->filters['category']) && $this->filters['category']) {
            $query->where('category_id', $this->filters['category']);
        }

        if (isset($this->filters['status']) && $this->filters['status'] !== null && $this->filters['status'] !== '') {
            $query->where('is_active', $this->filters['status']);
        }

        return $query->latest()->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Category',
            'Brand',
            'Description',
            'Price (KES)',
            'Old Price (KES)',
            'Stock Quantity',
            'Rating',
            'Reviews Count',
            'Badge',
            'Status',
            'Featured',
            'Created At',
            'Updated At',
        ];
    }

    /**
     * @param Product $product
     * @return array
     */
    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->category->name ?? 'N/A',
            $product->brand ?? 'N/A',
            strip_tags($product->description),
            number_format($product->price, 2),
            $product->old_price ? number_format($product->old_price, 2) : 'N/A',
            $product->stock_quantity,
            $product->rating,
            $product->reviews_count,
            $product->badge ?? 'N/A',
            $product->is_active ? 'Active' : 'Inactive',
            $product->is_featured ? 'Yes' : 'No',
            $product->created_at->format('Y-m-d H:i:s'),
            $product->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }
}
