export class CounselorDetails{
    constructor(id,name,description,img,specialization,address,dob){
        this.id = id;
        this.name = name;
        this.description = description;
        this.prof = img;
        this.specialization = specialization;
        this.address = address;
        this.dob = dob;
    }

    
    createDetails(){
        let controllers = '';
       
            controllers = `
            <div class="counselor-pic">
            <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" id="image3">
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
                    MBBS, MD, FRCPsych
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
