<?php


namespace App\Http\Controllers\UI;


use App\Model\Sort;
use Illuminate\Http\Request;

class SortController
{
    public function showDatatable()
    {
        $tasks = Sort::orderBy('order','ASC')->select('id','title','status','created_at')->get();

        return view('sort.sortabledatatable',compact('tasks'));
    }

    public function updateOrder(Request $request)
    {
        $tasks = Sort::all();

        foreach ($tasks as $task) {
            $task->timestamps = false; // To disable update_at field updation
            $id = $task->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['order' => $order['position']]);
                }
            }
        }

        return response('Update Successfully.', 200);
    }
}