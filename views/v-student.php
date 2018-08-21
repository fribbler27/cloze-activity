<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cloze Assignment</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<div id="app" v-show="initialized" class="container">
	<h2 class="mt-3">
		<div class="activity-title">{{ activity_title }}</div>
		<small class="text-muted">Cloze Assignment</small>
	</h2>
	<div class="card mt-4">
		<div class="card-body text-center">
			<b>Questions:</b>
			<question-status
				v-for="question in questions"
				v-bind:key="question.index"
				v-bind:question="question"
				v-on:question-status-clicked="question_status_clicked"
			></question-status>
		</div>
	</div>
	<question-player
		v-for="question in questions"
		v-bind:key="question.index"
		v-bind:question="question"
	></question-player>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
var launch_data = <?=$this->launch_data()?>;
var link_data = <?=$this->link_data()?>;

<?php include "js/utilities.js"; ?>
</script>

<?php
include "js/vue-components/question-status.html";
include "js/vue-components/question-player.html";
include "js/vue-components/question-part.html";
include "js/vue-components/question-blank-single.html";
include "js/vue-components/question-blank-multiple.html";
?>

<script>
<?php include "js/student.js"; ?>
</script>
</body>
</html>
