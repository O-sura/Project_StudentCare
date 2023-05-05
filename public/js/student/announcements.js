export class Announcement {
  constructor(id, head, name, date, img) {
    this.id = id;
    this.head = head;
    this.name = name;
    this.date = date;
    this.prof = img;
  }

  createDetails() {
    let controllers = "";

    let image_url = this.prof;
    let date_format = new Date(this.date);
    let year = date_format.getFullYear();
    let month = String(date_format.getMonth() + 1).padStart(2, "0");
    let day = String(date_format.getDate()).padStart(2, "0");
    let formattedDate = `${year}-${month}-${day}`;
    if (image_url == null) {
      image_url = "avatar.jpg";
    }
    controllers = `
            <div class="row3">


                <div class="topic" data-id="${this.id}">
                    <span class="star"><i class="fa-regular fa-star" id='${this.id}'></i></span>

                    <a href="http://localhost/StudentCare/Announcements/show/${this.id}">${this.head}</a>

                </div>


                <div class="details">
                    <div class="image">
                        <img src="http://localhost/StudentCare/public/img/counselor/${image_url}" alt="">
                    </div>
                    <div class="name">
                        ${this.name}
                    </div>
                </div>

                <div class="postedOn">
                    ${formattedDate}
                </div>
            </div>
            <hr>
            `;

    return `
        
            ${controllers}
        
        `;
  }
}

