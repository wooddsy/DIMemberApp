<!doctype html>

<html lang="en">
<head>
<meta charset="utf-8">

<title>DI Tools Development menu</title>
<meta name="description" content="DI Tools Development menu">
<meta name="author" content="Subatomisch">

<link href="https://fonts.googleapis.com/css?family=Fjalla+One|Muli&display=swap" rel="stylesheet"> 

</head>

<body>
	<style>
		body {
			font-family: 'Muli', sans-serif;
		}

		.container {
			width: 80%;
			margin: 0 auto;
			background: #CCCCCC;
			padding: 10px;
			margin-top: -21px;
		}

		.container .row {
			width: 100%;
			overflow: hidden;
			height: auto;
		}

		.container .row .element {
			width: auto;
			height: auto;
		}

		.container .row .element h1 {
			font-family: 'Fjalla One', sans-serif;
			width: 100%;
			padding: 10px;
		}

		.container .row .element p {
			width: 97.8%;
			padding: 10px;
			background: #999999;
			margin: 5px;
		}

		.container .row .element .column {
			width: 45%;
			height: auto;
			min-height: 250px;
			padding: 20px;
			margin: 5px;
			float: left;
			background: #999999;
		}

		.container .row .element .column .button {
			width: 90%;
			height: 50px;
			padding: 10px;
			background: #6EB5FF;
			margin: 10px auto;
			text-align: center;
			line-height: 50px;
			cursor: pointer;
		}

		.container .row .element .column .button:hover {
			background: #ACE7FF;
		}

	</style>

	<div class="container">
		<div class="row">
			<div class="element">
				<h1>DI Tools Development menu</h1>
				<p>Please select a section of the project that you want to view, use the buttons to go to the desired section. If you want to come back to this page please go to the url <a href="http://projects.subatomisch.nl/di_tools/">http://projects.subatomisch.nl/di_tools/</a></p>
			</div>
		</div>

		<div class="row">
			<div class="element">
				<div class="column">
					<div class="button" id="button-template" onclick="location.href = 'http://projects.subatomisch.nl/di_tools/template-simple';">Template simple</div>
				</div>
				<div class="column">
					<div class="button" id="button-functional-complex-root" onclick="location.href = 'http://projects.subatomisch.nl/di_tools/functional_scripts/basic';">Functional</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>