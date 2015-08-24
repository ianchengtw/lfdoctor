$(document).ready(function(){
	
	function mfData(s, e) {
		return {
			start: s
			,end: e
			,toString: function() {
				return this.start + ' - ' + this.end; 
			}
		};
	}

	var mfQuestion = {
		data: null
		,buildQuestion: function(data) {
			this.data = data;
			this.setView();
		}
		,getData: function() {
			return this.data;
		}
		,setView: function() {
			$('#qStart').html(this.getString(this.data.start));
			$('#qEnd').html(this.getString(this.data.end));
		}
		,getString: function(x) {
			return (x < 10) ? '0'+x : x;
		}
	};

	var mfHistory = {
		history: []
		,set: function(data, answer, result) {
			this.history.push({data, answer, result});
			this.addRecord(data.toString() + ' | ' + answer + ' | ' + result);
		}
		,get: function() {
			return this.history;
		}
		,setView: function(data) {
			$('.mfHistory .title').html(data);
			$('.mfHistory .content').html('');
		}
		,addRecord: function(data) {
			$('.mfHistory .content').prepend(jQuery('<div/>', {text:data}));
		}
	};

	var mfController = {
		init: function() {
			this.initBtn();
			this.buildQuestion();
			mfHistory.setView('Question | Answer | Result');
		}
		,initBtn: function() {
			$('.btn-detect-container span').each(function(i, elem){
				$(elem).on('click', function(){
					mfController.answerQuestion(i);
				});
			});
		}
		,buildQuestion: function() {
			mfQuestion.buildQuestion(
				new mfData( this.getRandom(), this.getRandom() )
			);
		}
		,answerQuestion: function(answer) {
			mfHistory.set(
				mfQuestion.getData()
				,answer
				,this.getResult( mfQuestion.getData(), answer )
			);
			this.buildQuestion();
		}
		,getResult: function(question, answer) {
			var start = question.start
				,end = question.end;

			// Is the answer inside the question
			if (start <= end)
			{
				return (
					answer >= start
					&& answer <= end
				);
			}
			else
			{
				return (
					answer >= start
					|| answer <= end
				);
			}
		}
		,getRandom: function() {
			return Math.floor((Math.random() * 24));
		}
	};

	mfController.init();
});