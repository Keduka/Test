<?php
//-------------------------------------------------
//準備
//-------------------------------------------------

$dsn  = 'mysql:dbname=noveldb;host=127.0.0.1';   //接続先
$user = 'root';         //MySQLのユーザーID
$pw   = 'H@chiouji1';   //MySQLのパスワード

	// 「ニューゲーム」
	if( array_key_exists('playername', $_GET) ){
		$sql = 'update save set playername=:name';
		
		$dbh = new PDO($dsn, $user, $pw);   //接続
		$sth = $dbh->prepare($sql);         //SQL準備
		$sth->bindValue(':name', $_GET['playername'], PDO::PARAM_STR);
		$sth->execute();
		
		$playername = $_GET['playername'];
	}
	// 「ロード」
	else{
		$sql = 'select playername from save';
		
		$dbh = new PDO($dsn, $user, $pw);   //接続
		$sth = $dbh->prepare($sql);         //SQL準備
		$sth->execute();
		$buff = $sth->fetch(PDO::FETCH_ASSOC);
		
		$playername = $buff['playername'];
	}
	
	$sql = 'select value from scenario';
	$dbh = new PDO($dsn, $user, $pw);   //接続
	$sth = $dbh->prepare($sql);         //SQL準備
	$sth->execute();                    //実行
	/*
	while(true){
		$buff = $sth->fetch(PDO::FETCH_ASSOC);
		if($buff === false){
			break;
		}
		$huga = $buff['value'];
	}
	*/
	
	$hoge = $sth->fetch(PDO::FETCH_ASSOC);
	$huga = $hoge['value'];
	
	/*
	$sql = 'select * from scenario';
	$dbh = new PDO($dsn, $user, $pw);   //接続
	$sth = $dbh->prepare($sql);         //SQL準備
	$sth->execute();                    //実行
	//取得した内容を表示する
	while(true){
    	//ここで1レコード取得
    	$buff = $sth->fetch(PDO::FETCH_ASSOC);
    	if( $buff === false ){
       		break;    //データがもう存在しない場合はループを抜ける
    	}
    	var $scenario = [
    		[$buff['command'], $buff['value']
    	];
    }*/
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf8">
		<title>ノベルゲーム</title>
		
		<style>
		#novelwindow{
			border: 1px solid gray;
			width: 800px;
			height: 600px;
			
			background-image: url(image/earth.jpg);
			background-size: 800px 600px;
		}
		
		#message{
			position: absolute;
			top: 350px;
			left: 75px;
			
			border: 1px solid blue;
			background-color: rgba(45, 248, 255, 0.7);
			width: 650px;
			height: 200px;
			
			font-size: 24pt;
			padding: 5px;
		}
		
		#char1{
			position: relative;
			height: 600px;
			
		}
		
		</style>
		
	</head>
	<body>
	
		<div id = "novelwindow">
			<img id = "char1" src = "image/f270.png">
		
			<div id = "message">
				ぐギャギャグオーン
			</div>
		
		</div>
		
		<script>
			
			var playername = "<?= $playername ?>";
			var huga = "<?= $huga ?>";
		
			//シナリオの定義
			var scenario = [
				["TXT", huga],
				["TXT", "##NAME##はズギャギャぎギィーーン"],
				["CHAR", "image/f216.png"]
			];
			
			var msg = document.querySelector("#message");
			var char1 = document.querySelector("#char1");
			var i = 0;
			
			msg.addEventListener("click", function(){
				var command = scenario[i][0];
				var value = scenario[i][1];
				
				switch(command){
					case "TXT":
					value = value.replace(/##NAME##/g,
						"<span style = 'color: red'>" + playername + "</span>");
					
					msg.innerHTML = value;
					break;
					case "CHAR":
					char1.setAttribute("src", value);
					break;
				}
				
				i++;
			});
		</script>
	
	</body>
</html>

















