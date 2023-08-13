<button class='reply-button' onclick='showReplyForm()'>Reply</button>
  <div id='reply-form-' class='icons' style='display: none;'>
  <form method='POST' action='rplycomment.php'>
  <label for='comment_text'>Add a reply:</label>
  <textarea id='comment_text' name='comment_text'></textarea>
  <input type='hidden' name='video_id' value="6">
  <input type='hidden' name='parent_id' value="9">
 <button type='submit'>Submit</button>";
  </form>;
  </div>