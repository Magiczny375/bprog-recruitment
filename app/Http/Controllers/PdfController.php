<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\PdfService;

class PdfController extends Controller
{
    private PdfService $pdfService;

    /**
     * @param PdfService $pdfService
     */
    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    /**
     * Generate PDF document with provided text.
     * @return \Illuminate\Http\Response
     */
    public function generate(): \Illuminate\Http\Response
    {
        $data = array('input' => "lorem ipsum :-)");
        return $this->pdfService->generate($data);
    }
}
