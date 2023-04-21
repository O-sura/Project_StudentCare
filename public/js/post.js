
export class CommunityPost{
    constructor(id,title,author,postedTime,category,votes,thumbnail,body,user){
        this.postID = id;
        this.title = title;
        this.author = author;
        this.postedTime = postedTime.split(" ")[0];
        this.category = category;
        this.votes = votes;
        this.thumbnail = thumbnail;
        this.postBody = body;
        this.loggedUser = user;
    }

    createPost(){
        let controllers = '';
        // if(this.author === this.loggedUser){
        //     controllers =  `
        //         <div class="buttons">
        //             <i class="fa-solid fa-pen-to-square" id="update-btn"></i>
        //             <i class="fa-solid fa-trash" id="delete-btn"></i>
        //         </div>
        //     `
        // }

        // <div class="icon-text-button">
        //                 <button class="icon-btn" id="up"><i class="fa-solid fa-up-long"></i></button>
        //                 <p id="<?= "vote-count-" . $post->post_id ?>"><?= $post->votes ?></p>
        //                 <p id="post-id" hidden><?= $post->post_id ?></p>
        //                 <button class="icon-btn" id="down"><i class="fa-solid fa-down-long"></i></button>
        // </div>

        return `
        <div class="parent">
        <div class="icon-text-button">
            <button class="icon-btn" id="up"><i class="fa-solid fa-up-long"></i></button>
            <p id="vote-count-${this.postID}">${this.votes}</p>
            <p id="post-id" hidden>${this.postID}</p>
            <button class="icon-btn" id="down"><i class="fa-solid fa-down-long"></i></button>
        </div>
        <div class="div1">
            <img src="http://localhost/StudentCare/public/img/community/${this.thumbnail}"  alt="thumbnail" class="thumbnail">
        </div>
        <div class="div2">
            <div class="top">
                <h1>${this.title}</h1>
                ${controllers}
            </div>
            <div class="meta-data">
                <h4>By: ${this.author}</h4>
                <h4>${this.postedTime}</h4>
                <h4>Category: ${this.category}</h4>
            </div>
            <div class="content">
                ${this.postBody}
            </div>
            <div class="options">
                <a href="./view_post/${this.postID}"><input type="button" value="Read More" class="button"></a>
                <div class="bottom">
                    <div class="option" id="save-button">
                        <i class="fa-regular fa-bookmark"></i>
                        <span>Save</span>
                    </div>
                    <div class="option" id="report-button">
                        <i class="fa-solid fa-flag"></i>
                        <span>Report</span>
                    </div>
                </div>
            </div>
        </div>
</div>
        `
    }
}