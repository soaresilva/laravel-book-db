<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class APIBookController extends Controller
{
    public function index()
    {
        $pages_get = $_GET['page'];
        
        if (!isset($_GET['page'])) {
            $get_page = 0;
          }
        
        if ($pages_get <= 1) {
            $get_page = 0;
        } else {
            $get_page = ($pages_get - 1) * 4;
        }
        
        $query = "
        SELECT *
        FROM `books`
        LIMIT {$get_page}, 4
        ";
        
        $books = DB::select($query);
        
        header('Content-type: application/json');

        return json_encode($books);        
        
    }
}

