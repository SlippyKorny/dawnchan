function getBoardId() {
    return document.getElementsByTagName('board_id')[0].innerHTML;
}

function getThreadId() {
    var threadOpId = document.getElementsByClassName("thread-post-id");  // Only one exists in thread.php
    var threadIdString = String(threadOpId[0].innerHTML);
    return threadIdString.slice(3, threadIdString.length);
}

function createNewReply() {
    document.getElementsByTagName('h2')[0].innerHTML = "";
    document.getElementById('newThread-form').innerHTML = "<div id='newThread-name'>Name</div><input name='thread_id' style='display: none' value='" + getThreadId() + "'><input name='board_id' style='display: none' value='" + getBoardId() + "'><input name='poster_name'><button type='submit'>Post</button><br><div id='newThread-comment'>Comment</div><textarea name='post_content'></textarea><br><div id='newThread-verification'>Verification</div><br><div id='newThread-file'>File</div><input type='file' id='fileLocation' name='image_original_name'><br>";
}
