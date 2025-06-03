<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarModel;
use App\Models\Generation;
use App\Models\Equipment;

class AjaxController extends Controller
{
    public function getModels(Request $request)
    {
        $query = CarModel::query();
        
        if ($request->brand_id) {
            $query->where('brand_id', $request->brand_id);
        }
        
        if ($request->search) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }
        
        return $query->select('id', 'name')->get();
    }
    
    public function getGenerations(Request $request)
    {
        $query = Generation::query();
        
        if ($request->model_id) {
            $query->where('car_model_id', $request->model_id);
        }
        
        if ($request->search) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }
        
        return $query->select('id', 'name', 'year_from')->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'text' => "{$item->name} ({$item->year_from})"
                ];
            });
    }
    
    public function getEquipments(Request $request)
    {
        $query = Equipment::query();
        
        if ($request->generation_id) {
            $query->where('generation_id', $request->generation_id);
        }
        
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%');
            });
        }
        
        return $query->select('id', 'name')
                    ->get()
                    ->map(function($item) {
                        return [
                            'id' => $item->id,
                            'text' => $item->name
                        ];
                    });
    }
}
