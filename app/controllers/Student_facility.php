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
        $university = $this->facility_studentModel->getStudentUni();
        $university = $university->university;
        $data = [
            'listings' => $this->facility_studentModel->foodView($university),
            'universities' => $this->facility_studentModel->getDistances(),
            'studentUni' => $this->facility_studentModel->getStudentUni()
        ];
        $this->loadview('facility/foodView', $data);
    }

    public function furniture()
    {
        $university = $this->facility_studentModel->getStudentUni();
        $university = $university->university;
        $data = [
            'listings' => $this->facility_studentModel->furnitureView($university),
            'universities' => $this->facility_studentModel->getDistances(),
            'studentUni' => $this->facility_studentModel->getStudentUni()
        ];
        $this->loadview('facility/furnitureView', $data);
    }

    public function viewOneListing($id)
    {
        $viewone = $this->facility_studentModel->viewOneListing($id);

        $data = [
            'viewone' => $viewone,
            'studentDetails' => $this->facility_studentModel->getStudentDetails($id),
            'universities' => $this->facility_studentModel->getDistance($id),
            'comments' => $this->facility_studentModel->getComments($id)
        ];

        $this->loadView('facility/viewOne', $data);
    }
//university filter
    public function uni_filter_handler()
    {
        if (isset($_GET['filter'])) {
            $uni = trim($_GET['filter']);
            $res =  json_encode($this->facility_studentModel->getListingsForUni($uni));
            echo $res;
        }
    }

    public function uni_furniture_filter_handler(){
        if (isset($_GET['filter'])) {
            $uni = trim($_GET['filter']);
            $res =  json_encode($this->facility_studentModel->getListingsForUniFurniture($uni));
            echo $res;
        }
    }

    public function uni_food_filter_handler(){
        if (isset($_GET['filter'])) {
            $uni = trim($_GET['filter']);
            $res =  json_encode($this->facility_studentModel->getListingsForUniFood($uni));
            echo $res;
        }
    }
//price filter
    public function price_sorter_handler()
    {
        if (isset($_GET['uni']) && isset($_GET['sort'])) {
            $sort_order = trim($_GET['sort']);
            $uni = trim($_GET['uni']);
            $res =  json_encode($this->facility_studentModel->getListingsForPrice($sort_order, $uni));
            echo $res;
        }
    }

    public function price_furniture_sorter_handler()
    {
        if (isset($_GET['uni']) && isset($_GET['sort'])) {
            $sort_order = trim($_GET['sort']);
            $uni = trim($_GET['uni']);
            $res =  json_encode($this->facility_studentModel->getListingsForPriceFurniture($sort_order, $uni));
            echo $res;
        }
    }

    public function price_food_sorter_handler()
    {
        if (isset($_GET['uni']) && isset($_GET['sort'])) {
            $sort_order = trim($_GET['sort']);
            $uni = trim($_GET['uni']);
            $res =  json_encode($this->facility_studentModel->getListingsForPriceFood($sort_order, $uni));
            echo $res;
        }
    }
//listing filter
    public function rating_sorter_handler()
    {
        if (isset($_GET['uni']) && isset($_GET['sort'])) {
            $sort_order = trim($_GET['sort']);
            $uni = trim($_GET['uni']);
            $res =  json_encode($this->facility_studentModel->getListingsForRating($sort_order, $uni));
            echo $res;
        }
    }

    public function rating_furniture_sorter_handler()
    {
        if (isset($_GET['uni']) && isset($_GET['sort'])) {
            $sort_order = trim($_GET['sort']);
            $uni = trim($_GET['uni']);
            $res =  json_encode($this->facility_studentModel->getListingsForRatingFurniture($sort_order, $uni));
            echo $res;
        }
    }

    public function rating_food_sorter_handler()
    {
        if (isset($_GET['uni']) && isset($_GET['sort'])) {
            $sort_order = trim($_GET['sort']);
            $uni = trim($_GET['uni']);
            $res =  json_encode($this->facility_studentModel->getListingsForRatingFood($sort_order, $uni));
            echo $res;
        }
    }
//date filter
    public function date_sorter_handler()
    {
        if (isset($_GET['uni']) && isset($_GET['sort'])) {
            $sort_order = trim($_GET['sort']);
            $uni = trim($_GET['uni']);
            $res =  json_encode($this->facility_studentModel->getListingsForDate($sort_order, $uni));
            echo $res;
        }
    }

    public function date_furniture_sorter_handler()
    {
        if (isset($_GET['uni']) && isset($_GET['sort'])) {
            $sort_order = trim($_GET['sort']);
            $uni = trim($_GET['uni']);
            $res =  json_encode($this->facility_studentModel->getListingsForDateFurniture($sort_order, $uni));
            echo $res;
        }
    }

    public function date_food_sorter_handler()
    {
        if (isset($_GET['uni']) && isset($_GET['sort'])) {
            $sort_order = trim($_GET['sort']);
            $uni = trim($_GET['uni']);
            $res =  json_encode($this->facility_studentModel->getListingsForDateFood($sort_order, $uni));
            echo $res;
        }
    }
//search filter
    public function search_listing()
    {
        if (isset($_GET['query'])) {
            //Check whether the search query is empty or not
            if (empty($_GET['query'])) {
                Student_facility::index();
            } else {
                $keyword = "%" . trim($_GET['query']) . "%";
                $uni = trim($_GET['uni']);
                $res =  json_encode($this->facility_studentModel->searchListings($keyword,$uni));
            }
            echo $res;
        }
    }

    public function furniture_search_listing()
    {
        if (isset($_GET['query'])) {
            //Check whether the search query is empty or not
            if (empty($_GET['query'])) {
                Student_facility::index();
            } else {
                $keyword = "%" . trim($_GET['query']) . "%";
                $uni = trim($_GET['uni']);
                $res =  json_encode($this->facility_studentModel->searchListingsFurniture($keyword,$uni));
            }
            echo $res;
        }
    }

    public function food_search_listing()
    {
        if (isset($_GET['query'])) {
            //Check whether the search query is empty or not
            if (empty($_GET['query'])) {
                Student_facility::index();
            } else {
                $keyword = "%" . trim($_GET['query']) . "%";
                $uni = trim($_GET['uni']);
                $res =  json_encode($this->facility_studentModel->searchListingsFood($keyword,$uni));
            }
            echo $res;
        }
    }

    public function comment_loader(){
        if (isset($_GET['feedback'])==NULL) {
            $listing_id = trim($_GET['id']);
            $res =  json_encode($this->facility_studentModel->getComments($listing_id));
        }else{
            $review_id = substr(sha1(date(DATE_ATOM)), 0, 8);
            $listing_id = trim($_GET['id']);
            $rating = trim($_GET['rating']);
            $feedback = trim($_GET['feedback']);
    
            //check if the user has already commented
            if($this->facility_studentModel->checkComment($listing_id)){
                if($this->facility_studentModel->updateComment($listing_id, $rating, $feedback)){
                    $res =  json_encode($this->facility_studentModel->getComments($listing_id));
                }
            }else{
                if($this->facility_studentModel->addComment($review_id,$listing_id, $rating, $feedback)){
                    $res =  json_encode($this->facility_studentModel->getComments($listing_id));
                }
            }


        }

        echo $res;
    }

    public function comment_helpful_handler(){
        $review_id = trim($_GET['id']);
        $value = trim($_GET['value']);
        $listing_id = trim($_GET['listing']);
        
        if($this->facility_studentModel->checkHelpful($review_id)){
            if($value=='no'){
                if($this->facility_studentModel->removeHelpful($review_id)){
                    $res =  json_encode($this->facility_studentModel->getComments($listing_id));
                }
            }else{
                $res =  json_encode($this->facility_studentModel->getComments($listing_id));
            }
        }else{
            if($value=='yes'){
                if($this->facility_studentModel->addHelpful($review_id)){
                    $res =  json_encode($this->facility_studentModel->getComments($listing_id));
                }
            }else{
                $res =  json_encode($this->facility_studentModel->getComments($listing_id));
            }
        }

        echo $res;
    }

}
