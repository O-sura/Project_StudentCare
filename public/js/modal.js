
export class ModalBox{
    constructor(){
    }

    createModal(type){
        if(type === 'delete'){
            return `
            <section>
        
                <span class="overlay"></span>

                <div class="modal-box-1">
                    <center><h3 class="modal-title-text">Are your sure you want to delete this?</h3></center>
                    <p class="modal-text">Remember, this will remove all the current data related to this which cannot be undone later</p>
                    <div class="modal-button-section">
                        <button class="modal-box-button" id="delete-button">Delete</button>
                        <button class="modal-box-button" id="cancel-button">Cancel</button>
                    </div>
                </div>
            </section>
            `
        }
        
    }
}