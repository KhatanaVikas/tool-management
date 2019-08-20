<?php

namespace App\Http\Controllers;

use App\Tool;
use App\ToolGroup;
use App\Users;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homeAction()
    {
        $toolGroups = ToolGroup::all()->toArray();
        $tools = Tool::all();

        return view('index', array('toolGroups' => $toolGroups, 'tools' => $tools));
    }
}
