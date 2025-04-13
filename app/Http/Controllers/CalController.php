<?php

namespace App\Http\Controllers;

use App\Models\Calculate;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\SoftDeletes;




class CalController extends Controller
{

    public function calculate(Request $request)
    {
        $request->validate([
            'item' => 'required|string',
            'unitprice' => 'required|numeric',
            'quantity' => 'required|numeric', // not integer anymore
        ]);
        $total = $request->unitprice * $request->quantity;

        // Save to database
        $calculation = new Calculate();
        $calculation->user_id = Auth::id(); // Add this line
        $calculation->item = $request->item;
        $calculation->unitprice = $request->unitprice;
        $calculation->quantity = $request->quantity;
        $calculation->total = $total;
        $calculation->save();


           // Redirect back to dashboard with session data
    return redirect()->route('dashboard')->with([
        'item' => $request->item,
        'unitprice' => $request->unitprice,
        'quantity' => $request->quantity,
        'total' => $total
    ]);

    }
    
    public function viewData()
    {
        // Paginate the calculations for the logged-in user
        $calculations = Calculate::where('user_id', Auth::id())
                                 ->orderBy('created_at', 'desc')
                                 ->paginate(5); // 10 items per page

    
        // Calculate grand total (you can use the same filtered collection)
        $grandTotal = Calculate::where('user_id', Auth::id())->sum('total');
    
        // Return the view
        return view('viewdata', compact('calculations', 'grandTotal'));
    }

    public function viewGrandData()
    {
      

    
        // Calculate grand total (you can use the same filtered collection)
        $grandTotal = Calculate::where('user_id', Auth::id())->sum('total');
    
        // Return the view
        return view('dashboard', compact('calculations','grandTotal'));
    }


// 

    
public function clearAll()
{
    try {
        // Permanently delete all records for the current user
        Calculate::where('user_id', Auth::id())->forceDelete();

        return redirect()->route('viewdata')->with('success', 'Your calculations have been cleared.');
    } catch (\Exception $e) {
        return redirect()->route('viewdata')->with('error', 'Failed to clear your records: ' . $e->getMessage());
    }
}

public function downloadPDF()
{
    // Paginate the records, adjusting the number of records per page as necessary
    $calculations = Calculate::where('user_id', Auth::id())->paginate(20); // Adjust the number of items per page
    $grandTotal = $calculations->sum('total');

    // Generate the PDF with the paginated calculations
    $pdf = PDF::loadView('pdf.calculation', [
        'calculations' => $calculations,
        'grandTotal' => $grandTotal
    ]);

    // Download the PDF
    return $pdf->download('calculations.pdf');
}






}
