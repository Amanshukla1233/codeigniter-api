<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH .'/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;


class ApiEmployee extends RestController
{
    public function __construct(){
        parent::__construct();
        $this->load->model("EmployeeModel");
    }
    public function index_get(){
//echo "i am restful employee ";
    $employee=new EmployeeModel;
   $result_emp= $employee->get_employee();
   $this->response($result_emp,200);
    }
    public function storeEmployee_post()
    {
        $employee=new EmployeeModel;
        $data=[
            'first_name'=> $this->input->post('first_name'),
            'last_name'=> $this->input->post('last_name'),
            'phone'=> $this->input->post('phone'),
            'email'=> $this->input->post('email'),
           
        ];
        $result=$employee->insertEmployee($data);
       // $this->response($data,200);
       if($result >0)
       {
        $this->response([
            'status'=> true,
            'massage'=>'NEW EMPLOYEE CREATED'
        ],RestController::HTTP_OK);
       }
       else{
        $this->response([
            'status'=> false,
            'massage'=>'FAILED TO CREATE EMPLOYEE '
        ],RestController::HTTP_BAD_REQUEST);

       }
    }
    public function findEmployee_get($id)
    {
        $employee=new EmployeeModel;
        $result=$employee->editemployee($id) ;
        $this->response($result,200);
    }
    public function updateEmployee_put($id)
    {
        $employee=new EmployeeModel;
        $data=[
            'first_name'=> $this->put('first_name'),
            'last_name'=> $this->put('last_name'),
            'phone'=> $this->put('phone'),
            'email'=> $this->put('email'),
           
        ];
        $update_result=$employee->updateEmployee($id,$data);
       // $this->response($data,200);
       if($update_result >0)
       {
        $this->response([
            'status'=> true,
            'massage'=>'EMPLOYEE UPDATED'
        ],RestController::HTTP_OK);
       }
       else{
        $this->response([
            'status'=> false,
            'massage'=>'FAILED TO UPDATE EMPLOYEE '
        ],RestController::HTTP_BAD_REQUEST);

       } 
    }
    public function deleteEmployee_delete($id)
    {
        $employee=new EmployeeModel;
        $result=$employee->deleteemployee($id) ;
        if($result >0)
       {
        $this->response([
            'status'=> true,
            'massage'=>'EMPLOYEE DELETE'
        ],RestController::HTTP_OK);
       }
       else{
        $this->response([
            'status'=> false,
            'massage'=>'FAILED TO DELETE EMPLOYEE '
        ],RestController::HTTP_BAD_REQUEST);

       } 
    }
}
?>