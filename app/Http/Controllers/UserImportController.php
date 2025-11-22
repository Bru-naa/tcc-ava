<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'arquivo' => 'required|file|mimes:xlsx,xls,csv'
        ]);

        $escolaId = auth()->user()->escola_id ?? null;

        try {
            Excel::import(new UsersImport($escolaId), $request->file('arquivo'));

            return back()->with('success', 'Importação concluída com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
