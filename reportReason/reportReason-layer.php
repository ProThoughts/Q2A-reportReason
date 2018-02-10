<?php
class qa_html_theme_layer extends qa_html_theme_base
{

    private function getReason()
	{        
        $reason[0]="Błędna kategoria";
        $reason[1]="Niepasujące tagi";
        $reason[2]="Kod wstawiony bez bloczka";
        $reason[3]="Prośba o gotowca";
        $reason[4]="Stanowczo za mało informacji";
        $reason[5]="Obrażanie innych";
        $reason[6]="Spam/reklama";
        $reason[7]="Nic nie wnoszący odkop";
        $reason[8]="Autor już wcześniej zadał takie samo pytanie";
        $reason[9]="Podobne pytanie już było";
        $reason[10]="Nadużywanie caps locka/shifta";
        return $reason;
    }


    private function checkReport()
	{
        if (qa_opt('reportReason_enable')==true)
		{
            return true;
        } else
		{
            return false;
        }
    }
    public function head_css()
    {
        if ($this->checkReport())
		{
            if($this->template === 'question')
			{
                $this->content['css_src'][] = QA_HTML_THEME_LAYER_URLTOROOT.'/popup.css';
            }
        }
        qa_html_theme_base::head_css();
    }
    function head_script()
    {
        if ($this->template == 'question' && $this->checkReport()) 
		{
            $this->content['script'][] = '
            <script>

            function getReasonType(){
                if($("#nazwa").val()!=""){
                    return $("#nazwa").val();
                }else{

                    return $("#selekt").val();

                }
            }

                function addReport(userId, questionId, reason){

				alert(userId);
				alert(questionId);
				alert(reason);
		 $.ajax({
          type     : "POST",
          data     : {
              function: "addReport",
			  userId: userId,
			  questionId: questionId,
			  reason: reason
             },
          success: function(ret) {
			  location.reload();
              alert("OK");
			  alert(ret);
          },
          complete: function() {
          },
          error: function(jqXHR, errorText, errorThrown) {alert(jqXHR);alert(errorText);alert(errorThrown);}
      });

                }

            </script>';
        }

        qa_html_theme_base::head_script();
    }
    function q_view_buttons( $q_view )
        {
            if ($this->checkReport())
			{
                $page_url = qa_path_absolute( qa_request() );
                $page_title = $q_view['raw']['title'];


                
                $this->output( '<div class="socials-wrapper">' );
                        $this->output('<input type="submit" id="btn" class="qa-form-light-button-flag qa-form-light-button" title="Zgłoś pytanie jako niezgodne z regulaminem/spam">');
                $this->output( '</div>' );
                $this->output('<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>');
                $this->output("<script> function deselect(e) {
  $('.pop').slideFadeToggle(function() {
    e.removeClass('selected');
  });    
}

$(function() {
  $('.qa-form-light-button-flag').on('click', function() {
    if($(this).hasClass('selected')) {
      deselect($(this));               
    } else {
      $(this).addClass('selected');
      $('.pop').slideFadeToggle();
    }
    return false;
  });

  $('.close').on('click', function() {
    deselect($('#contact'));
    return false;
  });
});

$.fn.slideFadeToggle = function(easing, callback) {
  return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
};
</script>
<div class='messagepop pop'>
        <p><label for='nazwa'>Wpisz powód zgłoszenia</label><input type='text' name='nazwa' id='nazwa' /></p>
        <p>Bądź wybierz z już istniejących</p><select id='selekt' name='selekt'>");
                $reasonList = $this->getReason();
                $reasonListCount = count($reasonList);
                for($i=1;$i<=$reasonListCount-1;$i++)
				{
                    $this->output("<option>");

                        $this->output($reasonList[$i]);

                    $this->output("</option>");
                }
                $args[0]=qa_get_logged_in_userid();
                $url = qa_request();
                $qId = explode("/", $url);
                $args[1]=$qId[0];
                $args[2]="";

echo '        </select>
        <p><input type="submit" onClick="addReport('.$args[0].', '.$args[1].', getReasonType());" value="Dodaj" name="commit" id="message_submit"/> lub <a class="close" href="/">Anuluj</a></p>
</div>';

            }
            
            parent::q_view_buttons($q_view);
        }
        function c_item_buttons( $c_item )
        {
            if ($this->checkReport())
			{

                
                $this->output( '<div class="socials-wrapper">' );
                        $this->output('<input type="submit" id="btn" class="qa-form-light-button-flag qa-form-light-button" title="Zgłoś pytanie jako niezgodne z regulaminem/spam">');
                $this->output( '</div>' );
            }
            
            parent::c_item_buttons($c_item);
        }
        function a_item_buttons( $a_item )
        {
            if ($this->checkReport())
			{
                $page_url = qa_path_absolute( qa_request() );

                
                $this->output( '<div class="socials-wrapper">' );
                        $this->output('<input type="submit" id="btn" class="qa-form-light-button-flag qa-form-light-button" title="Zgłoś pytanie jako niezgodne z regulaminem/spam">');
                $this->output( '</div>' );
            }
            
            parent::a_item_buttons($a_item);
        }
}
?>