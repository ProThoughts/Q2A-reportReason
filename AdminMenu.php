<?php
class AdminMenu
{
	private $db_ok=false;
        private $saved;
	function admin_form()
	{
                $saved = false;
		if (qa_clicked('reportReason_save'))
                {
			$enable = (int)qa_post_text('reportReason_enable');
			qa_opt('reportReason_enable', $enable);
			$saved = true;
		}
		$form = [
			'ok' => ($saved === true) ? 'Zapisano!' : null,
			'fields' => [
				'enable' => [
				    'type' => 'checkbox',
					'label' => 'Włącz dodawanie powodów dla zgłoszeń',
					'value' => qa_opt('reportReason_enable'),
					'tags' => 'name="reportReason_enable"'
				],
			],
			'buttons' => [
				[
					'label' => 'Zapisz',
					'tags' => 'name="reportReason_save"'
				]
			]
		];
		return $form;
	}

	public function init_queries($tableslc)
	{
        $sql = 'SHOW COLUMNS FROM `^uservotes` WHERE `field` = "reason"';
            if (!qa_db_read_all_assoc(qa_db_query_sub($sql)))
	    {
	        return 'ALTER TABLE `^uservotes` ADD `reason` TEXT DEFAULT NULL';
	        $this->db_ok=true;
            }else
	    {
          	$this->db_ok=true;
            } 
	}


}

?>
