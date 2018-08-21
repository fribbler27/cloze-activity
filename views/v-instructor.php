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
		<button type="button" class="btn btn-secondary float-right" @click="save">Student Preview</button>
		<div class="activity-title">{{ activity_title }}</div>
		<small class="text-muted">Cloze Assignment</small>
	</h2>
	<div class="card mt-4">
		<div class="card-header">
			<button type="button" class="btn btn-secondary float-right" @click="save">Save</button>
			<span class="float-right mr-3" v-show="show_saved_indicator"><i>Saved</i></span>
			<h3>Questions</h3>
		</div>
		<div class="card-body">
			<question-editor
				v-for="question in questions"
				v-bind:key="question.num"
				v-bind:question="question"
			></question-editor>
		</div>
	</div>
	<div class="card mt-4">
		<div class="card-header">
			<h2>Student Results</h2>
		</div>
		<div class="card-body">
		</div>
	</div>
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
include "js/vue-components/question-editor.html";
?>

<script>
<?php include "js/instructor.js"; ?>
</script>
</body>
</html>
