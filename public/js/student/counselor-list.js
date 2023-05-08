export class CounselorList{
    constructor(id,name,description,img,specialization){
        this.id = id;
        this.name = name;
        this.description = description;
        this.prof = img;
        this.specialization = specialization;
    }

    
    createDetails(){
        let controllers = '';
       
        let image_url = this.prof;
        if(image_url == null){
            image_url = "avatar.jpg";
        }
            controllers = `
            <div class="list-item">
                <div class="prof-image">
                    <img src="http://localhost/StudentCare/public/img/counselor/${image_url}" id="image3">
                </div>
                <div class="details">
                    <div class="name">
                        Dr. ${this.name}
                    </div>
                    <div class="specialization">
                        ${this.specialization}
                    </div>
                    <div class="info">
                        ${this.description}
                    </div>
                    <div class="buttons">
                        <button class="btn2" onclick="window.location.href='http://localhost/StudentCare/Appointments/profile/${this.id}'">View Profile</button>
                    </div>
                </div>
            </div>
            `
     

        return `
        
            ${controllers}
        
        `
    }

}
