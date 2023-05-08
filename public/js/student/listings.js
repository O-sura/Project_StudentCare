export class ListingDetails {
  constructor(id, images, topic, uni, distance, rating, rental, location) {
    this.id = id;
    this.images = images;
    this.topic = topic;
    this.uni = uni;
    this.rating = rating;
    this.rental = rental;
    this.location = location;
    this.distance = distance;
  }

  createDetails() {
    let controllers = "";

    controllers = `
           
            <div class="image">
                <a href="http://localhost/StudentCare/student_facility/viewOneListing/${this.id}"><img src="http://localhost/StudentCare/public/img/listing/${this.images}"></a>

            </div>

            <div class="data">
                <p class="topic">${this.topic}</p>
                <p class="uni">${this.distance} km from ${this.uni}</p>
                <p class="rating"><i class="fa-solid fa-star fa-xs"></i> ${this.rating}</p>
                <p class="price"><span>Rs. </span>${this.rental}/Month</p>
                
                <p class="location">${this.location}</p>
            </div>
       
            `;

    return `
        <div class="item">
            ${controllers}
        </div>
        `;
  }
}
