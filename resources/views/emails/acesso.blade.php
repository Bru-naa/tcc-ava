<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Senha Temporária - Sistema AVA</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7fafc; padding: 20px;">
   
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <img src="{{ asset('images/logo-ava.png') }}" 
             alt="AvaliaEdu Logo" 
             style="display: block; margin: 0 auto 20px auto; width: 120px; height: auto;">

        <h2 style="color: #1a202c; margin-bottom: 10px;">Sua conta foi criada! 🎉</h2>
        
        <p><strong>Email institucional:</strong> {{ $emailInstitucional }}</p>
        <p><strong>Senha temporária:</strong> <code style="background: #f1f5f9; padding: 5px 10px; border-radius: 4px; font-size: 16px;">{{ $senhaTemporaria }}</code></p>
        
        <div style="margin: 25px 0; padding: 15px; background: #f0fff4; border-radius: 5px; border-left: 4px solid #48bb78;">
            <strong>⚠️ Importante:</strong> 
            <p style="margin: 5px 0 0 0;">Altere sua senha no primeiro acesso por questões de segurança.</p>
        </div>

        <a href="{{ route('login') }}" 
           style="display: inline-block; background: #4299e1; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-weight: bold; margin: 15px 0;">
           Acessar o Sistema
        </a>

        <p style="margin-top: 20px; font-size: 12px; color: #718096;">
            Este email foi enviado automaticamente pelo sistema AVA.
        </p>
    </div>
</body>
</html>