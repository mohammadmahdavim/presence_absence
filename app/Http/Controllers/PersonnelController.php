<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonnelStoreRequest;
use App\Models\Area;
use App\Models\Day;
use App\Models\Loge;
use App\Models\PaymentSource;
use App\Models\Personnel;
use App\Models\Role;
use App\Models\Section;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function create()
    {
        $days = Day::pluck('name', 'id');
        $sections = Section::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');
        $managers = Personnel::where('manager_id', null)->pluck('name', 'id');
        $paymentSources = PaymentSource::pluck('name', 'id');
        $loges = Loge::pluck('name', 'id');
        $areas = Area::pluck('name', 'id');
        $menuActive = 'create-personnel';
        return view('panel.personnel.create', compact('menuActive', 'days', 'sections', 'roles', 'managers', 'paymentSources', 'loges', 'areas'));
    }

    public function store(PersonnelStoreRequest $request)
    {
        $lastCode = Personnel::orderBy('code', 'desc')->pluck('code')->first();

        $newRow = Personnel::create([
            'code' => $lastCode + 1,
            'name' => $request->name,
            'national_code' => $request->national_code,
            'mobile' => $request->mobile,
            'is_full_time' => $request->is_full_time,
            'section_id' => $request->section_id,
            'manager_id' => $request->manager_id,
            'area_id' => $request->area_id,
            'payment_source_id' => $request->payment_source_id,
            'loge_id' => $request->loge_id,
            'role_id' => $request->role_id,
            'active' => 1,
        ]);

        $newRow->forecasts()->sync($request->forecast);

        return redirect('/personnel/' . $newRow->id . '/edit');
    }

    public function update(Personnel $personnel, PersonnelStoreRequest $request)
    {
        $personnel->update([
            'name' => $request->name,
            'national_code' => $request->national_code,
            'mobile' => $request->mobile,
            'is_full_time' => $request->is_full_time,
            'section_id' => $request->section_id,
            'manager_id' => $request->manager_id,
            'area_id' => $request->area_id,
            'payment_source_id' => $request->payment_source_id,
            'loge_id' => $request->loge_id,
            'active' => 1,
            'role_id' => $request->role_id,

        ]);

        $personnel->forecasts()->sync($request->forecast);

        return back();
    }

    public function edit(Personnel $personnel)
    {
        $personnel->load('forecasts');
        $forecasts = $personnel->forecasts->pluck('id')->toArray();
        $days = Day::pluck('name', 'id');
        $sections = Section::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');
        $managers = Personnel::where('manager_id', null)->pluck('name', 'id');
        $paymentSources = PaymentSource::pluck('name', 'id');
        $loges = Loge::pluck('name', 'id');
        $areas = Area::pluck('name', 'id');
        $menuActive = 'list-personnel';
        return view('panel.personnel.create', compact('menuActive', 'forecasts', 'personnel', 'days', 'sections', 'roles', 'managers', 'paymentSources', 'loges', 'areas'));

    }

    public function list()
    {
        $personnel = Personnel::all();
        $menuActive = 'list-personnel';
        return view('panel.personnel.list', compact('menuActive', 'personnel'));
    }

    public function cart($id)
    {
        $users = Personnel::where('id', $id)->get();

        return view('panel.qr', ['users' => $users]);
    }

    public function destroy($id)
    {
        $user = Personnel::where('id', $id)->first();
        $user->delete();
        return back();
    }

}
