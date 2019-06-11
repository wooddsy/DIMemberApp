(function ($) {
    $.extend({
    	ajaxSimpleApiCall: function(ajaxUrl, callUrl) {
      		$.ajax(
      			{
					url: ajaxUrl,
					type: 'post',
					data: {
						callType: 'SIMPLE',
						callMethod: 'GET',
						callUrl: callUrl
					},
					success: function(result){
					    $.handleDiMemberData(jQuery.parseJSON(result));
					}
				}
			);
		},
		requestDiMemberData: function(diId) {
			var ajaxurl = '/di_tools/functional_scripts/basic/Config/Api.php';
			var diApiUrl = 'https://api.dmg-inc.com';
			var diApiUser = '/user';
			var diApiRequestType = '/fetch/';

			var callUrl = diApiUrl + diApiUser + diApiRequestType + diId;

			//Make actual call
			var result = $.ajaxSimpleApiCall(ajaxurl, callUrl);
		},
		handleDiMemberData: function(data) {
			//var str = JSON.stringify(data, null, 2);
			console.log(data);

			$('#diName').val(data.member_name);
			$('#diReputation').val(data.member_rep);
			$("#diRank option").filter(function() {
				return $(this).text() == data.member_rank;
			}).prop('selected', true);
			$("#houseId option").filter(function() {
				return $(this).text() == data.house.name;
			}).prop('selected', true);

			$.getDivisionOptions($('#houseId').val());

			setTimeout(function(){
				$("#divisionId option").filter(function() {
					return $(this).text() == data.division.name;
				}).prop('selected', true);

				$.getTeamOptions($('#houseId').val(),$('#divisionId').val());

				setTimeout(function(){
					$("#teamId option").filter(function() {
						return $(this).text() == data.team;
					}).prop('selected', true);

					$.getRosterOptions($('#houseId').val(),$('#divisionId').val(),$('#teamId').val());

					setTimeout(function(){
						$("#rosterId option").filter(function() {
							return $(this).text() == data.roster;
						}).prop('selected', true);
					}, 50);
				}, 50);
			}, 50);
		},
		getDivisionOptions: function(houseId) {
      		$.ajax(
      			{
					url: '/di_tools/functional_scripts/basic/Controller/Ajax/Divisions.php',
					type: 'post',
					data: {
						type: 'OPTIONS',
						houseId: houseId
					},
					success: function(result){
					    $.populateDivisionSelect(jQuery.parseJSON(result));
					}
				}
			);
		},
		populateDivisionSelect: function(data) {
			$('#divisionId').html(data.html);
		},
		getTeamOptions: function(houseId, divisionId) {
      		$.ajax(
      			{
					url: '/di_tools/functional_scripts/basic/Controller/Ajax/Teams.php',
					type: 'post',
					data: {
						type: 'OPTIONS',
						houseId: houseId,
						divisionId: divisionId
					},
					success: function(result){
					    $.populateTeamSelect(jQuery.parseJSON(result));
					}
				}
			);
		},
		populateTeamSelect: function(data) {
			$('#teamId').html(data.html);
		},
		getRosterOptions: function(houseId, divisionId, teamId) {
      		$.ajax(
      			{
					url: '/di_tools/functional_scripts/basic/Controller/Ajax/Rosters.php',
					type: 'post',
					data: {
						type: 'OPTIONS',
						houseId: houseId,
						divisionId: divisionId,
						teamId: teamId
					},
					success: function(result){
					    $.populateRosterSelect(jQuery.parseJSON(result));
					}
				}
			);
		},
		populateRosterSelect: function(data) {
			$('#rosterId').html(data.html);
		}
	});
})(jQuery);

