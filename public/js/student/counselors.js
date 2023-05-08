export class CounselorDetails{
    constructor(id,name,description,img,specialization,address,dob,qualifications){
        this.id = id;
        this.name = name;
        this.description = description;
        this.prof = img;
        this.specialization = specialization;
        this.address = address;
        this.dob = dob;
        this.qualifications = qualifications;
    }

    
    createDetails(){
        let controllers = '';
       
            controllers = `
            <div class="counselor-pic">
            <img src="http://localhost/StudentCare/public/img/counselor/${this.prof}" id="image3">
        </div>
        <div class="counselor-name">
            <h3>Dr.${this.name}</h3>
        </div>
        <div class="address">
            <p>${this.address}</p>
        </div>
        <div class="horizontal">
            <hr>
        </div>
        <div class="topic">
            <h3>Counselor Details</h3>
        </div>
        <div class="details">
            <div class="index">
                <div class="dob">
                    Age
                </div>
                <div class="specialization">
                    Specialization
                </div>
                <div class="qualification">
                    Qualification
                </div>
                <div class="description">
                    Description
                </div>
            </div>
            <div class="content">
                <div class="dob-details">
                    ${this.dob}
                </div>
                <div class="specialization-details">
                    ${this.specialization}
                </div>
                <div class="qualification-details">
                    ${this.qualifications}
                </div>
                <div class="description-details">
                    ${this.description}
                </div>
            </div>
        </div>
            `
     

        return `
        
            ${controllers}
        
        `
    }

}
