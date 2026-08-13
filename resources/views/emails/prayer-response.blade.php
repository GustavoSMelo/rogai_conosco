<!DOCTYPE html>
<html lang="pt-BR">
@php
    \Illuminate\Support\Facades\Log::info('Prayer response email view rendered', [
        'to' => $to ?? null,
        'name' => $name ?? null,
        'hasMedia' => ! empty($mediaUrl ?? null),
    ]);
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rogai Conosco — Sua Oração Foi Respondida</title>
</head>
<body style="margin:0;padding:0;background-color:#f5f2ed;font-family:Georgia,'Times New Roman',serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f5f2ed;">
        <tr>
            <td align="center" style="padding:40px 20px;">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff;border-radius:4px;overflow:hidden;">
                    <tr>
                        <td style="padding:40px 40px 20px;text-align:center;">
                            <h1 style="margin:0 0 8px;font-size:22px;color:#4a5c4a;font-weight:400;">Rogai Conosco</h1>
                            <p style="margin:0;font-size:13px;color:#8c9a8c;">Sua Oração Foi Respondida</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 40px 20px;">
                            <p style="font-size:14px;color:#3d3d3d;line-height:1.6;">
                                Olá, <strong>{{ $name ?: 'Anônimo' }}</strong>,
                            </p>
                            <p style="font-size:14px;color:#3d3d3d;line-height:1.6;">
                                Recebemos seu pedido de oração e preparamos uma resposta para você:
                            </p>
                            <blockquote style="margin:20px 0;padding:16px 20px;background-color:#f8f6f2;border-left:3px solid #8c9a8c;font-style:italic;font-size:14px;color:#4a5c4a;">
                                {{ $prayerMessage }}
                            </blockquote>
                            <p style="font-size:14px;color:#3d3d3d;line-height:1.6;">
                                Que Deus abençoe sua vida e traga paz ao seu coração.
                            </p>
                        </td>
                    </tr>
                    @if ($mediaUrl)
                    <tr>
                        <td style="padding:0 40px 20px;">
                            <a href="{{ $mediaUrl }}" style="display:inline-block;padding:10px 24px;background-color:#8c9a8c;color:#ffffff;text-decoration:none;border-radius:4px;font-size:13px;">
                                Ouvir mensagem
                            </a>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td style="padding:20px 40px;text-align:center;border-top:1px solid #e8e4dd;">
                            <p style="margin:0;font-size:11px;color:#b0b8b0;">
                                Rogai Conosco &mdash; um espaço de acolhimento e fé
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
