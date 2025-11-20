<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContatoMail;

class ContatoController extends Controller
{
    public function enviar(Request $request)
    {
        // Validação
        $request->validate([
            'email' => 'required|email',
            'assunto' => 'required|string|max:255',
            'mensagem' => 'required|string|max:2000',
        ]);

        $dados = $request->only('email', 'assunto', 'mensagem');

        try {
            Mail::to('avaliaedu.test.dev@outlook.com')
                ->send(new ContatoMail($dados));

            return back()->with('success', 'Mensagem enviada com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao enviar mensagem: ' . $e->getMessage());
        }
    }
}