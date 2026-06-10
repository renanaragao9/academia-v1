<?php

namespace App\Services\Pdf;

use App\Models\MonthlyFee;
use Spatie\Browsershot\Browsershot;

class GenerateMonthlyFeeReceiptService
{
    public function run(MonthlyFee $fee): string
    {
        $fee->loadMissing(['student', 'planType', 'paymentType', 'user']);

        $html = view('pdf.monthly-fee.receipt', compact('fee'))->render();

        $path = storage_path("app/public/monthly-fees/receipt-{$fee->uuid}.pdf");

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
