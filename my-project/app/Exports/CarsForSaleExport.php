<?php

namespace App\Exports;

use App\Models\Car;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CarsForSaleExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Car::with('equipment.generation.carModel.brand')->where('is_sold', false)->get();
    }

    public function map($car): array
    {
        return [
            $car->vin,
            $car->mileage,
            $car->price,
            $car->equipment->generation->carModel->brand->name ?? '-',
            $car->equipment->generation->carModel->name ?? '-',
            $car->equipment->generation->name ?? '-',
            $car->color->name ?? '-',
            $car->branch->name ?? '-',
        ];
    }

    public function headings(): array
    {
        return [
            'VIN',
            'Пробег',
            'Цена',
            'Марка',
            'Модель',
            'Поколение',
            'Цвет',
            'Филиал'
        ];
    }
}