document.getElementById('browse-button').onclick = function () {
    document.getElementById('fileLocation').click();
};

function createNewThread(boardId) {
    document.getElementsByTagName('h2')[0].innerHTML = "";
    var threadForm = "<div id='newThread-name'>Name</div><input name='name'><br><div id='newThread-subject'>Subject</div><input name='subject'><button type='submit'>Post</button><br><div id='newThread-comment'>Comment</div><textarea name='comment'></textarea><br><div id='newThread-verification'>Verification</div><br><div id='newThread-file'>File</div><input type='file' id='fileLocation' name='file'><br><input style='display: none' name='board_id' value='" + boardId + "'>";
    document.getElementById('newThread-form').innerHTML += threadForm;
}
