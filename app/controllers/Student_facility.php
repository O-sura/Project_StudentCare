<?php
Session::init();
class Student_facility extends Controller
{
    private $facility_studentModel;

    public function __construct()
    {
        $this->facility_studentModel = $this->loadmodel('Facility_StudentModel');
    }

    public function index()
    {
        $university = $this->facility_studentModel->getStudentUni();
        $university = $university->university;
        $data = [
            'listings' => $this->facility_studentModel->propertyView($university),
            'universities' => $this->facility_studentModel->getDistances(),
            'studentUni' => $this->facility_studentModel->getStudentUni()
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

    public function viewOneListing($id)
    {
        $viewone = $this->facility_studentModel->viewOneListing($id);

        $data = [
            'viewone' => $viewone
        ];

        $this->loadView('facility/viewOne', $data);
    }

    public function uni_filter_handler()
    {
        if (isset($_GET['filter'])) {
            $uni = trim($_GET['filter']);
            $res =  json_encode($this->facility_studentModel->getListingsForUni($uni));
            echo $res;
        }
    }

    public function price_sorter_handler()
    {
        if (isset($_GET['uni']) && isset($_GET['sort'])) {
            $sort_order = trim($_GET['sort']);
            $uni = trim($_GET['uni']);
            $res =  json_encode($this->facility_studentModel->getListingsForPrice($sort_order, $uni));
            echo $res;
        }
    }
    public function rating_sorter_handler()
    {
        if (isset($_GET['uni']) && isset($_GET['sort'])) {
            $sort_order = trim($_GET['sort']);
            $uni = trim($_GET['uni']);
            $res =  json_encode($this->facility_studentModel->getListingsForRating($sort_order, $uni));
            echo $res;
        }
    }

    public function date_sorter_handler()
    {
        if (isset($_GET['uni']) && isset($_GET['sort'])) {
            $sort_order = trim($_GET['sort']);
            $uni = trim($_GET['uni']);
            $res =  json_encode($this->facility_studentModel->getListingsForDate($sort_order, $uni));
            echo $res;
        }
    }

    public function search_listing()
    {
        header("Access-Control-Allow-Origin: *");
        if (isset($_GET['query'])) {
            //Check whether the search query is empty or not
            if (empty($_GET['query'])) {
                $university = $this->facility_studentModel->getStudentUni();
                $university = $university->university;
                $res =  json_encode($this->facility_studentModel->propertyView($university));
            } else {
                $keyword = "%" . trim($_GET['query']) . "%";
                $res =  $this->facility_studentModel->searchPosts($keyword);
            }
            echo $res;
        }
    }
}
