  <!-- COMMENTS MODAL -->
  <div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="CommentsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="CommentsModalLabel">Comments</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="commentBody">

              </div>
              <div class="modal-footer">
                  <input type="hidden" id="commentsPostId">
                  <textarea id="writeAComment" maxlength="500" class="textarea write-a-comment-textarea" placeholder="Write as <?php echo $first_name . ' ' . $last_name ?>"></textarea>
                  <i class='bx bxs-up-arrow-alt' id="btn-submit-comment"></i>
              </div>
          </div>
      </div>
  </div>