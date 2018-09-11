
$(document).ready(function(){
  $(".follow-eye").click(function(){
    if ($(this).attr("src").localeCompare("../assets/img/follow_0.png") == 0)
    {
      $(this).attr("src", "../assets/img/follow_1.png");
      // $(this).load("../private/follow_thread.php", {thread_id: $(this).attr("thread_id")});  // TODO: The script
      $(document).$("#dummy").load("../private/follow_thread.php", "thread_id=" + $(this).attr("thread_id"));
    }
    else
    {
      $(this).attr("src", "../assets/img/follow_0.png");
      // TODO: Function
    }
  });
});
