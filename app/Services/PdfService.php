<?php

declare(strict_types=1);

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class PdfService
{
    /**
     * Generate PDF document from provided input.
     * @param array $input
     * @return Response
     */
    public function generate(array $input): Response
    {
        $pdf = Pdf::loadView('pdf.simple', $input);

        // Show generated PDF file in browser. We can use download method to download generated file to PC.
        return $pdf->stream('invoice.pdf');
    }
}
