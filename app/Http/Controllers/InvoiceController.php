<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use PDF;
use Auth;

class InvoiceController extends Controller
{
    //downloads customer invoice
    public function customer_invoice_download($id)
    {
        set_time_limit(120); // Increase timeout to 120 seconds for PDF generation

        $order = Order::findOrFail($id);
        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true,
                        'isRemoteEnabled' => false, // Disable remote loading for faster generation
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/'),
                        'chroot' => public_path(), // Set base path for asset loading
                    ])->loadView('invoices.customer_invoice', compact('order'));
        return $pdf->download('order-'.$order->code.'.pdf');
    }

    //downloads seller invoice
    public function seller_invoice_download($id)
    {
        set_time_limit(120); // Increase timeout to 120 seconds for PDF generation

        $order = Order::findOrFail($id);
        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true,
                        'isRemoteEnabled' => false, // Disable remote loading for faster generation
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/'),
                        'chroot' => public_path(), // Set base path for asset loading
                    ])->loadView('invoices.seller_invoice', compact('order'));
        return $pdf->download('order-'.$order->code.'.pdf');
    }

    //downloads admin invoice
    public function admin_invoice_download($id)
    {
        set_time_limit(120); // Increase timeout to 120 seconds for PDF generation

        $order = Order::findOrFail($id);
        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true,
                        'isRemoteEnabled' => false, // Disable remote loading for faster generation
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/'),
                        'chroot' => public_path(), // Set base path for asset loading
                    ])->loadView('invoices.admin_invoice', compact('order'));
        return $pdf->download('order-'.$order->code.'.pdf');
    }
}
