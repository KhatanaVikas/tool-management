<?php

namespace App\Http\Controllers\API;

use App\Tool;
use App\ToolGroup;
use App\Http\Controllers\Controller;
use App\Users;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use function request as request;

/**
 * This is an API controller, with following responsibilities
 * 1.   getToolGroupAction()  -- To Get Tool Groups
 * 2.   getToolListAction()   -- To get the list of all purchased tools
 * 3.   deleteToolAction()    -- To delete a tool from list
 * 4.   updateToolAction()    -- To update data of a tool
 * 5.   addNewToolAction()    -- TO add a new tool to list
 * Class ToolManagerController
 * @package App\Http\Controllers\API
 */
class ToolManagerController extends Controller
{
    /**
     * Description: Get Tool Groups api
     *
     * @return mixed
     */
    public function getToolGroupAction()
    {
        $toolGroups = ToolGroup::all()->toArray();

        return $toolGroups;
    }

    /**
     * Description: Get All Tools api
     *
     * @return array
     */
    public function getToolListAction()
    {
        $toolGroups = ToolGroup::all()->toArray();
        $tools = Tool::all();

        $newToolsArray = array();
        foreach ($tools as $key => $tool) {
            $newToolsArray[$key]['id'] = $tool->id;
            $newToolsArray[$key]['name'] = $tool->name;
            $newToolsArray[$key]['purchase_date'] = $tool->purchase_date;
            $newToolsArray[$key]['cost_price'] = $tool->cost_price;
            $newToolsArray[$key]['tool_group_name'] = $tool->group->name;
            $newToolsArray[$key]['user_name'] = $tool->user->name;
        }
        $data = array(
            'tools' => $newToolsArray,
            'toolGroups' => $toolGroups
        );

        return $data;
    }

    /**
     * Description: Delete a tool api
     *
     * @param $tool_id
     * @return string
     */
    public function deleteToolAction($tool_id)
    {
        if (!Tool::find($tool_id)) {
            return 'Could not find the tool with this id';
        }
        $tool = Tool::find($tool_id);
        $tool->delete();

        return 'Tool deleted successfully';
    }


    /**
     * Description: Update tool api
     *
     * @param $tool_id
     * @return string
     */
    public function updateToolAction($tool_id)
    {
        if (!Tool::find($tool_id)) {
            return 'Could not find the tool with this id';
        }

        $tool = Tool::find($tool_id);
        //see if username is changed
        if (Users::where('name', request('user_name'))->first()) {
            $user = Users::where('name', request('user_name'))->first();
        } else {
            $user = new Users();
            try {
                $user->name = request('user_name');
                $user->save();
            } catch (\Exception $ex) {
                //handle errors here
                return 'Could not insert new user. ERROR: ' . $ex->getMessage();
            }
        }

        $userId = $user->id;
        try {
            $tool->name = request('tool_name');
            $tool->tool_group_id = request('tool_group_id');
            $tool->user_id = $userId;
            $tool->cost_price = request('cost_price');
            $tool->save();
        } catch (\Exception $ex) {
            //handle errors here
            return 'Could not update tool . ERROR: ' . $ex->getMessage();
        }

        return 'Tool updated successfully';
    }

    /**
     * Description: Add new tool api
     *
     * @return string
     */
    public function addNewToolAction()
    {
        $tool = new Tool();

        $userName = request('user_name');
        $toolName = request('tool_name');
        $toolGroupId = request('tool_group');
        $costPrice = request('cost_price');
        if (Users::where('name', $userName)->first()) {
            $user = Users::where('name', $userName)->first();
        } else {
            $user = new Users();
            try {
                $user->name = $userName;
                $user->save();
            } catch (\Exception $ex) {
                //handle errors here
                return 'Could not add user . ERROR: ' . $ex->getMessage();
            }
        }
        $userId = $user->id;
        try {
            $tool->name = $toolName;
            $tool->tool_group_id = $toolGroupId;
            $tool->user_id = $userId;
            $tool->cost_price = $costPrice;
            $tool->purchase_date = new \DateTime();
            $tool->save();
        } catch (\Exception $ex) {
            //handle errors here
            return 'Could not add tool . ERROR: ' . $ex->getMessage();
        }

        return 'Tool added successfully';
    }

}
