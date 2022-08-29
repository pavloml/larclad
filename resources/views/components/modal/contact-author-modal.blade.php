<div class="modal fade" id="contactAuthor" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="sendMessageForm">
                    <div class="form-group required">
                        <label for="message" class="control-label">Your message </label>
                        <textarea class="form-control " id="message" name="message" rows="4" required=""></textarea>
                    </div>
                    @if(config('app.features.message_attachments'))
                        <div class="form-group">
                            <!-- <label for="messageAttachment">Attachment:</label> -->
                            <input type="file" title="Add attachment" class="form-control" id="messageAttachment" name="attachment">
                        </div>
                        <div class="form-group">
                            <small class="text-muted">2 MB Maximum. Only jpg, png are allowed.</small>
                        </div>
                    @endif
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
