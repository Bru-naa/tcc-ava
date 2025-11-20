<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class UserController extends Controller
{
    public function importar(Request $request)
    {
        $request->validate([
            'arquivo_excel' => 'required|file|mimes:xlsx,xls,csv'
        ]);

        $escolaId = auth()->user()->escola_id;
        
        Excel::import(new UsersImport($escolaId), $request->file('arquivo_excel'));

        return back()->with('success', 'Usuários importados com sucesso!');
    }
}