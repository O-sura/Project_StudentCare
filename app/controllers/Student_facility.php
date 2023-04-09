<?php
class Student_facility extends Controller
{
    private $facility_studentModel;

    public function __construct()
    {
        $this->facility_studentModel = $this->loadmodel('Facility_StudentModel');
    }

    public function index()
    {
        $data = [
            'listings' => $this->facility_studentModel->propertyView()
        ];
        $this->loadview('facility/index', $data);
    }

    public function food()
    {
        $data = [
            'listings' => $this->facility_studentModel->foodView()
        ];
        $this->loadview('facility/foodView', $data);
    }

    public function furniture()
    {
        $data = [
            'listings' => $this->facility_studentModel->furnitureView()
        ];
        $this->loadview('facility/furnitureView', $data);
    }

    public function viewOneListing($id){
        $viewone = $this->facility_studentModel->viewOneListing($id);

        $data =[
            'viewone' => $viewone
        ]; 
        
        $this->loadView('facility/viewOne',$data);
    }
}
