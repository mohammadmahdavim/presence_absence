<?php

namespace App\Http\Controllers;

use App\Imports\MangerImporter;
use App\Imports\personellImporter;
use App\Models\Section;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index()
    {

        return view('panel.import');
    }

    public function managerImport(Request $request)
    {

        $this->validate($request, [
            'import_file' => 'required'
        ]);

        $path = $request->file('import_file')->getRealPath();
        Excel::import(new MangerImporter(), $path);

        return back();
    }

    public function personnelImport(Request $request)
    {
        $this->validate($request, [
            'import_file' => 'required'
        ]);
        $path = $request->file('import_file')->getRealPath();
        Excel::import(new personellImporter(), $path);

        return back();
    }
}
