<div class="comment-form-container">
            <form id="frm-comment">
                <div class="input-row">
                    <input type="hidden" name="comment_id" id="commentId"
                           placeholder="Name" /> <input class="input-field" 
                           type="text" name="name" value="<?php echo $_SESSION['username'] ?>" id="name" placeholder="Name" readonly />
                </div>
                <div class="input-row">
                    <textarea class="input-field" type="text" name="comment"
                              id="comment" placeholder="Add a Comment">  </textarea>
                </div>
                <div>
                    <input type="button" class="btn-submit" id="submitButton"
                           value="Publish" /><div id="comment-message">Comments Added Successfully!</div>
                </div>

            </form>
        </div>
        <div id="output"></div>

        
       