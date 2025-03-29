<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    
    public function index()
    {
        return view('admin.expenses.index');
    }

    public function create()
    {
        return view('admin.expenses.create');
    }

    public function edit($id)
    {
        $model = \App\Models\Expenses::findOrFail($id);

        return view('admin.expenses.edit', compact('model'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'station' => 'required',
            'date' => [
                'required',
                'date',
                'date_format:Y-m-d'
            ],
            'total_amount' => [
                'required',
                'numeric',
                'gt:0',
            ]
        ]);

        $model = new \App\Models\Expenses;
        $model->station = $request->station;
        $model->date = $request->date;
        $model->total_amount = $request->total_amount;
        $model->save();

        $items = collect(json_decode($request->items));

        if($items->count() > 0) {
            foreach($items as $item) {
                $model->ExpensesItems()->create([
                    'description' => $item->description ?? null,
                    'amount' => $item->amount ?? 0,
                ]);
            }
        }

        return response()->json([
            'message' => 'Expenses has been successfully added.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'station' => 'required',
            'date' => [
                'required',
                'date',
                'date_format:Y-m-d'
            ],
            'total_amount' => [
                'required',
                'numeric',
                'gt:0',
            ]
        ]);

        $model = \App\Models\Expenses::findOrFail($id);
        $model->station = $request->station;
        $model->date = $request->date;
        $model->total_amount = $request->total_amount;
        $model->save();

        $items = collect(json_decode($request->items));
        if($items->count() > 0) {
            $model->ExpensesItems()->delete();

            foreach($items as $item) {
                $model->ExpensesItems()->create([
                    'description' => $item->description ?? null,
                    'amount' => $item->amount ?? 0,
                ]);
            }
        }

        return response()->json([
            'message' => 'Expenses has been successfully updated.'
        ]);
    }

    public function load(Request $request)
    {
        $model = \App\Models\Expenses::where(function ($query) use ($request) {
            if(!auth()->user()->hasAnyRole(['super-administrator', 'administrator'])) {
                $query->orWhere('created_by', auth()->user()->UserInformation->full_name);
                $query->orWhere('created_by', auth()->user()->username);
            }
        })
        ->select([
            'expenses.*',
            \DB::raw("(SELECT COUNT(*) FROM expenses_items WHERE expenses.id = expenses_id) as `count`")
        ])
        ->orderBy('date', 'DESC')
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
                    'result',
                    'created_at',
                    'updated_at'
                ])
                ->toJson();
    }

    public function items(Request $request, $id)
    {
        if($request->ajax()) {
            $model = \App\Models\ExpensesItems::leftJoin('expenses', function ($query) {
                $query->on('expenses.id', '=', 'expenses_id');                
            })
            ->where(function ($query) use ($id) {
                $query->where('expenses_id', $id);
            })
            ->select([
                'expenses_items.*'
            ])
            ->get();

            return $model;
        }
    }

}
