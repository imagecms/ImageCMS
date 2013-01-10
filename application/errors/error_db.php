<html>
<head>
<title>Database Error</title>
<style type="text/css">

body {
background-color:	#EBEBEB;
margin:				40px;
font-family:		Lucida Grande, Verdana, Sans-serif;
font-size:			12px;
color:				#000;
}

#content{
border:				#999 1px solid;
background-color:	#fff;
padding:			20px 20px 12px 20px;
}

h1 {
font-weight:		bold;
font-size:			14px;
color:				#545454;
margin: 			0 0 4px 0;
}

#error_text h1 {
    font-weight:normal;
}

</style>
</head>
<body>
	<div id="content">
		<h1><?php echo $heading; ?></h1>
        <div id="error_text"><?php echo $message; ?></div>
        <a href="mailto:username@domain">Сообщить администратору</a>
	</div>
</body>
</html>
