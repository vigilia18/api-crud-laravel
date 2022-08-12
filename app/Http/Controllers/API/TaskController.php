<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveTask;
use App\Models\Task;
use GMP;
use Illuminate\Http\Request;
use SimpleXMLElement;
use XMLParser;

class TaskController extends Controller
{


        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function indexAdmin(){
        $data= Task::all();
        return response()->json($data);
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task=Task::all()->where("active","=",true)->toArray();
        $data=array_values($task);
        //$task =Task::all()->where("active","=",1)->toArray();//->orderBy("title");
        //$data=['success'=>200,"data"=>$task];
        return response()->json($data,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveTask $req)
    {
        try{
            $task=new Task;
            $task->title=$req->title;
            $task->descripcion=$req->descripcion;
            $task->save();
            return response()->json([
                'res'=>true,
                'msg'=> 'Tarea creada exitosamente'
            ]);
        }
        catch(mixed $err){
            return response(["res"=>$err],505);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task=$this->oneTask($id);
        if($task==null){
            return response()->json(["error"=>"No se encntro ninguna tarea"]);
        }
        return $task;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $task=$this->oneTask($id);
        if($task===null){
            return response('',404)->json(["error"=>"No se encntro ninguna tarea"]);
        }
        $task->title=$req->title;
        $task->descripcion=$req->descripcion;
        $task->status=$req->status;
        try{
            $task->save();
            return response()->json(["msg"=>"Se edito la tarea correctaente","data"=>$task]);
        }
        catch(mixed $err){
            return response()->json(["msg"=>"No se pudo editar la tarea","error"=>$err]);
        }
    }

    public function completeTask(int $id,bool $check){
        $task=$this->oneTask($id);
        if($task==null){
            return response()->json(["msg"=>"No se encontro una tarea asi"]);
        }
        try{
            $task->status=$check;
            $task->save();
            return response()->json(["msg"=>"Tarea modificada con exito"]);
        }
        catch(mixed $err){
            return response()->json(["msg"=>"No se pudo completar la tarea","error"=>$err]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task=$this->oneTask($id);
        if($task==null){
            return response()->json(["msg"=>"No se encontro una tarea asi"]);
        }
        try{
            $task->active=false;
            $task->save();
            return response()->json(["msg"=>"Tarea eliminada con exito"]);
        }
        catch(mixed $err){
            return response()->json(["msg"=>"No se pudo eliminar la tarea","error"=>$err]);
        }
    }

    private function oneTask($id){
        $task=Task::find($id);
        if(!$task || $task->active!=true){
            return null;
        }
        return $task;
    }
}
