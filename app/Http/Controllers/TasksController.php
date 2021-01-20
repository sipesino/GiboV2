<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use DB;
use Exception;
use Facade\FlareClient\Http\Response;

class TasksController extends Controller
{

    /*
     * Sample no-refresh loading
     */

    public function sample()
    {
        return view('sample');
    }

    public function loadTodo($id, Request $request)
    {
        $result = array('response' => true, 'message' => 'Success');
        try {
            if ($request->input('count') == 1) {
                $result['data'] = Task::all()->count();
            } else {
                $page = $request->input('page') == 'undefined' || empty($request->input('page')) ? 1 : $request->input('page');
                $limit = $request->input('limit') == 'undefined' || empty($request->input('limit')) ? 5 : $request->input('limit');
                $sort = $request->input('sortBy') == 'undefined' || empty($request->input('sortBy')) ? 'ASC' : $request->input('sortBy');
                $order = $request->input('orderBy') == 'undefined' || empty($request->input('orderBy')) ? 'taskNo' : $request->input('orderBy');
                if ($id == 'all') {
                    $result['data'] = Task::orderBy($order, $sort)->paginate($limit);
                } else {
                    $result['data'] = Task::findOrFail($id);
                }
            }
        } catch (Exception $e) {
            $result['response'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function addTodo(Request $request)
    {

        $result = array('response' => true, 'message' => 'Task added successfully.');
        try {
            $params = $request->input('params');
            if (empty($params['description']) || empty($params['duedate'])) {
                throw new Exception('Invalid parameters');
            }
            $result['data'] = Task::create($params);
        } catch (Exception $e) {
            $result['response'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function updateTodo(Request $request)
    {
        $result = array('response' => true, 'message' => 'Task updated successfully.');
        try {
            $params = $request->input('params');
            if (empty($params['description']) || empty($params['duedate'])) {
                throw new Exception('Invalid parameters');
            }
            $task = Task::find($params["taskNo"]);
            $task->description = $params["description"];
            $task->duedate = str_replace("T", " ", $params["duedate"]);
            $task->save();
        } catch (Exception $e) {
            $result['response'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function deleteTodo($id)
    {
        $result = array('response' => true, 'message' => 'Task deleted modafaka successfully.');
        try {
            $task = Task::find($id);
            $task->delete();
        } catch (Exception $e) {
            $result['response'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }
    /* ======================================== */


    public function index()
    {
        return view('index');
    }
}
