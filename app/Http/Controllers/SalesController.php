<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    
    public function index()
    {
        return view('admin.sales.index');
    }

    public function create()
    {
        return view('admin.sales.create');
    }

    public function load(Request $request)
    {
        $model = \App\Models\Sales::where(function ($query) use ($request) {
            if(!auth()->user()->hasAnyRole(['super-administrator', 'administrator'])) {
                $query->orWhere('created_by', auth()->user()->UserInformation->full_name);
                $query->orWhere('created_by', auth()->user()->username);
            }
        })
        ->orderBy('created_at', 'DESC')
        ->select([
            'sales.*',
        ])
        ->get();

        return datatables()
                ->of($model)
                ->editColumn('created_at', function ($query) {
                    return "{$query->created_by} <br>{$query->created_at}";
                })
                ->editColumn('updated_at', function ($query) {
                    if(!is_null($query->updated_by)) {
                        return "{$query->updated_by} <br>{$query->updated_at}";
                    }
                })
                ->rawColumns([
                    'created_at',
                    'updated_at'
                ])
                ->toJson();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'station' => 'required',
            'field_coordinator' => 'required',
            'date' => [
                'required',
                'date',
                'date_format:Y-m-d',
            ],
            'draw_time' => 'required',
            'total_gross_pay' => [
                'required',
                'numeric',
                'gt:0'
            ],
            'total_net' => [
                'required',
                'numeric',
                'gt:0'
            ]
        ]);

        $model = new \App\Models\Sales;

        $model->station = $request->station;
        $model->field_coordinator = $request->field_coordinator;
        $model->date = $request->date;
        $model->draw_time = \Carbon::createFromFormat('h:i A', $request->draw_time)->format('H:i:s');
        $model->total_gross_pay = $request->total_gross_pay;
        $model->total_net = $request->total_net;
        $model->status = 0;
        $model->save();

        $items = collect(json_decode($request->items));
        if($items->count() > 0) {
            foreach($items as $item) {
                $model->SalesItems()->create([
                    'kabo_number' => $item->kabo_number ?? null,
                    'gross_pay' => $item->gross_pay ?? null,
                    'nine_percent' => $item->nine_percent ?? 0,
                    'four_percent' => $item->four_percent ?? 0,
                    'net' => $request->net ?? 0,
                    'out_pay' => $item->out ?? 0
                ]);
            }
        }

        return response()->json([
            'message' => 'New sales data has been successfully added.'
        ]);
    }

    public function edit($id)
    {
        $model = \App\Models\Sales::findOrFail($id);

        return view('admin.sales.edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'station' => 'required',
            'field_coordinator' => 'required',
            'date' => [
                'required',
                'date',
                'date_format:Y-m-d',
            ],
            'draw_time' => 'required',
            'total_gross_pay' => [
                'required',
                'numeric',
                'gt:0'
            ],
            'total_net' => [
                'required',
                'numeric',
                'gt:0'
            ]
        ]);

        $model = \App\Models\Sales::findOrFail($id);

        $model->station = $request->station;
        $model->date = $request->date;
        $model->draw_time = \Carbon::createFromFormat('h:i A', $request->draw_time)->format('H:i:s');
        $model->total_gross_pay = $request->total_gross_pay;
        $model->status = $request->status;
        $model->save();

        $items = collect(json_decode($request->items));
        if($items->count() > 0) {
            $model->SalesItems()->delete();

            foreach($items as $item) {
                $model->SalesItems()->create([
                    'kabo_number' => $item->kabo_number ?? null,
                    'gross_pay' => $item->gross_pay ?? null,
                    'nine_percent' => $item->nine_percent ?? 0,
                    'four_percent' => $item->four_percent ?? 0,
                    'net' => $request->net ?? 0,
                    'out_pay' => $item->out ?? 0
                ]);
            }
        }

        return response()->json([
            'message' => 'Sales information has been successfully updated.'
        ]);
    }

    public function delete(Request $request, $id)
    {
        if($request->ajax()) {
            $model = \App\Models\Sales::where(function ($query) use ($id) {
                $query->where('id', $id);
            })->delete();
        }
    }

    public function items(Request $request, $id)
    {
        if($request->ajax()) {
            $model = \App\Models\SalesItems::where(function ($query) use ($id) {
                $query->where('sales_id', $id);
            })->get();

            return $model;
        }
    }

   

}
