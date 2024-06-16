<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FranchiseInquiry;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FranchiseController extends Controller
{

    public function index()
    {
        $inquiries = FranchiseInquiry::orderBy('id', 'desc')->get();
        return view('admin.franchise.index', compact('inquiries'));
    }
}
