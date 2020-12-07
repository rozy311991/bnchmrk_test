<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Exception;
use App\Repositories\StudentRepository;
use Validator;
use Illuminate\Http\Response;
use DB;

class StudentController extends Controller
{

    protected $studentRepo;

    public function __construct(StudentRepository $studentRepository){
        $this->studentRepo = $studentRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $addStudentReq = $request->all();
            $validator = Validator::make($addStudentReq, [
                'first_name'=>'required',
                'last_name'=>'required',
                'email'=>'required|unique:students|max:255',
                'password'=>'required',
                'pocket_money'=>'required|numeric',
                'age'=>'required|numeric',
                'city'=>'required',
                'state'=>'required',
                'zip'=>'required',
                'country'=>'required'
            ]);
            if($validator->fails()){
                return response($validator->messages());
            }
            $addStudentReq['password'] = \Hash::make('secret');
            $response = $this->studentRepo->storeStudent($addStudentReq);
             if(!empty($response->id) && ($response->id) > 0){
                return json_encode(["success"=>"Record Created Successfully","status_code"=>200]);
             }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }
    /**
     * Get Second Highest Pocket Money from Student
     */

     public function getSecondHighestPocketMoneyOfStudent(){
         try {
             return Student::select('id','first_name','last_name','pocket_money')->orderBy('pocket_money','desc')->offset(1)->limit(1)->first();            
         } catch (\Exception $th) {
             throw $th;
         }
     }
     /**
      * Get Listing of Students
      */
     public function getStudentsListings(){
         try {
             $fetchStudentLists = Student::get();
             // for checking if the list is prime or not, if the is_prime == 1 then prime record otherwise not prime record
             if(!empty($fetchStudentLists)){
                $fetchStudentLists = $fetchStudentLists->toArray();
                array_walk($fetchStudentLists,function(&$value,$key) {                        
                    $value['is_prime'] = $this->checkIfNumberIsPrime($value['id']);
                });    
             }
             return response()->json([
                'status_code' => 200,
                'response' => $fetchStudentLists
            ]);
         } catch (\Exception $th) {
             throw $th;
         }
     }

     public function checkIfNumberIsPrime($number){
         try {
            if ($number == 1) 
            return 0; 
            for ($i = 2; $i <= $number/2; $i++){ 
                if ($number % $i == 0) 
                    return 0; 
            } 
            return 1; 
            
         } catch (\Exception $th) {
             throw $th;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
