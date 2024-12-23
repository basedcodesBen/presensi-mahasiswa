<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;
use App\Models\MatakuliahDetail;
use Exception;  // Import Exception class for error handling

class DosenController extends Controller
{
    public function index($nik)
    {
        try {
            // Fetch the Mata Kuliah details for the given nik with pagination (e.g., 10 records per page)
            $matakuliah = MatakuliahDetail::where('user_nik', $nik)
                                          ->with('matakuliah')
                                          ->paginate(10);  // Paginate the results (10 items per page)

            // Return the view with the paginated details
            return view('dosen.matakuliah', compact('matakuliah'));
        } catch (Exception $e) {
            // Log the error (you can also log more details if needed)
            \Log::error('Error fetching Matakuliah details: ' . $e->getMessage());

            // Optionally, return an error view or redirect
            return redirect()->route('home')->with('error', 'There was an error fetching the Matakuliah details.');
        }
    }
}
