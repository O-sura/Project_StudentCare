/* export class ListingDetails{
    constructor(id,images,topic,uni,distance,rating,rental,location){
        this.id = id;
        this.images = images;
        this.topic = topic;
        this.uni = uni;
        this.rating = rating;
        this.rental = rental;
        this.location = location;
        this.distance = distance;
    }

    
    createDetails(){
        let controllers = '';

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
       
            `
     

        return `
        <div class="item">
            ${controllers}
        </div>
        `
    }

}
 */


/* export class listing{
    constructor(topic,uniName,rental,image,listing_id){
        this.id = listing_id;
        this.topic = topic;
        this.uniName = uniName;
        this.rental = rental;
        this.image = image;
    }

    
    createDetails(){
        let listings = '';

            listings = `
           
            <div class="item">
                    <div class="image">
                        <?php
                            $images = json_decode ${this.image}; 
                        ?>
                        <a href=<?php echo "viewOneListing/" . ${this.listing_id}; ?>><img src="<?= URLROOT . "/public/img/listing/" . $images[0] ?>"></a>
                      
                    </div>

                    <div class="data">
                        <p class="topic"> ${this.topic} </p>
                        <p class="uni">Near to <?php 
                            $uniName = json_decode>${this.uniName};
                            foreach($uniName as $name) {
                                echo $name;
                                echo '<br>';
                            }
                        ?></p>
                        <p class="price"><span>Rs. </span> ${this.rental} /Month</p>
                    </div>
                </div>
       
            `
     

        return `
        <div class="item">
            ${listings}
        </div>
        `
    }

} */

/* export class listing{
    constructor(topic,uniName,rental,image,listing_id){
        this.id = listing_id;
        this.topic = topic;
        this.uniName = uniName;
        this.rental = rental;
        this.image = image;
    }

    createDetails(){
        let images = JSON.parse(this.image);
        let uniNames = JSON.parse(this.uniName);

        let uniNamesHtml = "";
        uniNames.forEach(name => {
            uniNamesHtml += `${name}<br>`;
        });

        return `
            <div class="item">
                <div class="image">
                    <a href="viewOneListing/${this.listing_id}">
                        <img src="<?= URLROOT ?>/public/img/listing/${images[0]}">
                    </a>
                </div>

                <div class="data">
                    <p class="topic"> ${this.topic} </p>
                    <p class="uni">Near to ${uniNamesHtml}</p>
                    <p class="price"><span>Rs. </span>${this.rental} /Month</p>
                </div>
            </div>
        `;
    }

} */

export class listing{
    constructor(topic,uniName,rental,image,listing_id){
        this.id = listing_id;
        this.topic = topic;
        this.uniName = uniName;
        this.rental = rental;
        this.image = image;
    }

    createDetails(){
        let listings = `
            <div class="item">
                <div class="image">
                    <a href="viewOneListing/${this.listing_id}">
                        <img src="<?= URLROOT ?>/public/img/listing/${JSON.parse(this.image)[0]}">
                    </a>
                </div>

                <div class="data">
                    <p class="topic"> ${this.topic} </p>
                    <p class="uni">Near to ${JSON.parse(this.uniName).map(name => `${name}<br>`).join('')}</p>
                    <p class="price"><span>Rs. </span>${this.rental} /Month</p>
                </div>
            </div>
        `;

        return `
            <div class = "item">
                ${listings}
            </div>
        `;
    }

}