{title}New Report{/title}
{add_bread_crumb}New Time Report{/add_bread_crumb}

<div id="add_time_report">
  {form action=$add_report_url method=post id=time_report_form}
    {include_template name=_report_form controller=global_timetracking module=timetracking}
    
    {wrap_buttons}
      {submit}Submit{/submit}
    {/wrap_buttons}
  {/form}
</div>
<script type="text/javascript">
  App.timetracking.TimeReportForm.init('time_report_form', '{assemble route=global_time_report_partial_generator}');
</script>