// main Vue application for instructor view
var app = new Vue({
	el: '#app',
	data: {
		"id": window.link_data.id,
		"activity_title": window.link_data.title,
		"questions": [],
		"show_saved_indicator": false,
		"initialized": false
	},
	created: function() {
		for (var i = 0; i < window.link_data.questions.length; ++i) {
			this.questions.push({
				"num": (i+1),
				"text": window.link_data.questions[i]
			});
		}
		this.initialized = true;
	},
	methods: {
		save: function() {
			var data = {"link_data": {
				"id": this.id,
				"questions": []
			}};
			for (var i = 0; i < this.questions.length; ++i) {
				data.link_data.questions[i] = this.questions[i].text;
			}

			U.ajax("save_activity", data, function() {
				this.show_saved_indicator = true;
				setTimeout(function() { this.show_saved_indicator = false; }.bind(this), 1000);
			}.bind(this));
		}
	}
})
