<?php

declare(strict_types=1);

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use http\Client\Response;

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
        return $pdf->download('invoice.pdf');
    }
}
