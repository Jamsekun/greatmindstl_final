<?php

use Illuminate\Support\Facades\Route;


Auth::routes([
    'verify'   => false,
    'reset'    => false,
]);

Route::get('/', [App\Http\Controllers\MainController::class, 'index'])
->name('index');

Route::get('about', [App\Http\Controllers\MainController::class, 'about'])
    ->name('about');

Route::get('results', [App\Http\Controllers\MainController::class, 'results'])
    ->name('results');

Route::get('latest-winner', [App\Http\Controllers\MainController::class, 'latest_winner'])
    ->name('latest_winner');

Route::post('history', [App\Http\Controllers\MainController::class, 'history'])
    ->name('history');

Route::group([
    'prefix' => 'ajax'
], function () {

    Route::post('numbers', [App\Http\Controllers\MainController::class, 'numbers'])
        ->name('lottery_results.numbers');

    Route::post('agents', [App\Http\Controllers\MainController::class, 'agents'])
        ->name('lottery_results.agents');

    Route::post('total_members', [App\Http\Controllers\MainController::class, 'total_members'])
        ->name('total_members');

    Route::post('total_winners', [App\Http\Controllers\MainController::class, 'total_winners'])
        ->name('total_winners');
});


Route::group([
    'prefix' => 'agent',
], function () {

    Route::get('{id}', [App\Http\Controllers\AgentController::class, 'show'])
        ->name('agent.show');

});


Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth'
], function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('admin.index');

    Route::group([
        'prefix' => 'permission',
    ], function () {

        Route::post('load', [App\Http\Controllers\PermissionController::class, 'load'])
            ->name('admin.permission.load');

    });

    Route::group([
        'prefix' => 'role',
    ], function () {

        Route::post('load', [App\Http\Controllers\RoleController::class, 'load'])
            ->name('admin.role.load');

    });

    Route::group([
        'prefix' => 'expenses',
    ], function () {

        Route::get('/', [App\Http\Controllers\ExpensesController::class, 'index'])
            ->name('admin.expenses.index');

        Route::get('create', [App\Http\Controllers\ExpensesController::class, 'create'])
            ->name('admin.expenses.create');

        Route::post('store', [App\Http\Controllers\ExpensesController::class, 'store'])
            ->name('admin.expenses.store');

        Route::post('load', [App\Http\Controllers\ExpensesController::class, 'load'])
            ->name('admin.expenses.load');

        Route::get('{id}/edit', [App\Http\Controllers\ExpensesController::class, 'edit'])
            ->name('admin.expenses.edit');

        Route::post('{id}/update', [App\Http\Controllers\ExpensesController::class, 'update'])
            ->name('admin.expenses.update');

        Route::post('{id}/items', [App\Http\Controllers\ExpensesController::class, 'items'])
            ->name('admin.expenses.items');
    });

    Route::group([
        'prefix' => 'lottery-results',
    ], function () {

        Route::get('/', [App\Http\Controllers\LotteryResultsController::class, 'index'])
            ->name('admin.lottery_results.index');

        Route::get('create', [App\Http\Controllers\LotteryResultsController::class, 'create'])
            ->name('admin.lottery_results.create');

        Route::post('store', [App\Http\Controllers\LotteryResultsController::class, 'store'])
            ->name('admin.lottery_results.store');

        Route::post('load', [App\Http\Controllers\LotteryResultsController::class, 'load'])
            ->name('admin.lottery_results.load');

        Route::post('{id}/winners', [App\Http\Controllers\LotteryResultsController::class, 'winners'])
            ->name('admin.lottery_results.winners');

        Route::get('{id}/edit', [App\Http\Controllers\LotteryResultsController::class, 'edit'])
            ->name('admin.lottery_results.edit');

        Route::post('{id}/update', [App\Http\Controllers\LotteryResultsController::class, 'update'])
            ->name('admin.lottery_results.update');
    });

    Route::group([
        'prefix' => 'sales',
    ], function () {

        Route::get('/', [App\Http\Controllers\SalesController::class, 'index'])
            ->name('admin.sales.index');

        Route::get('create', [App\Http\Controllers\SalesController::class, 'create'])
            ->name('admin.sales.create');

        Route::post('create', [App\Http\Controllers\SalesController::class, 'store'])
            ->name('admin.sales.store');

        Route::post('load', [App\Http\Controllers\SalesController::class, 'load'])
            ->name('admin.sales.load');

        Route::get('{id}/edit', [App\Http\Controllers\SalesController::class, 'edit'])
            ->name('admin.sales.edit');

        Route::post('{id}/update', [App\Http\Controllers\SalesController::class, 'update'])
            ->name('admin.sales.update');

        Route::post('{id}/items', [App\Http\Controllers\SalesController::class, 'items'])
            ->name('admin.sales.items');

        Route::post('{id}/delete', [App\Http\Controllers\SalesController::class, 'delete'])
            ->name('admin.sales.delete');
    });
   
   
   Route::group([
    'prefix' => 'reports',
], function () {
    Route::get('/', [App\Http\Controllers\ReportsController::class, 'index'])->name('admin.reports.index');
    // Add other reports-related routes here later
});

    Route::group([
        'prefix' => 'users',
    ], function () {

        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])
            ->name('admin.users.index');

        Route::get('create', [App\Http\Controllers\UserController::class, 'create'])
            ->name('admin.users.create');

        Route::post('store', [App\Http\Controllers\UserController::class, 'store'])
        ->name('admin.users.store');

        Route::post('search', [App\Http\Controllers\UserController::class, 'search'])
            ->name('admin.users.search');

        Route::post('load', [App\Http\Controllers\UserController::class, 'load'])
            ->name('admin.users.load');

        Route::post('count', [App\Http\Controllers\UserController::class, 'count'])
            ->name('admin.users.count');

        Route::get('{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])
            ->name('admin.users.edit');

        Route::get('{id}/permission', [App\Http\Controllers\UserController::class, 'permission'])
            ->name('admin.users.permission');

        Route::post('{id}/manage_permission', [App\Http\Controllers\UserController::class, 'manage_permission'])
            ->name('admin.users.manage_permission');

        Route::post('{id}/get_permission', [App\Http\Controllers\UserController::class, 'get_permission'])
            ->name('admin.users.get_permission');

        Route::get('{id}/role', [App\Http\Controllers\UserController::class, 'role'])
            ->name('admin.users.role');

        Route::post('{id}/manage_role', [App\Http\Controllers\UserController::class, 'manage_role'])
            ->name('admin.users.manage_role');

        Route::post('{id}/get_role', [App\Http\Controllers\UserController::class, 'get_role'])
            ->name('admin.users.get_role');

        Route::post('{id}/update', [App\Http\Controllers\UserController::class, 'update'])
            ->name('admin.users.update');

        Route::post('{id}/change_password', [App\Http\Controllers\UserController::class, 'change_password'])
            ->name('admin.users.change_password');

        Route::post('{id}/set_status', [App\Http\Controllers\UserController::class, 'set_status'])
            ->name('admin.users.set_status');

        Route::post('{id}/delete', [App\Http\Controllers\UserController::class, 'delete'])
            ->name('admin.users.delete');
    });

    Route::group([
        'prefix' => 'employees',
    ], function () {

        Route::get('/', [App\Http\Controllers\AgentController::class, 'index'])
            ->name('admin.agents.index');

        Route::get('create', [App\Http\Controllers\AgentController::class, 'create'])
            ->name('admin.agents.create');

        Route::post('store', [App\Http\Controllers\AgentController::class, 'store'])
            ->name('admin.agents.store');

        Route::post('search', [App\Http\Controllers\AgentController::class, 'search'])
            ->name('admin.agents.search');

        Route::post('load', [App\Http\Controllers\AgentController::class, 'load'])
            ->name('admin.agents.load');

        Route::post('count', [App\Http\Controllers\AgentController::class, 'count'])
            ->name('admin.agents.count');

        Route::post('import', [App\Http\Controllers\AgentController::class, 'import'])
            ->name('admin.agents.import');

        Route::get('export', [App\Http\Controllers\AgentController::class, 'export'])
            ->name('admin.agents.export');
            
        Route::get('{id}/edit', [App\Http\Controllers\AgentController::class, 'edit'])
            ->name('admin.agents.edit');

        Route::post('{id}/update', [App\Http\Controllers\AgentController::class, 'update'])
            ->name('admin.agents.update');

        Route::post('{id}/delete', [App\Http\Controllers\AgentController::class, 'delete'])
            ->name('admin.agents.delete');

        Route::post('{id}/qr_code', [App\Http\Controllers\AgentController::class, 'qr_code'])
            ->name('admin.agents.qr_code');
        
        Route::get('/admin/agents/generate-id-image/{id}', [App\Http\Controllers\AgentController::class, 'generateIdImage'])
            ->name('admin.agents.generateIdImage');
            
        Route::post('{id}/generate-qr-token', [App\Http\Controllers\AgentController::class, 'generateQrToken'])
        ->name('admin.agents.generateQrToken');
        
        Route::post('update-last-print-date', [App\Http\Controllers\AgentController::class, 'updateLastPrintDate'])
        ->name('admin.agents.updateLastPrintDate');

    });

});
