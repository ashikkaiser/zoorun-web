<?php

namespace App\Http\Controllers\Branch;

use App\DataTables\Branch\BranchTransferListDatatable;
use App\DataTables\Branch\PickupParcelDataTable;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchTransferController extends Controller
{
    public function index(BranchTransferListDatatable $dataTables)
    {
        return $dataTables->render('themes.frest.branchPanel.branch-transfer.index');
    }
}
