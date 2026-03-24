<?php

namespace App\Http\Controllers;

use App\Models\Quotes;
use App\Models\Contracts;
use App\Models\Invoices;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function quote($id)
    {
        $quote = Quotes::with('client')->findOrFail($id);

        $pdf = Pdf::loadView('pdf.quote', compact('quote'));

        return $pdf->download('devis-' . $quote->number . '.pdf');
    }

    public function contract($id)
    {
        $contract = Contracts::with('client')->findOrFail($id);

        $pdf = Pdf::loadView('pdf.contract', compact('contract'));

        return $pdf->download('contrat-' . $contract->number . '.pdf');
    }

    public function invoice($id)
    {
        $invoice = Invoices::with('client')->findOrFail($id);

        $pdf = Pdf::loadView('pdf.invoice', compact('invoice'));

        return $pdf->download('facture-' . $invoice->number . '.pdf');
    }
}
