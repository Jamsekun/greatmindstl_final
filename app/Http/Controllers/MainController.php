<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class MainController extends Controller
{
    
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about');
    }

    public function results()
    {
        return view('results.index');
    }

    public function latest_winner()
    {
        return view('latest_winner.index');
    }

    public function numbers(Request $request)
    {
        if($request->ajax()) {
            $model = \App\Models\LotteryResults::where(function ($query) use ($request) {
                if($request->filled('date')) {
                    $query->where('date', $request->date);
                } else {
                    $query->where('date', \Carbon::now()->format('Y-m-d'));
                }
            })
            ->select([
                'date',
                'draw_time',
                'result', 
                'date'
            ])
            ->get();

            return $model;
        }
    }

    public function agents(Request $request)
    {
        if($request->ajax()) {
            $model = \App\Models\LotteryResultsWinners::leftJoin('users_informations', function ($query) {
                $query->on('users_informations.id', '=', 'user_information_id');                
            })
            ->whereHas('LotteryResults', function ($query) use ($request) {
                if($request->filled('date')) {
                    $query->where('date', $request->date);
                } else {
                    $query->where('date', \Carbon::now()->format('Y-m-d'));
                }
            })
            ->select([
                \DB::raw("CONCAT(users_informations.first_name, ' ', users_informations.last_name) as `full_name`"),
                \DB::raw("users_informations.station as `branch`"),
                'lottery_results_winners.amount',
                \DB::raw("(SELECT date FROM lottery_results WHERE lottery_results.id = lottery_results_id) as `date`")
            ])
            ->get();

            return $model;
        }
    }

    public function total_members(Request $request)
    {
        if($request->ajax()) {
            $model = \App\Models\UserInformation::where('is_agent', 1)->count();

            return number_format($model, 0, '', ',');
        }
    }

    public function total_winners(Request $request)
    {
        if($request->ajax()) {
            $model = \App\Models\LotteryResultsWinners::where(function ($query) use ($request) {
                if($request->filled('filter')) {
                    $query->whereHas('lottery_result', function ($query) {
                        $query->where('date', \Carbon::now()->format('Y-m-d'));
                    });
                }
            })->count();

            return number_format($model, 0, '', ',');
        }
    }

    public function history(Request $request)
    {
        if($request->ajax()) {
            $model = \Activity::where(function ($query) use ($request) {
                $query->whereYear('created_at', \Carbon::now()->format('Y'));
                $query->whereMonth('created_at', \Carbon::now()->format('m'));
            })
            ->orderBy('id', 'DESC')->orderBy('created_at', 'DESC')->get();

            $collection = collect();
 
            foreach($model as $rows) {
                $user = '';

                if(!is_null($rows->causer)) {
                    $user = strtoupper($rows->causer->username);
                } else {
                    $user = 'DELETED USER';
                }

                if($rows->subject_type == 'App\Models\Sales') {
                    if($rows->description == 'created') {
                        $collection->push([
                            'id'   => $rows->subject_id,
                            'description' => "New Sales record has been added.",
                            'name' => $user,
                            'date' => \Carbon::parse($rows->created_at)->diffForHumans(),
                            'type' => 'Sales Record',
                        ]);
                    }

                    if($rows->description == 'updated') {
                        foreach($rows->changes['attributes'] as $key => $changes) {
                            $str         = \Str::of($key)->upper()->replace('_', ' ');
                            $description = "[" . $str . "] has been changed from {$rows->changes['old'][$key]} to {$changes}.";
                            
                            $collection->push([
                                'id'   => $rows->subject_id,
                                'description' => $description,
                                'name' => $user,
                                'date' => \Carbon::parse($rows->created_at)->format('Y-m-d H:i:s'),
                                'type' => 'Sales Record'
                            ]);
                        }
                    }
                }

                if($rows->subject_type == 'App\Models\UserInformation') {
                    if($rows->description == 'created') {
                        $collection->push([
                            'id'   => $rows->subject_id,
                            'description' => "New Employee record has been added.",
                            'name' => $user,
                            'date' => \Carbon::parse($rows->created_at)->diffForHumans(),
                            'type' => 'Employee Information',
                        ]);
                    }

                    if($rows->description == 'updated') {
                        foreach($rows->changes['attributes'] as $key => $changes) {
                            $str         = \Str::of($key)->upper()->replace('_', ' ');
                            $description = "[" . $str . "] has been changed from {$rows->changes['old'][$key]} to {$changes}.";
                            
                            $collection->push([
                                'id'   => $rows->subject_id,
                                'description' => $description,
                                'name' => $user,
                                'date' => \Carbon::parse($rows->created_at)->diffForHumans(),
                                'type' => 'Employee Information'
                            ]);
                        }
                    }

                    if($rows->description == 'deleted') {
                        foreach($rows->changes['attributes'] as $key => $changes) {
                            $str         = \Str::of($key)->upper()->replace('_', ' ');
                            $description = "[" . $str . "] {$changes} has been deleted.";
                            
                            $collection->push([
                                'id'   => $rows->subject_id,
                                'description' => $description,
                                'name' => $user,
                                'date' => \Carbon::parse($rows->created_at)->diffForHumans(),
                                'type' => 'Employee Information'
                            ]);

                            break;
                        }
                    }
                }

            }

            return $collection;
        }
    }

}
