<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $dados['assunto'] }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7fafc; padding: 20px;">
   
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
      <img src="{{ asset('images/logo-ava.png') }}" 
     alt="AvaliaEdu Logo" 
     style="display: block; margin: 0 auto 20px auto; width: 120px; height: auto;">


    <h2 style="color: #1a202c; margin-bottom: 10px;">Nova mensagem🔔</h2>
        <p><strong>Email do remetente:</strong> {{ $dados['email'] }}</p>
        <p><strong>Assunto:</strong> {{ $dados['assunto'] }}</p>
        <p><strong>Mensagem:</strong></p>
        <p style="padding: 10px; background: #f1f5f9; border-radius: 5px;">{{ $dados['mensagem'] }}</p>
        <p style="margin-top: 20px; font-size: 12px; color: #718096;">Este email foi enviado pelo formulário de contato do AvaliaEdu.</p>
    </div>
</body>
</html>
