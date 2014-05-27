<!-- File: /app/views/posts/index.ctp -->
<h1>Reps</h1>
<style>
	input, textarea{
	padding: 0;
	font-size: 100%;
	width: auto;
}
label{
	display: inline;
}
div.submit{
	display: inline;
}
</style>
Since: <?php echo $this->Form->create(array("action" => "setTime"));
			$defaults = array("div" => false, "between" => ":",  "after" => "&nbsp;");
			echo $this->Form->input("month", $defaults);
			echo $this->Form->input("day", $defaults);
			echo $this->Form->input("year", $defaults);
			echo $this->Form->end("Go", $defaults);
		?>
<table>
	<tr>
		<th><?php echo $this->Html->link("First Name", array("controller" => "reps", "action" => "spentSort", "Rep.firstName")); ?></th>
		<th><?php echo $this->Html->link("Last Name", array("controller" => "reps", "action" => "spentSort", "Rep.lastName")); ?></th>
		<th><?php echo $this->Html->link("ID", array("controller" => "reps", "action" => "spentSort", "Rep.id")); ?></th>
		<th><?php echo $this->Html->link("Spent", array("controller" => "reps", "action" => "spentSort", "spent")); ?></th>
	</tr>
	<?php foreach($reps as $rep): ?>
	<tr>
		<td><?php /*echo $this->Html->link($rep['Rep']['firstName'], array("controller" => "reps", "action" => "view", $rep["Rep"]["id"]))*/  echo $rep['Rep']['firstName'] ?></td>
		<td><?php echo $rep['Rep']['lastName']; ?></td>
		<td><?php echo $rep['Rep']['id']; ?></td>
		<td>$<?php echo $rep["spent"]; ?></td>
	</tr>
	<?php endforeach; ?>
	<tr>
		<td colspan = "3">Total</td>
		<td>$<?php echo $total ?></td>
	</tr>
</table>