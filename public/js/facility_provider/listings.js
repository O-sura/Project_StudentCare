export class propertyitem{
    constructor(id,images,topic,uni,distance,rental,location){
        this.id = id;
        this.images = images;
        this.topic = topic;
        this.uni = uni;
        this.rental = rental;
        this.location = location;
        this.distance = distance;
    }

    
    createItem(){
        let controllers = '';

            controllers = `
           
            <div class="image">
                <a href="http://localhost/StudentCare/facility_provider/viewOneListing/${this.id}"><img src="http://localhost/StudentCare/public/img/listing/${this.images}"></a>

            </div>

            <div class="data">
                <p class="topic">${this.topic}</p>
                <p class="uni">${this.distance} km from ${this.uni}</p>
                
                <p class="price"><span>Rs. </span>${this.rental}/Month</p>
                
                <p class="location">${this.location}</p>
            </div>
       
            `

        return `
        <div class="item">
            ${controllers}
        </div>
        `
    }

}