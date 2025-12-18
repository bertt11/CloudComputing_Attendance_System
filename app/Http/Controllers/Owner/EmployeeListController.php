<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeListController extends Controller
{
    public function index(Request $request)
    {
        $ownerId = Auth::id();

        $status    = $request->query('status');   // hadir | izin | absen | null
        $companyId = $request->query('company');  // id company | null

        $companies = Company::where('owner_id', $ownerId)
            ->when($companyId, function ($q) use ($companyId) {
                $q->where('id', $companyId);
            })
            ->with(['employees' => function ($query) {

                $query->with(['attendances' => function ($q) {
                    $q->whereDate('date', today());
                }]);

            }])
            ->get();

        return view('owner.employees.index', compact(
            'companies',
            'status',
            'companyId'
        ));
    }
}
