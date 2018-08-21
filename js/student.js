// main Vue application for instructor view
var app = new Vue({
	el: '#app',
	data: {
		"id": window.link_data.id,
		"activity_title": window.link_data.title,
		"questions": [],
		"current_question": null,
		"initialized": false
	},
	created: function() {
		for (var i = 0; i < window.link_data.questions.length; ++i) {
			this.questions.push({
				"index": i,
				"num": (i+1),
				"showing": false,
				"text": window.link_data.questions[i]
			});
		}
		this.show_question(this.questions[0]);
		this.initialized = true;
	},
	methods: {
		show_question: function(q) {
			if (!empty(this.current_question)) {
				this.current_question.showing = false;
			}
			this.current_question = q;
			this.current_question.showing = true;
		},

		question_status_clicked: function(q) {
			this.show_question(q);
		}

	}
})
