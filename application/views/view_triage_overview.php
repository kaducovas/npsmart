<script type="text/javascript">
//var reportnename = <?php echo $reportnename;?>
//var node = 'CO';
var reportnename = "<?php echo $reportnename; ?>";
var reportdate = "<?php echo $reportdate; ?>";
</script>
<div class="triage_menu">
&emsp;<font color="#A4A4A4" size="4"><b><a style = "color:#A4A4A4" onclick='selectkpitriage(this)'>Overview</a></b></font>
</div>
<div align="right">
<font color="#A4A4A4" size="4"><b><a style = "color:#A4A4A4" onclick='selectkpitriage(this)'>Cell Mapping</a></b></font>&emsp;
</div>
<br>
<br>
<div id="evolution" style="min-width: 98%; max-width: 98%; height: 500px; margin: 0 auto"></div>
<br>
<br>
<div id="overview" style="min-width: 50%; max-width: 50%; height: 700px; margin: 0 auto"></div>
<br>
<br>
<div id="otm_pie" class="triage_content"></div>
<div id="otm_column" class="triage_content"></div>
<br>
</body>
</html>