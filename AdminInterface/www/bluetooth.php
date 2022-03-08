<?php
	/*
	'https://gist.github.com/yejun/2c1a070a839b3a7b146ede8a998b5495    !!!!!
	discoverable on
	pairable on
	agent on
	default-agent
	scan on
	*/

	$change=0;
	$onlinejson = file_get_contents('https://raw.githubusercontent.com/splitti/MuPiBox/main/config/templates/mupiboxconfig.json');
	$dataonline = json_decode($onlinejson, true);
	include ('includes/header.php');

	if( $_POST['change_bt'] == "" )
		{
		$command = "sudo bluetoothctl power on; sudo discoverable on; sudo bluetoothctl pairable on; sudo bluetoothctl agent on; sudo bluetoothctl default-agent";
		exec($command, $output, $result );
		$change=1;
		}
	else if( $_POST['change_bt'] == "turn off" )
		{
		$command = "sudo bluetoothctl power off";
		exec($command, $output, $result );
		$change=1;
		}

	$rc = $output[count($output)-1];
	$command = "sudo bluetoothctl show | grep 'Powered: yes'";
	exec($command, $smboutput, $smbresult );
	if( $smboutput[0] )
		{
		$bt_state = "ON";
		$change_bt = "turn off";
		}
	else
		{
		$bt_state = "OFF";
		$change_bt = "turn on";
		}
?>

                <form class="appnitro"  method="post" action="bluetooth.php">
                                        <div class="description">
                        <h2>MupiBox bluetooth settings</h2>
                        <p> Set up bluetooth connections...</p>
                </div>
                        <ul ><li id="li_1" >
                                        
								<li class="li_1"><h2>Bluetooth power state</h2>
								<p>
								<?php 
								echo "Bluetooth power state: <b>".$bt_state."</b>";
								?>
								</p>
								<input id="saveForm" class="button_text" type="submit" name="change_bt" value="<?php print $change_bt; ?>" /></li>


                        </ul>
                </form>
        </div>
<?php
	include ('includes/footer.html');
?>