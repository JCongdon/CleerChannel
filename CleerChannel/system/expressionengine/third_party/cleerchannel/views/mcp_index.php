<script type="text/javascript">
	function confirm_submit(){
		return confirm('Are you sure you want to delete these entries?');
	}
</script>
<div>
	<p>Select a Channel and delete all entries in that channel.</p>
	<?=form_open($form_url . "&method=delete_entries", "onsubmit='return confirm_submit();'")?>
	<table width="300px" class="mainTable" cellspacing="0" cellpadding="3">
	        <thead>
	            <th></th>
	            <th>Channel Name</th>
	        </thead>
	        <tbody>
	  
		<?php
			foreach ($channel_data as $key=>$value) {
			    ?>
	            <tr>
	                <td width="1%" valign="top">      
					    <input type="checkbox" name="channel_id[]" value="<?= ($key) ;?>" >
					</td>
	                <td width="99%" valign="top">      
					    <?= ($value) ; ?>
					</td>
				</tr>
			<?php } ?>
			<tr>
				<td colspan="2">
					<?=form_submit(array('name' => 'submit', 'value' => 'Delete', 'class' => 'submit'))?>
				</td>
			</tr>
	</table>
	<?= form_close() ?>
</div>