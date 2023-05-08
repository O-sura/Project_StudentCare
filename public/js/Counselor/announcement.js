export class CounselorAnnouncementPost {
  constructor(id, body, postedDate, name, img, user, userID, topic) {
    this.postID = id;
    this.postBody = body;
    this.postedDate = postedDate;
    this.name = name;
    this.prof = img;
    this.loggedUser = user;
    this.userID = userID;
    this.topic = topic;
  }

  createAnnouncement() {
    let controllers = "";
    if (this.loggedUser == this.userID) {
      controllers = `
            <div class="own">
                <div class="descriptionOwn">
                    <h4 class="postH">${this.topic}</h4>
                    ${this.postBody}<br><br>
                    <span class="pdate">${
                      this.postedDate
                    } </span> <span class="puser">     Posted By :  ${
        this.name
      }</span>

                    <div class="buttonU"> 
                        <button class="btnEdit" name="btnEdit" type="submit"><a href="http://localhost/StudentCare/app/CounselorAnnouncement/edit/${
                          this.postID
                        }"><i class="fa-solid fa-pen-to-square"></i></a></button>
                            
                        <button class="btnDlt" name="btnDlt" type="submit" value="${
                          this.postID
                        }"><i class="fa-solid fa-trash"></i></button>
                    </div>
                    
                </div>
                <div class="dpOwn">

                    ${
                      this.prof == ""
                        ? `<img class="dpImgOwn" src="http://localhost/StudentCare/public/img/counselor/avatar.jpg" alt=""><br>`
                        : `<img class="dpImgOwn" src="http://localhost/StudentCare/public/img/counselor/${this.prof}" alt=""><br>`
                    }
                    
                </div>
            </div>
            `;
    } else {
      controllers = `
            <div class="other">
                <div class="dp">
                    ${
                      this.prof == ""
                        ? `<img class="dpImgOwn" src="http://localhost/StudentCare/public/img/counselor/avatar.jpg" alt=""><br>`
                        : `<img class="dpImgOwn" src="http://localhost/StudentCare/public/img/counselor/${this.prof}" alt=""><br>`
                    }
                </div>

                <div class="description">
                    <h4 class="postH">${this.topic}</h4>
                    ${this.postBody}<br><br>
                    <span class="pdate">${
                      this.postedDate
                    } </span> <span class="puser">     Posted By :  ${
        this.name
      }</span>
                                                    
                </div>
            </div>
            `;
    }

    return `
        <div class="annDescription">
            ${controllers}
        </div>
        `;
  }
}
