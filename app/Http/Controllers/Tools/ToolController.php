<?php

namespace App\Http\Controllers\Tools;

use App\Tool;
use App\ToolGroup;
use App\Http\Controllers\Controller;
use function request as request;

/**
 * This is an API controller, with following responsibilities
 * 1.   getToolGroupAction()  -- To Get Tool Groups
 * 2.   getToolListAction()   -- To get the list of all purchased tools
 * 3.   deleteToolAction()    -- To delete a tool from list
 * 4.   updateToolAction()    -- To update data of a tool
 * 5.   addNewToolAction()    -- TO add a new tool to list
 * Class ToolController
 * @package App\Http\Controllers\API
 */
class ToolController extends Controller
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

        $tools = Tool::with('user','group')->get()->toArray();
        $data = array(
            'tools' => $tools
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
        $tool = Tool::find($tool_id);
        if (empty($tool)) {
            return 'Could not find the tool with this id';
        }
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
        $tool = Tool::find($tool_id);
        if (empty($tool)) {
            return 'Could not find the tool with this id';
        }
        //see if username is changed
        $userId = auth()->user()->getAuthIdentifier();

        try {
            $tool->name = request('tool_name');
            $tool->tool_group_id = request('tool_group');
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

//        $userName = request('user_name');
        $toolName = request('tool_name');
        $toolGroupId = request('tool_group');
        $costPrice = request('cost_price');

        $userId = auth()->user()->getAuthIdentifier();
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
