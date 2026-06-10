<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovante - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            orange: '#f97316',
                            red: '#dc2626',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        }
    </style>
</head>
<body class="bg-zinc-50 p-8">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden border border-zinc-200">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-brand-orange to-brand-red px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-black text-white tracking-tight">{{ config('app.name') }}</h1>
                    <p class="text-orange-100 text-sm mt-1">Comprovante de Mensalidade</p>
                </div>
                <div class="text-right">
                    <p class="text-white/80 text-xs">Recibo #</p>
                    <p class="text-white font-mono text-sm font-semibold">{{ $fee->uuid }}</p>
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="px-8 py-6">
            {{-- Student Info --}}
            <div class="border-b border-zinc-200 pb-4 mb-4">
                <h2 class="text-xs font-semibold text-zinc-400 uppercase tracking-widest mb-2">Aluno</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-lg font-bold text-zinc-900">{{ $fee->student->name }}</p>
                        <p class="text-sm text-zinc-500">{{ $fee->student->email ?? '—' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-zinc-500">Código</p>
                        <p class="text-sm font-mono font-semibold text-zinc-700">{{ $fee->student->code }}</p>
                    </div>
                </div>
            </div>

            {{-- Fee Details --}}
            <h2 class="text-xs font-semibold text-zinc-400 uppercase tracking-widest mb-3">Detalhes do Pagamento</h2>
            <div class="grid grid-cols-2 gap-x-6 gap-y-3 text-sm mb-6">
                <div>
                    <span class="text-zinc-500">Período</span>
                    <p class="font-semibold text-zinc-800">
                        {{ $fee->start_date?->format('d/m/Y') ?? '—' }} a {{ $fee->end_date?->format('d/m/Y') ?? '—' }}
                    </p>
                </div>
                <div>
                    <span class="text-zinc-500">Data do Pagamento</span>
                    <p class="font-semibold text-zinc-800">{{ $fee->date_payment?->format('d/m/Y') ?? '—' }}</p>
                </div>
                <div>
                    <span class="text-zinc-500">Plano</span>
                    <p class="font-semibold text-zinc-800">{{ $fee->planType->name ?? '—' }}</p>
                </div>
                <div>
                    <span class="text-zinc-500">Forma de Pagamento</span>
                    <p class="font-semibold text-zinc-800">{{ $fee->paymentType->name ?? '—' }}</p>
                </div>
            </div>

            {{-- Values Table --}}
            <div class="border rounded-xl overflow-hidden mb-6">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-zinc-50 border-b border-zinc-200">
                            <th class="text-left px-4 py-3 font-semibold text-zinc-600">Descrição</th>
                            <th class="text-right px-4 py-3 font-semibold text-zinc-600">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-zinc-100">
                            <td class="px-4 py-3 text-zinc-700">Valor Integral</td>
                            <td class="px-4 py-3 text-right font-mono text-zinc-700">R$ {{ number_format((float) $fee->full_payment, 2, ',', '.') }}</td>
                        </tr>
                        @if ((float) $fee->discount_payment > 0)
                        <tr class="border-b border-zinc-100">
                            <td class="px-4 py-3 text-green-700">Desconto</td>
                            <td class="px-4 py-3 text-right font-mono text-green-600">- R$ {{ number_format((float) $fee->discount_payment, 2, ',', '.') }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td class="px-4 py-3 font-bold text-zinc-900">Valor Pago</td>
                            <td class="px-4 py-3 text-right font-mono font-bold text-lg text-zinc-900">R$ {{ number_format((float) $fee->amount_paid, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Responsible --}}
            @if ($fee->user)
            <div class="border-t border-zinc-200 pt-4 text-xs text-zinc-400 text-center">
                Registrado por {{ $fee->user->name }} em {{ $fee->created_at->format('d/m/Y H:i') }}
            </div>
            @endif
        </div>

        {{-- Footer --}}
        <div class="bg-zinc-900 px-8 py-4 text-center">
            <p class="text-zinc-400 text-xs">
                {{ config('app.name') }} — Todos os direitos reservados
            </p>
        </div>
    </div>
</body>
</html>
