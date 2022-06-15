<?php $this->load->view('home/slider_functions');?>
<script>
    // Function to reveal lightbox and adding YouTube autoplay
    function revealVideo(div,video_id) {
      var video = document.getElementById(video_id).src;
      document.getElementById(video_id).src = video+'&autoplay=1'; // adding autoplay to the URL
      document.getElementById(div).style.display = 'block';
    }

    // Hiding the lightbox and removing YouTube autoplay
    function hideVideo(div,video_id) {
      var video = document.getElementById(video_id).src;
      var cleaned = video.replace('&autoplay=1',''); // removing autoplay form url
      document.getElementById(video_id).src = cleaned;
      document.getElementById(div).style.display = 'none';
    }
    $(window).on('beforeunload', function(){
        $(window).scrollTop(0);
    });
    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $(".mainHeaderClass").height() && $("#allowScroll").val() == 'yes'){
        $("#allowScroll").val('no');
        var id = $("#load_id").val();
        if(!$("#"+id).attr("loaded")){
          var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
            var section_data = JSON.stringify($("#"+id).data('loader'));
            $.ajax({
                url:"<?= base_url('home/getBannerContent'); ?>",
                type:"POST",
                dataType:"html",
                data:{id:id,section_data:section_data,csrf_test_name:csrf_value},
                success: function(html){
                    $("#"+id).html(html);
                    loadSlider(id);
                    $("#"+id).attr("loaded",true);
                    var id_num = parseInt(id.split("-")[1])+1;
                    $("#load_id").val("box-"+id_num);
                    if($("#load_id").val() == 'box-7'){ $("#allowScroll").val('no'); } else { $("#allowScroll").val('yes'); }
                }
            });   
        }
      }
    });
</script>
<input type="hidden" id="load_id" value="box-2">
<input type="hidden" id="track_val" value="16">
<input type="hidden" id="allowScroll" value="yes">
<?php 
$this->load->view('home/banners');
$this->load->view('home/insta');
$this->load->view('home/team');
$this->load->view('home/articles');