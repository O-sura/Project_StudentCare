export class Comments{
    constructor(username,date,rating,image,description){
        this.username = username;
        this.date = date;
        this.rating = rating;
        this.image = image;
        this.description = description;
    }

    
    createDetails(){
        let controllers = '';
        let stars = '';
        for (let i = 1; i < 6; i++) {
            if (i <= this.rating) {
                stars += '<i class="fa-solid fa-star fa-xs"></i>';
            } else {
                stars += '<i class="fa-regular fa-star fa-xs"></i>';
            }
        }

        let image_url = this.image;
        if(image_url == null){
            image_url = "avatar.jpg";
        }

            controllers = `
           
            <div class="feedback_details">
            <img src="http://localhost/StudentCare/public/img/student/${image_url}" id="image3">
                <h6>${this.username}</h6>
            </div>
            <div class="feedback_rating">

                <p>
                    ${stars}
                    <span class="posted-date">Posted on: ${this.date} </span>
                </p>
            </div>
            <div class="feedback_comment">
                <p>${this.description}</p>
            </div>

            <div class="helpful">
                <p>423 people found this review helpful</p>
                <div class="radio-group">
                    <p> did you find this review helpful?
                        <input type="radio" name="helpful" value="yes" id="yes"><label for="yes">Yes</label>
                        <input type="radio" name="helpful" value="no" id="no"><label for="no">No</label>
                    </p>
                </div>
            </div>
       
            `
     

        return `
        <div class="other_comment">
            ${controllers}
        </div>
        `
    }

}
