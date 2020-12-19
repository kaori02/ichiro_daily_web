<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){  return view('pages.index');  }
    public function achievement(){  return view('pages.achievement');  }
    public function contact(){  return view('pages.contact');  }
    public function research(){  return view('pages.research');  }
    public function robots(){  return view('pages.robots');  }
    public function sponsors(){  return view('pages.sponsors');  }
    public function teams(){  return view('pages.teams');  }
}
