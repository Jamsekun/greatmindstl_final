<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LotteryResultsController extends Controller
{
    
    public function index()
    {
        return view('admin.lottery_results.index');
    }

    public function create()
    {
        return view('admin.lottery_results.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => [
                'required',
                'date',
                'date_format:Y-m-d'
            ],
            'draw_time' => [
                'required'
            ],
            'tally_sheet' => [
                'required',
                'numeric'
            ],
            'number_1' => [
                'required',
                'integer',
                'min:1'
            ],
            'number_2' => [
                'required',
                'integer',
                'min:1'
            ],
            'lottery_results_winners.*.agent' => [
                'sometimes',
                'required',
                'exists:App\Models\UserInformation,id'
            ],
            'lottery_results_winners.*.amount' => [
                'sometimes',
                'required',
                'numeric',
                'min:1'
            ]
        ]);

        $model = new \App\Models\LotteryResults;
        $model->date = $request->date;
        $model->draw_time = \Carbon::createFromFormat('h:i A', $request->draw_time)->format('H:i:s');
        $model->tally_sheet = $request->tally_sheet;
        $model->result = collect([
            $request->number_1,
            $request->number_2
        ])->toJson();

        $model->save();

        if($request->filled('lottery_results_winners')) {
            foreach($request->lottery_results_winners as $key => $results) {
                $model->LotteryResultsWinners()->create([
                    'user_information_id' => $results['agent'],
                    'amount' => $results['amount']
                ]);
            }
        }

        return response()->json([
            'message' => 'Lottery results has been successfully added.'
        ]);
    }

    public function load(Request $request)
    {
        $model = \App\Models\LotteryResults::with('LotteryResultsWinners.UserInformation')->where(function ($query) use ($request) {
            if($request->filled('latest')) {
                $query->whereHas('LotteryResultsWinners', function ($query) {
                    $query->where('date', \Carbon::now()->format('Y-m-d'));
                });
            }
        })
        ->select([
            'lottery_results.*',
            \DB::raw("(SELECT COUNT(*) FROM lottery_results_winners WHERE lottery_results.id = lottery_results_id) as `count`")
        ])
        ->orderBy('date', 'DESC')
        ->get();

        return datatables()
                ->of($model)
                ->addColumn('result', function ($query) {
                    $html = '';
                    $numbers = array_map('intval', json_decode($query->result, true));

                    foreach($numbers as $key => $number) {
                        if($key == 0) {
                            $html .= '<span class="badge badge-warning" style="margin-left: 5px;">' . $number . '</span>';
                        } else {
                            $html .= '<span class="badge badge-danger" style="margin-left: 5px;">' . $number . '</span>';
                        }
                    }

                    return $html;
                })
                ->editColumn('draw_time', function ($query) {
                    return \Carbon::parse($query->draw_time)->format('h:i A');
                })
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

    public function edit($id)
    {
        $model = \App\Models\LotteryResults::findOrFail($id);

        return view('admin.lottery_results.edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'date' => [
                'required',
                'date',
                'date_format:Y-m-d'
            ],
            'draw_time' => [
                'required'
            ],
            'tally_sheet' => [
                'required',
                'numeric'
            ],
            'number_1' => [
                'required',
                'integer',
                'min:1'
            ],
            'number_2' => [
                'required',
                'integer',
                'min:1'
            ],
            'lottery_results_winners.*.agent' => [
                'sometimes',
                'required',
                'exists:App\Models\UserInformation,id'
            ],
            'lottery_results_winners.*.amount' => [
                'sometimes',
                'required',
                'numeric',
                'min:1'
            ]
        ]);

        $model = \App\Models\LotteryResults::findOrFail($id);
        
        $model->date = $request->date;
        $model->draw_time = \Carbon::createFromFormat('h:i A', $request->draw_time)->format('H:i:s');
        $model->tally_sheet = $request->tally_sheet;
        $model->result = collect([
            $request->number_1,
            $request->number_2
        ])->toJson();

        $model->save();

        if($request->filled('lottery_results_winners')) {
            $model->LotteryResultsWinners()->delete();

            foreach($request->lottery_results_winners as $key => $results) {
                $model->LotteryResultsWinners()->create([
                    'user_information_id' => $results['agent'],
                    'amount' => $results['amount']
                ]);
            }
        } else {
            $model->LotteryResultsWinners()->delete();
        }

        return response()->json([
            'message' => 'Lottery results has been successfully updated.'
        ]);
    }

    public function winners(Request $request, $id)
    {
        if($request->ajax()) {
            $model = \App\Models\LotteryResultsWinners::leftJoin('users_informations', function ($query) {
                $query->on('users_informations.id', '=', 'user_information_id');                
            })
            ->where(function ($query) use ($id) {
                $query->where('lottery_results_id', $id);
            })
            ->select([
                'users_informations.id',
                'users_informations.employee_number',
                'users_informations.first_name',
                'users_informations.last_name',
                'lottery_results_winners.amount'
            ])
            ->get();

            return $model;
        }
    }

}
