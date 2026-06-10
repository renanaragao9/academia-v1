<?php

namespace App\Services\Pdf;

use App\Models\Sale;
use Spatie\Browsershot\Browsershot;

class GenerateSaleReceiptPdfService
{
    public function run(Sale $sale): string
    {
        $sale->loadMissing(['student', 'saleItems.item', 'user']);

        $image = base64_encode(
            file_get_contents(
                public_path('image/pdf/payment-Information-cuate.png')
            )
        );

        $html = view('pdf.sale.receipt', compact('sale', 'image'))->render();

        $directory = storage_path('app/public/sales');

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $path = "{$directory}/recibo-{$sale->uuid}.pdf";

        Browsershot::html($html)
            ->setNodeBinary(env('BROWSERSHOT_NODE_BINARY', '/usr/bin/node'))
            ->setChromePath(env('BROWSERSHOT_CHROME_PATH', '/home/renan/.cache/puppeteer/chrome/linux-147.0.7727.57/chrome-linux64/chrome'))
            ->setNodeModulePath(base_path('node_modules'))
            ->margins(0, 0, 0, 0)
            ->format('A4')
            ->noSandbox()
            ->showBrowserHeaderAndFooter(false)
            ->save($path);

        return $path;
    }
}
