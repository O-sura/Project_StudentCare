<?php
Session::init();
class Facility_Provider extends Controller{
    private $ListingModel;
    
    public function __construct(){
        Middleware::authorizeUser(Session::get('userrole'), 'facility_provider');
        $this->ListingModel = $this->loadModel('Facility_Providers');
    
    }


    public function index(){
        $myview = $this->ListingModel->myListing();

        $data =[
            'myview' => $myview,
            'universities' => $this->ListingModel->getDistances(),
        ]; 
        
        $this->loadView('facility_provider/myListing',$data);
    }


    public function myListing(){
        $myview = $this->ListingModel->myListing();

        $data =[
            'myview' => $myview
        ]; 
        
        $this->loadView('facility_provider/myListing',$data);
        //$this->loadView('test',$data);
    }


    public function profile(){
        $profile = $this->ListingModel->profile();
        
        $data =[
            'profile' => $profile
        ]; 
        
        $this->loadView('facility_provider/profile',$data);
    }


    public function editprofile(){

        /* $profile = $this->ListingModel->editprofile();


            
        $data =[
            'name' => $profile->fullname,
            'email' => $profile->email,
            'nic' => $profile->nic,
            'contact' => $profile->contact_no,
            'address' => $profile->home_address,
            'category' => $profile->category,
            'profile' => $profile->profile_img,
            'name_err' => '',
            'email_err' => '',
            'address_err' => '',
            'contact_err' => '',
            'category_err' => ''
        ];  
        $this->loadView('facility_provider/editprofile',$data);
        */
        
        $user_id = Session::get('userID');
        $editprofile = $this->ListingModel->editprofile($user_id);
          
        $data = [    
            'editprofile' => $editprofile
        ];

        $this->loadView('facility_provider/editprofile',$data);
    }


    public function changeprofile(){
        $user_id = Session::get('userID');
        $editprofile = $this->ListingModel->editprofile($user_id);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['saveImg'])){
                if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){

                    $filename = $_FILES['file']['name'];
                    $tempname = $_FILES['file']['tmp_name'];
                    $folder = "/public/img/".$filename;

                    if(move_uploaded_file($tempname,$folder)){
                        echo 'File successfully uploaded!';
                    }
                    else{
                        echo "Please add a valid image!";
                    }
                }
            } 
        }

        $data = [    
            'editprofile' => $editprofile
        ];

        $this->loadView('facility_provider/editprofile',$data);

        /* $profile = $this->ListingModel->editprofile();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $filename = $_FILES["file"]["name"];
            $tempname = $_FILES["file"]["tmp_name"];
            $folder =  PUBLICPATH . "img/fprovider/".$filename;

            if(move_uploaded_file($tempname, $folder)){
                echo 'File successfully uploaded';
            }
            else if(empty($filename) && empty($tempname)){
                $filename = $profile->profile_img;
                $folder = PUBLICPATH . "img/counselor/".$filename;
                $tempname = tempnam(sys_get_temp_dir(), 'image_');
                copy($folder,$tempname);
            }
            else {
                //Image uploading error notification
                echo 'Error in uploading the image';
                die();
            }

            //Check and validate the data
            //Set errors if something is wrong
            $name = $_POST['fullname'];
            $email = $_POST['email'];
            $nic = $_POST['nic'];
            $contact = $_POST['contact_no'];
            $address = $_POST['home_address'];
            $category = $_POST['category'];

            $data =[
                'profile_img' => $filename,
                'name' => $name,
                'email' => $email,
                'nic' => $nic,
                'contact' => $contact,
                'address' => $address,
                'category' => $category,
                'name_err' => '',
                'email_err' => '',
                'address_err' => '',
                'contact_err' => '',
                'category_err' => ''
            ]; 

            //Check whether all the fields are filled properly
            if(empty($data['name'])){
                $data['name_err'] =  "*Name field is Required";
            }

            if(empty($data['email'])){
                $data['email_err'] = "*Email field is Required";
            }

            if(empty($data['address'])){
                $data['address_err'] = "*Address field is Required";
            }

            if( empty($data['contact'])){
                $data['contact_err'] = "*Contact field is Required";
            }

            if( empty($data['category'])){
                $data['category_err'] = "*category field is Required";
            }

            //Email is valid or not
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = "*Invalid email format";
            }

             //Check the mobile number
             if(strlen($contact) != 10){
                $data['contact_err'] = "*Invalid Contact Number";
            }

            //Make sure there are no error flags are set
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['address_err']) && empty($data['contact_err']) && empty($data['category_err']) ){
                $res = $this->ListingModel->updateProfileDetails($data);

                if($res){
                    FlashMessage::flash('update_profile_flash', "Successfully Updated Your Profile Details!", "success");
                    Middleware::redirect('Counsellor/ProfileView');
                }else{
                    //Error Notification
                    echo 'Error: Something went wrong in adding post to the databse';
                    Middleware::redirect('Counsellor/EditProfile');
                    die();
                }
            }
            else{
                $this->loadView('facility_provider/editprofile',$data);
            }
        }
        else{
            //get the relavent details from the model
            $profile = $this->ListingModel->editprofile();

            $data = [
                'profile' => $profile
            ];
            $this->loadView('facility_provider/editprofile',$data);
        } */
    }


    
    public function addItem(){

        if (isset($_POST['submit'])) {
            //Check and validate the data
            //Set errors if something is wrong
            
            $topic = $_POST['topic'];
            $description = $_POST['description'];
            $rental = $_POST['rental'];
            $location = $_POST['location'];
            $address = $_POST['address'];
            $uniName = $_POST['uniName'];
            $uniDistance = $_POST['uniDistance'];
            $images = $_FILES['images'];
            $special_note = $_POST['special_note'];
            $category = $_POST['category'];
            
            $uniList = [];
            $uniDistanceList = [];
            foreach ($uniName as $uni){
                array_push($uniList, trim($uni));
            }

            foreach ($uniDistance as $distance){
                array_push($uniDistanceList, trim($distance));
            }

            // $data = [
            //     'images' => $_FILES['images']
            // ];

            // $this->loadView('test',$data);
            
            

            $data = [
                'topic' => trim($topic),
                'description' => trim($description),
                'rental' => trim($rental),
                'location' => trim($location),
                'address' => trim($address),
                'uniName' => json_encode($uniList),
                'images' => $_FILES['images'],
                'special_note' => trim($special_note),
                'category' => trim($category),
                'topic_err' => '',
                'description_err' => '',
                'rental_err' => '',
                'location_err' => '',
                'address_err' => '',
                'uniName_err' => '',
                'uniDistance_err' => '',
                'images_err' => '',
                'special_note_err' => '',
                'category_err' => ''
            ];

            //Check whether all the fields are filled properly
            if(!$_POST['topic'] && !$_POST['description'] && !$_POST['rental'] && !$_POST['location'] && !$_POST['address'] && !$_POST['uniName'] && !$_POST['images'] && !$_POST['special_note'] && !$_POST['category']){
                $data['topic_err'] =  "*This field is Required";
                $data['description_err'] = "*This field is Required";
                $data['rental_err'] = "*This field is Required";
                $data['location_err'] = "*This field is Required";
                $data['address_err'] = "*This field is Required";
                $data['uniName_err'] = "*This field is Required";
                $data['uniDistance_err'] = "*This field is Required";
                $data['images_err'] = "*This field is Required";
                $data['special_note_err'] = "*This field is Required";
                $data['category_err'] = "*You should choose a category";
            }

            $num_of_images = count($images['name']);    //number of images

            $uploaded_images = [];

            for($i=0; $i< $num_of_images; $i++){
                //get the image information and store them in var
                $image_name = $images['name'][$i];
                $tmp_name = $images['tmp_name'][$i];
                $error = $images['error'][$i];
                $uploaded_images[] = [
                    "name" => $image_name,
                    "tmp_name" => $tmp_name,
                    "error" => $error
                ];
            }


            $image_urls = [];

            foreach($uploaded_images as $uploaded_image) {
                //get image extension store it in var
                $image_ex = pathinfo($uploaded_image["name"], PATHINFO_EXTENSION);  

                //convert the image extension into lower case and store it in var
                $image_ex_lc = strtolower($image_ex);

                //create array that stores allowed to upload image extensions
                $allowed_exs = array('jpg', 'jpeg', 'png');

                //check if the image extension is present in $allowed_exs array
                if(in_array($image_ex_lc, $allowed_exs)){  

                    //renaming the image name with random string             
                    $new_image_name = uniqid('IMG-', true).'.'.$image_ex_lc;   

                    //creating upload path on root directory
                    $image_upload_path = PUBLICPATH . "/img/listing/". $new_image_name;

                    //move uploaded image to 'images' folder
                    move_uploaded_file($uploaded_image["tmp_name"], $image_upload_path);

                    $images = json_encode($images);
                    $image_urls[] = $new_image_name;
                    // header("Location: propertyView.php");
                }else{
                    echo("You can't upload files of this category");
                }
            }

            $image_urls = json_encode($image_urls);
            
            $uniName = json_encode($uniName);
            $listing_id = substr(sha1(date(DATE_ATOM)), 0, 8);
            $validatedData = [
                'listingID' => $listing_id,
                'topic' => $data['topic'],
                'fpID' => Session::get('userID'),
                'description' => $data['description'],
                'rental' => $data['rental'],
                'location' => $data['location'],
                'address' => $data['address'],
                // 'uniName' => $uniName,
                'image_urls' => $image_urls,
                'special_note' => $data['special_note'],
                'category' => $data['category']
            ];

            //Make sure there are no error flags are set
            if(empty($data['topic_err']) && empty($data['description_err']) && empty($data['rental_err']) && empty($data['location_err']) && empty($data['address_err']) 
                && empty($data['uniName_err']) && empty($data['images_err']) && empty($data['special_note_err']) && empty($data['category_err']) && empty($data['uniDistance_err'])){

                $num = count($uniList);
                
                $this->ListingModel->addItem($validatedData); //add basic listing details to the database

                for($i=0; $i<$num; $i++){  //add university details to the database
                    $name = $uniList[$i];
                    $distance = $uniDistanceList[$i];
                    $uniData['uniID'] = $listing_id;
                    $uniData['uniName'] = $name;
                    $uniData['uniDistance'] = $distance;
                    $this->ListingModel->addUniDistance($uniData);
                }


                Middleware::redirect('./facility_provider/addItem');
                
            }else{
                //load the same page with erros
                $this->loadView('facility_provider/addItem', $data);
            }
               
        }else{
            //Send the empty detail page
            $data = [ 
                'topic' => '',
                'description' => '',
                'rental' => '',
                'location' => '',
                'address' => '',
                'uniName' => '',
                'images' => '',
                'special_note' => '',
                'category' => '',
                'topic_err' => '',
                'description_err' => '',
                'rental_err' => '',
                'location_err' => '',
                'address_err' => '',
                'uniName_err' => '',
                'uniDistance_err' => '',
                'images_err' => '',
                'special_note_err' => '',
                'category_err' => ''
            ];

            $this->loadView('facility_provider/addItem', $data);

        }
    }


    //take data relevent to property items
    public function propertyView(){
        $view = $this->ListingModel->propertyView();

        //Prepare the data to be passed to the view
        $data =[
            'view' => $view,
            'universities' => $this->ListingModel->getDistances()
        ]; 
        
        //Load the view and pass the data to it
        $this->loadView('facility_provider/propertyView',$data);
    }


    //take data relevent to food items
    public function foodView(){
        $view = $this->ListingModel->foodView();

        $data =[
            'view' => $view,
            'universities' => $this->ListingModel->getDistances()
        ]; 
        
        $this->loadView('facility_provider/foodView',$data);
    }


    //take data relevent to furniture items
    public function furnitureView(){
        $view = $this->ListingModel->furnitureView();

        $data =[
            'view' => $view,
            'universities' => $this->ListingModel->getDistances()
        ]; 
        
        $this->loadView('facility_provider/furnitureView',$data);
    }


    //take data relevent to one listing item
    public function viewOneListing($id){
        $viewone = $this->ListingModel->viewOneListing($id);

        $data =[
            'viewone' => $viewone,
            'universities' => $this->ListingModel->getDistances()
        ]; 
        
        $this->loadView('facility_provider/viewOne',$data);
    }

    public function propertysearch(){
        /* $this->ListingModel->propertysearch();
        if(isset($_POST['search'])){
            $string = '%' . $_POST['searchbtn'] . '%' ;
        }
        $this->loadView('facility_provider/report',$string); */
        header("Access-Control-Allow-Origin: *");
        if(isset($_GET['query'])){
            //Check whether the search query is empty or not
            if(empty($_GET['query'])){
                $result =  json_encode($this->ListingModel->propertysearch());
            }else{
                $keyword = "%" . trim($_GET['query']) . "%";
                $result =  $this->ListingModel->propertysearch($keyword);
            }
            echo $result;
        }
    }

    public function findItemByLocation(){
        
    }

    public function message(){
        $message = $this->ListingModel->message();

        $data =[
            'message' => $message
        ]; 
        
        $this->loadView('facility_provider/message',$data);
    }

    //take data to generate reports
    public function report(){
        $report = $this->ListingModel->report();

        $data =[
            'report' => $report
        ]; 
        
        $this->loadView('facility_provider/report',$data);
    }

    public function editItem($id){

        if (isset($_POST['submit'])) {

            //Start the session
            Session::init();

            //Check and validate the data
            //Set errors if something is wrong
            $topic = $_POST['topic'];
            $description = $_POST['description'];
            $rental = $_POST['rental'];
            $location = $_POST['location'];
            $address = $_POST['address'];
            $uniName = $_POST['uniName'];
            $images = $_FILES['images'];
            $special_note = $_POST['special_note'];
            $category = $_POST['category'];

            $uniList = [];
            foreach ($uniName as $uni){
                array_push($uniList, trim($uni));
            }

            $data = [
                'id' => $id,
                'topic' => trim($topic),
                'description' => trim($description),
                'rental' => trim($rental),
                'location' => trim($location),
                'address' => trim($address),
                'uniName' => json_encode($uniList),
                'images' => $_FILES['images'],
                'special_note' => trim($special_note),
                'category' => trim($category),
                'topic_err' => '',
                'description_err' => '',
                'rental_err' => '',
                'location_err' => '',
                'address_err' => '',
                'uniName_err' => '',
                'images_err' => '',
                'special_note_err' => '',
                'category_err' => ''
            ];

            //Check whether all the fields are filled properly
            if(!$_POST['topic'] && !$_POST['description'] && !$_POST['rental'] && !$_POST['location'] && !$_POST['address'] && !$_POST['uniName'] && !$_POST['images'] && !$_POST['special_note'] && !$_POST['category']){
                $data['topic_err'] =  "*This field is Required";
                $data['description_err'] = "*This field is Required";
                $data['rental_err'] = "*This field is Required";
                $data['location_err'] = "*This field is Required";
                $data['address_err'] = "*This field is Required";
                $data['uniName_err'] = "*This field is Required";
                $data['images_err'] = "*This field is Required";
                $data['special_note_err'] = "*This field is Required";
                $data['category_err'] = "*You should choose a category";
            }

            $num_of_images = count($images['name']);    //number of images

            $uploaded_images = [];

            for($i=0; $i< $num_of_images; $i++){
                //get the image information and store them in var
                $image_name = $images['name'][$i];
                $tmp_name = $images['tmp_name'][$i];
                $error = $images['error'][$i];
                $uploaded_images[] = [
                    "name" => $image_name,
                    "tmp_name" => $tmp_name,
                    "error" => $error
                ];
            }


            $image_urls = [];

            foreach($uploaded_images as $uploaded_image) {
                //get image extension store it in var
                $image_ex = pathinfo($uploaded_image["name"], PATHINFO_EXTENSION);  

                //convert the image extension into lower case and store it in var
                $image_ex_lc = strtolower($image_ex);

                //create array that stores allowed to upload image extensions
                $allowed_exs = array('jpg', 'jpeg', 'png');

                //check if the image extension is present in $allowed_exs array
                if(in_array($image_ex_lc, $allowed_exs)){  

                    //renaming the image name with random string             
                    $new_image_name = uniqid('IMG-', true).'.'.$image_ex_lc;   

                    //creating upload path on root directory
                    $image_upload_path = PUBLICPATH . "/img/listing/". $new_image_name;

                    //move uploaded image to 'images' folder
                    move_uploaded_file($uploaded_image["tmp_name"], $image_upload_path);

                    $images = json_encode($images);
                    $image_urls[] = $new_image_name;
                    // header("Location: propertyView.php");
                }else{
                    echo("You can't upload files of this category");
                }
            }

            $image_urls = json_encode($image_urls);
     
            $uniName = json_encode($uniName);
            
            $validatedData = [
                'id' => $_POST['id'],
                'fpID' => Session::get('userID'),
                'topic' => $data['topic'],
                'description' => $data['description'],
                'rental' => $data['rental'],
                'location' => $data['location'],
                'address' => $data['address'],
                'uniName' => $uniName,
                'image_urls' => $image_urls,
                'special_note' => $data['special_note'],
                'category' => $data['category']
            ];

            //Make sure there are no error flags are set
            if(empty($data['topic_err']) && empty($data['description_err']) && empty($data['rental_err']) && empty($data['location_err']) && empty($data['address_err']) 
                && empty($data['uniName_err']) && empty($data['images_err']) && empty($data['special_note_err']) && empty($data['category_err']) ){

                if($this->ListingModel->editItem($validatedData)){
                    Middleware::redirect('./facility_provider/editItem');
                }
            }else{
                //load the same page with erros
                $this->loadView('facility_provider/editItem', $data);
            }
               
        }else{
            //Send the empty detail page
            $editlist = $this->ListingModel->viewOneListing($id);
            
            $uniList = $editlist->uniName;  //assigns the value of $editlist->uniName to the variable $uniList
            $uniList = str_replace(array("[", "]"), "", $uniList);  //remove the square brackets from the string and converting it to a comma-separated list 
            $array = explode(",", $uniList);  //split the comma-separated list into an array

            $imageList = $editlist->image;
            $imageList = str_replace(array("[", "]"), "", $imageList);
            $array_2 = explode(",", $imageList);

            $data = [
                'id' => $id,
                'viewone' => $editlist,
                'unilist' => $array,
                'imagelist' => $array_2,
                'topic' => '',
                'description' => '',
                'rental' => '',
                'location' => '',
                'address' => '',
                'special_note' => '',
                'category' => '',
                'topic_err' => '',
                'description_err' => '',
                'rental_err' => '',
                'location_err' => '',
                'address_err' => '',
                'uniName_err' => '',
                'images_err' => '',
                'special_note_err' => '',
                'category_err' => ''
            ];

            /* $data = [
                'viewone' => $editlist
            ]; */

            $this->loadView('facility_provider/editItem', $data);
            //$this->loadView('test', $data);

        }
    }

    public function deleteItem($id){
        
        //get existing post from model
        $item = $this->ListingModel->deleteItem($id);

        //check for owner
        if($item->listing_id != $_SESSION['userID']){

            Middleware::redirect('./facility_provider/viewOne');
        }

        if($this->ListingModel->deleteItem($id)){
            FlashMessage::flash('post_add_flash', "Item Successfully Deleted!", "success");
            Middleware::redirect('./facility_provider/viewOne');
        }
        else{
            die('Something went wrong');
        }
    }
}

?>