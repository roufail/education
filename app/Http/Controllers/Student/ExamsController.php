<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    public function exam($id)
    {
        return $id;
    }
}
