<?php
Session::init();
class Facility_Provider extends Controller{
    private $userModel;
    private $ListingModel;
    
    public function __construct(){
        Middleware::authorizeUser(Session::get('userrole'), 'facility_provider');
        $this->ListingModel = $this->loadModel('Facility_Providers');
        $this->userModel = $this->loadModel('User');
    }


    //to view mylisting page
    public function index(){
        $myview = $this->ListingModel->myListing();                     //call the relevent model

        //create a data array
        $data =[
            'myview' => $myview,                                        //assigns the value of $myview to the key 'myview'
            'universities' => $this->ListingModel->getDistances(),      //This assigns the result of a method call $this->ListingModel->getDistances() to the key 'universities'
        ]; 
        
        $this->loadView('facility_provider/myListing',$data);           //load the view file with the necessaty data
    }


    //to view profile details
    public function profile(){
        $user_id = Session::get('userID');

        $profile = $this->ListingModel->profile($user_id);
        
        $data =[
            'profile' => $profile
        ]; 
        
        $this->loadView('facility_provider/profile',$data);
    }


    //to edit profile details
    public function editprofile(){
        $user_id = Session::get('userID');
        $user_name = Session::get('username');
        $row = $this->ListingModel->editprofile($user_id);

          
        $data = [
            'profile_img' => $row->profile_img,
            'name' => $row->fullname,
            'username' => $row->username,
            'email' => $row->email,
            'nic' => $row->nic,
            'contact' => $row->contact_no,
            'address' => $row->home_address,
            'category' => $row->category,
            'name_err' => '',
            'nic_err' => '',
            'username_err' => '',
            'email_err' => '',
            'contact_err' => '',
            'address_err' => '',
            'category_err' => ''
        ];
        
        $this->loadView('facility_provider/editprofile',$data);
    }

    public function updateProfileDetails($userid){
        $user_id = Session::get('userID');
        $row = $this->ListingModel->editprofile($user_id);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //to upload the profile image
            $filename = $_FILES["file"]["name"];
            $tempname = $_FILES["file"]["tmp_name"];
            $folder =  PUBLICPATH . "/img/fprovider/".$filename;

            if (move_uploaded_file($tempname, $folder)) {
                echo 'File successfully uploaded';
            }
            else if(empty($filename) && empty($tempname)){
                $filename = $row->profile_img;
                $folder = PUBLICPATH . "/img/fprovider/".$filename;
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
            $name = $_POST['name'];
            $username = $_POST['username'];
            $nic = $_POST['nic'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $contact = $_POST['contact'];
            $category = $_POST['category'];
            

            $data = [
                'profile_img' => $filename,
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'nic' => $nic,
                'contact' => $contact,
                'address' => $address,
                'profile' => $filename,
                'category' => $category,
                'name_err' => '',
                'username_err' => '',
                'nic_err' => '',
                'email_err' => '',
                'contact_err' => '',
                'address_err' => '',
                'category_err' => ''
            ];

            //Check whether all the fields are filled properly
            if(empty($data['username'])){
                $data['username_err'] = "*Username field is Required";
            }

            if(empty($data['name'])){
                $data['name_err'] =  "*Name field is Required";
            }

            if(empty($data['email'])){
                $data['email_err'] = "*Email field is Required";
            }

            if(empty($data['nic'])){
                $data['nic_err'] = "*NIC field is Required";
            }

            if(empty($data['address'])){
                $data['address_err'] = "*Address field is Required";
            }

            if( empty($data['contact'])){
                $data['contact_err'] = "*Contact field is Required";
            }

            if( empty($data['category'])){
                $data['category_err'] = "*At least one category is Required";
            }

            //Check whether an account already exists with the provided username
            $user = $this->ListingModel->getUserByUsername($username);
            if($user){
                if(Session::get('username') == $user->username){
                    $data['username_err'] = "";
                }
                else{
                    $data['username_err'] = "*This Username is already taken";
                }
            }

            //Email is valid or not
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = "*Invalid email format";
            }

            //Check the mobile number
            if(strlen($contact) != 10){
                $data['contact_err'] = "*Invalid Contact Number";
            }

            //check the nic number
            if(strlen($nic) == 10){
                if ($nic[9] !== 'v' && $nic[9] !== 'V') {  // Check if the 10th character of $nic is 'v' or 'V'
                    $data['nic_err'] = "*Invalid NIC Number";
                }
            }else if(strlen($nic) != 12) {   // Check if the length of $nic is not equal to 12
                $data['nic_err'] = "*Invalid NIC Number";
            }

            //Make sure there are no error flags are set
            if(empty($data['username_err']) && empty($data['name_err']) && empty($data['nic_err']) && empty($data['email_err']) && empty($data['contact_err']) && empty($data['address_err']) && empty($data['category_err'])){
                    
                $res = $this->ListingModel->updateProfileDetails($data,$user_id);

                if($res){
                    FlashMessage::flash('update_profile_flash', "Successfully Updated Your Profile Details!", "success");
                    Middleware::redirect('facility_provider/profile');
                }else{
                    //Error Notification
                    echo 'Error: Something went wrong in adding post to the databse';
                    Middleware::redirect('facility_provider/editprofile');
                    die();
                }
            }
            else{
                $this->loadView('facility_provider/editprofile',$data);
            }
        }
        else{
            //get the relavent details from the model
            //$detail = $this->ListingModel->getCounselorEditDetails($user_id);
            $row = $this->ListingModel->editprofile($user_id);

            $data = [
                'profile_img' => $row->profile_img,
                'name' => $row->name,
                'username' => $row->username,
                'email' => $row->email,
                'nic' => $row->nic,
                'contact' => $row->contact,
                'address' => $row->address,
                'category' => $row->category,
                'name_err' => '',
                'nic_err' => '',
                'username_err' => '',
                'email_err' => '',
                'contact_err' => '',
                'address_err' => '',
                'category_err' => ''
            ];

                
            print_r($data);  
            //$this->loadView('facility_provider/editprofile',$data);
        }
    }

    
    //to add the item details
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
                'special_note_err' => '',
                'category_err' => ''
            ];

            //Check whether all the fields are filled properly
            if(empty($data['topic'])){
                $data['topic_err'] =  "*Topic field is Required";
            }

            if(empty($data['description'])){
                $data['description_err'] =  "*Description field is Required";
            }

            if(empty($data['rental'])){
                $data['rental_err'] =  "*Price field is Required";
            }

            if(empty($data['location'])){
                $data['location_err'] =  "*Nearest Town field is Required";
            }

            if(empty($data['address'])){
                $data['address_err'] =  "*Address field is Required";
            }

            /* if(empty($data['uniName[]'])){
                $data['uniName[]_err'] =  "*At least one university should be entered";
            }

            if(empty($data['uniDistance[]'])){
                $data['uniDistance[]_err'] =  "*You should entered distance";
            } */

            if(empty($data['special_note'])){
                $data['special_note_err'] =  "*Special note field is Required";
            }

            if(empty($data['category'])){
                $data['category_err'] =  "*Category field is Required";
            }

            if(!is_numeric($data['rental'])){
                $data['rental_err'] =  "*This field should be numeric";
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


            if(!$images['name'][0] == '') {
                //array_pop($uploaded_images);  //remove the last unnesessary array element
                
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
                 && empty($data['special_note_err']) && empty($data['category_err'])){

                $num = count($uniList);

                if($this->ListingModel->addItem($validatedData)){//add basic listing details to the database
                    $is_successful = false;

                    for($i=0; $i<$num; $i++){  //add university details to the database
                        $name = $uniList[$i];
                        $distance = $uniDistanceList[$i];
                        $uniData['uniID'] = $listing_id;
                        $uniData['uniName'] = $name;
                        $uniData['uniDistance'] = $distance;
                        if($this->ListingModel->addUniDistance($uniData)){
                            $is_successful = true;
                        }else{
                            $is_successful = false;
                        }
                    }
                }
                if($is_successful){
                    FlashMessage::flash('added_flash', "Successfully added Details!", "success");
                    //redirect to the listing page
                    Middleware::redirect('./facility_provider/addItem');
                }else{
                     //Error Notification
                    echo 'Error: Something went wrong in adding item to the database';
                    Middleware::redirect('./facility_provider/addItem');
                    die();
                }

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
                /* 'uniName[]_err' => '',
                'uniDistance[]_err' => '', */
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
        $viewone = $this->ListingModel->viewOneListing($id);                //load the relevent model

        //create a data array
        $data =[  
            'viewone' => $viewone,                                          //assigns the value of $viewone to the key 'viewone'
            'universities' => $this->ListingModel->getDistance($id),        //take the data from relevent models and stored in the keys
            'facilityProviderDetails'=>$this->ListingModel->getFacilityProviderDetails($id),
            'comments' => $this->ListingModel->getComments($id)
        ]; 
        
        $this->loadView('facility_provider/viewOne',$data);                 //load the view file with the necessaty data
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


    //to edit listing data
    public function editItem($id){

        if (isset($_POST['submit'])) {

            //Start the session
            //Session::init();

            //Check and validate the data
            //Set errors if something is wrong
            $topic = $_POST['topic'];           //stored taken topic value in $topic variable
            $description = $_POST['description'];
            $rental = $_POST['rental'];
            $location = $_POST['location'];
            $address = $_POST['address'];
            $uniName = $_POST['uniName'];
            $uniDistance = $_POST['uniDistance'];
            $images = $_FILES['images'];
            $special_note = $_POST['special_note'];
            $category = $_POST['category'];

            
            $uniList = [];      //define a empty array 
            $uniDistanceList = [];
            
            foreach ($uniName as $uni){
                array_push($uniList, trim($uni));
            }

            foreach ($uniDistance as $distance){
                array_push($uniDistanceList, trim($distance));
            }

            $data = [
                'id' => $id,
                'topic' => trim($topic),
                'description' => trim($description),
                'rental' => trim($rental),
                'location' => trim($location),
                'address' => trim($address),
                // 'uniName' => json_encode($uniList),
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
           
            /* if($images['name'][0] == '') {
                echo 'bcdfbudjsbv';
            }else{
                echo '1234556';
            } */
            

            if(empty($data['topic'])){
                $data['topic_err'] =  "*Topic field is Required";
            }

            if(empty($data['description'])){
                $data['description_err'] =  "*Description field is Required";
            }

            if(empty($data['rental'])){
                $data['rental_err'] =  "*Price field is Required";
            }

            if(empty($data['location'])){
                $data['location_err'] =  "*Nearest Town field is Required";
            }

            if(empty($data['address'])){
                $data['address_err'] =  "*Address field is Required";
            }

            if(empty($data['uniName'])){
                $data['uniName_err'] =  "*University field is Required";
            }

            if(empty($data['special_note'])){
                $data['special_note_err'] =  "*Special note field is Required";
            }

            if(empty($data['category'])){
                $data['category_err'] =  "*Category field is Required";
            }

            if(!is_numeric($data['rental'])){
                $data['rental_err'] =  "*This field should be numeric";
            }

            $unique_array = array_unique($uniList); //remove duplicate values from the array $uniList and store the unique values in the array $unique_array.

            if(count($uniList) != count($unique_array)){
                $data['uniName_err'] = 'Duplicate university names are not allowed';
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

            

            $image_urls = [];       //create an array as image_urls

            if(!$images['name'][0] == '') {
                array_pop($uploaded_images);  //remove the last unnesessary array element
                
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
                        $new_image_name = uniqid('IMG-', true).'.'.$image_ex_lc;   //uniqid('IMG-', true)  generates a unique identifier with a prefix of 'IMG-' and 
                                                                                   //with extra entropy, resulting in a longer and more unique ID
    
                        //creating upload path on root directory
                        $image_upload_path = PUBLICPATH . "/img/listing/". $new_image_name;
    
                        //move uploaded image to 'images' folder
                        move_uploaded_file($uploaded_image["tmp_name"], $image_upload_path);
    
                        $images = json_encode($images);     //convert images php array into a json encoded string images
                        $image_urls[] = $new_image_name;
                        // header("Location: propertyView.php");
                    }else{
                        echo("You can't upload files of this category");
                    }
                }
            }
           

            $image_urls = json_encode($image_urls);     //convert image_urls php array into a json encoded string image_urls

            $uniName = json_encode($uniName);           //convert uniName php array into a json encoded string uniName
            $listing_id = $id;

            $data = [
                'id' => $listing_id,
                'topic' => $data['topic'],
                'description' => $data['description'],
                'rental' => $data['rental'],
                'location' => $data['location'],
                'address' => $data['address'],
                'image_urls' => $image_urls,
                'special_note' => $data['special_note'],
                'category' => $data['category']
            ];

            //Make sure there are no error flags are set
            if(empty($data['topic_err']) && empty($data['description_err']) && empty($data['rental_err']) && empty($data['location_err']) && empty($data['address_err']) 
                && empty($data['uniName_err']) && empty($data['images_err']) && empty($data['special_note_err']) && empty($data['category_err']) && empty($data['uniDistance_err'])){
                
                $num = count($uniList);

                if($this->ListingModel->editItem($data)){ //edit basic listing details to the database
                    $is_successful = false;
                    if($this->ListingModel->deleteUniDistances($listing_id)){ //delete previous entries before entering new ones
                        $is_successful = true;
                        for($i=0; $i<$num; $i++){  //add university details to the database
                            $name = $uniList[$i];
                            $distance = $uniDistanceList[$i];
                            $uniData['uniID'] = $listing_id;
                            $uniData['uniName'] = $name;
                            $uniData['uniDistance'] = $distance;
                            if($this->ListingModel->addUniDistance($uniData)){
                                $is_successful = true;
                            }else{
                                $is_successful = false;
                            }
                        }

                    }
                    
                    if($is_successful){
                        FlashMessage::flash('added_flash', "Successfully added Details!", "success");
                        //redirect to the listing page
                        Middleware::redirect('./facility_provider/viewOne');
                    }else{
                         //Error Notification
                        echo 'Error: Something went wrong in adding item to the databse';
                        Middleware::redirect('./facility_provider/editItem');
                        die();
                    }
                }
            }else{
                //load the same page with erros
                $this->loadView('facility_provider/editItem', $data);
            }
               
        }else{
            //get the relavent details from the model
            $editlist = $this->ListingModel->viewOneListing($id);
            
            $uniList = $this->ListingModel->getUniDistances($id);

            $imageList = $editlist->image;
            $imageList = str_replace(array("[", "]"), "", $imageList);
            $array_2 = explode(",", $imageList);
            $universities = array(
                "Eastern University",
                "Rajarata University",
                "Sabaragamuwa University",
                "South Eastern University",
                "The Open University",
                "University of Colombo",
                "University of Jaffna",
                "University of Kelaniya",
                "University of Moratuwa",
                "University of Peradeniya",
                "University of Ruhuna",
                "University of Sri Jayewardenepura",
                "Uva wellassa University",
                "University of Vavuniya",
                "University of the Visual & Performing Arts",
                "Wayamba University",
                "KDU",
                "CINEC",
                "Esoft Metro Campus",
                "Horizon Campus",
                "IIT",
                "NIBM",
                "NSBM",
                "SLIIT",
                "SLTC"
            );
            $data = [
                'id' => $id,
                'viewone' => $editlist,
                'unilist' => $uniList,
                'universities' => $universities,
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

            //print_r($data);
            $this->loadView('facility_provider/editItem', $data);
            //$this->loadView('test', $data);

        }
    }


    //to delete a item
    public function deleteItem($id){
    
        //get existing post from model
        /* $item = $this->ListingModel->getItemById($id); */

        //check for owner
        /* if($item->listing_id != $_SESSION['userID']){
            Middleware::redirect('./facility_provider/myListing');
        } */

        if($this->ListingModel->deleteItem($id) && $this->ListingModel->deleteUniDistances($id)){
            FlashMessage::flash('item_add_flash', "Item Successfully Deleted!", "success");
            Middleware::redirect('./facility_provider/myListing');
        }
        else{
            die('Something went wrong');
        }
    }


    public function propertysearch(){
        header("Access-Control-Allow-Origin: *");
        if(isset($_GET['query'])){
            //Check whether the search query is empty or not
            if(empty($_GET['query'])){
                $result =  json_encode($this->ListingModel->getlisting());
            }else{
                $keyword = "%" . trim($_GET['query']) . "%";
                $result =  $this->ListingModel->propertysearch($keyword);
            }
            echo $result;
        }
    }


    public function dropdownfilter(){
        if(isset($_GET['filterItem1'])){
            // Get the selected filter values
            $location = $_GET['location'];
            /* $type = $_GET['type'];
            $university = $_GET['university']; */
    
            // Call the model method to get the filtered results
            $result = $this->ListingModel->getlocationfilter($location);
            /* $result = $this->ListingModel->gettypefilter($type);
            $result = $this->ListingModel->getunifilter($university); */
            
            // Return the filtered results as JSON
            echo json_encode($result);
        }
    }

    //to change the profile password
    public function changePassword(){
        $username = Session::get('username');

        $data = [
            'username' => $username,
            'currentPW' => '',
            'password' => '',
            'confirmPW' => '',
            'currentPW_err' => '',
            'password_err' => '',
            'confirmPW_err' => '',
        ];

        $this->loadView('facility_provider/changePW',$data);
    }

    public function changeCurrentPassword(){

        $username = Session::get('username');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Log the user in and start the session

            if (isset($_POST['change-password'])) {

                $data = [
                    'username' => $username,
                    'currentPW' => trim($_POST['current-password']),
                    'password' => trim($_POST['password']),
                    'confirmPW' => trim($_POST['password-confirm']),
                    'currentPW_err' => '',
                    'password_err' => '',
                    'confirmPW_err' => '',
                ];

                $password = $data['password'];

                if (!$this->userModel->validatePassword($data['username'], $data['currentPW'])) {
                    $data['currentPW_err'] = '*Current Password does not match';
                }

                //Password and repeated once are matched
                if ($_POST['password'] !== $_POST['password-confirm']) {
                    //echo("Password mismatch");
                    $data['confirmPW_err'] = "*Password mismatch";
                    // die();
                }

                //password has(Min. 8 len, one character, one letter, one special char)
                if (strlen($password) < 8) {
                    //echo("Password should have at least 8 characters");
                    $data['password_err'] = "*Password should have at least 8 characters";
                    //die();
                } else {
                    if (!preg_match('/[0-9]/', $password)) {
                        //echo("Password must contain at least one number");
                        $data['password_err'] = "*Password must contain at least one number";
                        //die();
                    } else if (!preg_match('/[a-z]/', $password)) {
                        //echo('Password must contain at least one lowercase letter');
                        $data['password_err'] = "*Password must contain at least one lowercase letter";
                        //die();
                    } else if (!preg_match('/[A-Z]/', $password)) {
                        //echo('Password must contain at least one uppercase letter');
                        $data['password_err'] = "*Password must contain at least one uppercase letter";
                        //die();
                    } else if (!preg_match("/[\[^\'£$%^&*()}{@:\'#~?><>,;@\|\-=\-_+\-¬\`\]]/", $password)) {
                        //echo('Password must contain at least one special character');
                        $data['password_err'] = "*Password must contain at least one special character";
                        //die();
                    }
                }

                // print_r($data);
                // exit;

                if (empty($data['currentPW'])) {
                    $data['currentPW_err'] = "Please enter current password";
                }

                if (empty($data['confirmPW'])) {
                    $data['confirmPW_err'] = "Please enter confirm password";
                }

                if (empty($data['password'])) {
                    $data['password_err'] = "Please enter new password";
                }

                if (empty($data['username_err']) && empty($data['currentPW_err']) && empty($data['password_err']) && empty($data['confirmPW_err'])) {

                    $this->userModel->updatePassword($username, $data['password']);
                    FlashMessage::flash('password_change_flash', "Successfully Updated Your Password!", "success");
                    Middleware::redirect('facility_provider/editprofile');
                } else {
                    $this->loadView('facility_provider/changePW',$data);
                }
            }

        }
    }

    //to delete own profile of counselor
    public function deleteOwnProfile(){

        $userid = Session::get('userID');

        $this->ListingModel->updateUserAsDeleted($userid);

        // $data == [];

        $this->loadView('index');
    }


}

?>