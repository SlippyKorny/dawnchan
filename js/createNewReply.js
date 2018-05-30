function createNewReply() {
    document.getElementsByTagName('h2')[0].innerHTML = "";
    document.getElementById('newThread-form').innerHTML = "<div id='newThread-name'>Name</div><input name='name'><button>Post</button><br><div id='newThread-comment'>Comment</div><textarea name='comment'></textarea><br><div id='newThread-verification'>Verification</div><br><div id='newThread-file'>File</div><input type='file' id='fileLocation' name='file'><br>";
}
