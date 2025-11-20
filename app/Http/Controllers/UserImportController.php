<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class UserImportController extends Controller
{
    public function import(Request $request)
    {
         if (!auth()->user()->escola_id) {
        return back()->with('error', 'Você não está vinculado a uma escola');
    }

    $request->validate([
        'planilha' => 'required|file|mimes:xlsx,xls,csv'
    ]);

        try {
            //  escola da secretaria logada AUTOMATICAMENTE
            $escolaId = auth()->user()->escola_id;

            Excel::import(new UsersImport($escolaId), $request->file('planilha'));

            return back()->with('success', 'Usuários importados com sucesso!');

        } catch (\Exception $e) {
            return back()->with('error', 'Erro na importação: ' . $e->getMessage());
        }
    }
}