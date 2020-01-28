<?php
###############################
#		Switch 						#
###############################
$mode = $_POST['mode'];
switch ($mode) {

############################
#		Install 					#
############################
    case "install":
		/* display page header and start graphics */
        echo ("<!DOCTYPE HTML \">\n
<html>\n
<head>\n
	<title>MyIT Upgrader</title>\n
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n
	<link type=\"text/css\" href=\"../../css/default.css\" rel=\"stylesheet\" >\n

</head>\n
<body>\n
<center>\n
<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n
	<tr>\n
		<td><img src=\"../../images/logo.jpg\" alt=\"\" width=\"490\" height=\"114\"></td>\n
	</tr>\n
</table>\n
			
<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"2\">\n
	<tr>\n
		<td colspan=\"3\" background=\"../../images/index03.gif\"><img src=\"../../images/index03.gif\" alt=\"\" width=\"100%\" height=\"40\"></td>\n
	</tr><tr>\n
		<td align=\"center\">\n

			<table width=\"100%\" border=\"0\" cellpadding=\"20\" cellspacing=\"0\">\n
				<tr>\n
					<td class=\"olotd\" align=\"center\">\n
						
						<!-- Begin Page -->\n
						<table width=\"800\" cellpadding=\"5\" cellspacing=\"0\" border=\"0\" >\n
							<tr>\n
								<td class=\"menuhead2\" width=\"80%\">&nbsp;MYIT CRM Upgrader</td>\n
							</tr><tr>\n
								<td class=\"menutd2\" colspan=\"2\">\n

									<table width=\"100%\"  class=\"olotable\" cellpadding=\"5\" cellspacing=\"0\" border=\"0\" >\n
										<tr>
											<td>
												<table width=\"100%\"  class=\"menutd\" cellpadding=\"5\" cellspacing=\"0\" border=\"0\" >\n
									");	

        
		/* Load our new configs */

        require("../../include/ADODB/adodb.inc.php");

		/* Create ADODB Connection */
        $db = &ADONewConnection('mysql');

        $db->Connect($_POST['db_host'] ,$_POST['db_user'], $_POST['db_password']);
        if( $db->errorMsg() != '' ) {
            echo "There was an error connecting to the database: ".$db->errorMsg();
            die;
        }



        ##################################
        # Create New Connection				#
        ##################################
        $db->close();
        include("../../conf.php");

        if( $db->errorMsg() != '' ) {
            echo "There Was an error connecting to the database: ".$db->errorMsg();
            die;
        }
        
        $path2 = $_POST['default_site_name'];
        $prefix = $_POST['db_prefix'];
        @define('PRFX', $prefix);
        ##################################
        # Build Tables							#
        ##################################
		/*include sql.php */
        include("sql.php");


        if($error_flag == true) {
	/* error can not complete the install */
            echo("<tr>\n
				<td colspan=\"2\">There where errors during the upgrade process. MyIT CRM has not been upgraded. If the errors continue please submit a bug report at http://team.myitcrm.com</td>\n
			</tr>\n");
        } else {
		/* create lock file */
            if(!touch("../../cache/lock")) {
                echo("<tr><td colspan=\"2\"><font color=\"red\">Failed to create lock file. Please create a file name lock and put it in the cache folder !!</font></td></tr>");
            }

		/* done */

            echo("<tr>\n<td colspan=\"2\"><font size=\+2 color=\"red\">Your Upgrade was successful to v0.2.9.0.</font>
				<br><br>
				There are still a few steps that need to be completed.<br>
				1. You need to move or rename the upgrade directory. We recommend deleting this folder.<br>
                                2. You then need to login as an administrator and setup the additional infomration under the Business Setup>>Business Setup Menu option.<br>
				3. You can now resume your normal operation mode.
				<br><br>
				Where to find help:<br>
				The user Documentation is at <a href=\"http://team.myitcrm.com/wiki/main\">http://team.myitcrm.com/wiki/main</a><br>
				Bug/Feature Reporting is at <a href=\"http://team.myitcrm.com/projects/main/issues/new\">Bug Tracker</a><br>

				</td>\n</tr>\n");
        }

        echo("
									</table>\n
								</td>\n
							</tr>\n
						</table>\n

					</td>\n
				</tr>\n
			</table>\n
		</td>\n
	</tr>\n
</table>\n
			<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n
				<tr>
					<td height=\"51\" align=\"center\" background=\"../../images/index41.gif\"></td>\n
				</tr><tr>\n
					<td height=\"48\" align=\"center\" background=\"../../images/index42.gif\"><span class=\"text3\"></a>
								All rights reserved.</span></td>\n
				</tr><tr>\n
					<td>&nbsp;</td>\n
				</tr>\n
			</table>\n
		</td>\n
	</tr>\n
</table>\n
</center>\n

</body>\n
</html>\n");
        break;

    ################################
    #		Default						#
    ###############################
    default:
        $default_path = resolveDocumentRoot();
        $default_server = get_server_name();

        echo ("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">
<html>
<head>
	<title>MYIT CRM Upgrader</title>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
	<link type=\"text/css\" href=\"../../css/default.css\" rel=\"stylesheet\">");
        include('../validate.js');
        echo ("
</head>
<body>
<p>&nbsp;</p>
<center>
<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	<tr>
		<td><img src=\"../../images/logo.jpg\" alt=\"\" width=\"490\" height=\"114\"></td>
	</tr>
</table>
			
<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
	<tr>
		<td colspan=\"3\" background=\"../../images/index03.gif\"><img src=\"../../images/index03.gif\" alt=\"\" width=\"100%\" height=\"40\"></td>
	</tr><tr>
		<td align=\"center\">
		<br><br>

<table width=\"100%\" border=\"0\" cellpadding=\"20\" cellspacing=\"0\">
	<tr>
		<td class=\"olotd\" align=\"center\">
			
			<!-- Begin Page -->
			<table width=\"800\" cellpadding=\"5\" cellspacing=\"0\" border=\"0\" >
				<tr>
					<td class=\"menuhead2\" width=\"80%\">&nbsp;MyIT CRM Upgrader from versions 0.2.8.2, 0.2.9.0</td>
					</td>
				</tr><tr>
					<td class=\"menutd2\" colspan=\"2\">

						<table width=\"100%\" class=\"olotable\" cellpadding=\"5\" cellspacing=\"0\" border=\"0\" >
							<tr>
								<td width=\"100%\" valign=\"top\" >

									<form action=\"index.php\" method=\"POST\" name=\"install\" id=\"install\" onsubmit=\"try   { var myValidator = validate_install; } catch(e) { return true; } return myValidator(this);\">
									<input type=\"hidden\" name=\"mode\" value=\"install\">

										<table width=\"100%\" class=\"menutd\" cellspacing=\"0\"  border=\"0\" cellpadding=\"5\">
											<tr>
												<td>
													<table >
														<tr>
															<td>
															<b>Initial File Checks</b><br>

															<table class=\"olotable\" cellpadding=\"5\" cellspacing=\"0\" border=\"0\" >
																<tr>
																
																	<td width=\"140\">Cache Folder</td>
																	<td>");
        if(!check_write ('../../cache')) {
            echo("<font color=\"red\">../cache is not writable stopping.</font>");
            $errors[] = array('../cache'=>'Not Writable');
        } else {
            echo("<font color=\"green\"><b>OK</b>");
        }
        echo( "</td>
																
																</tr><tr>
																
																	<td width=\"140\">Access Log</td>
																	<td>");
        if(!check_write ('../../log/access.log')) {
            echo("<font color=\"red\">../../log/access.log is not writable stopping.</font>");
            $errors[] = array('../../log/access.log'=>'Not Writable');
        } else {
            echo("<font color=\"green\"><b>OK</b>");
        }
        echo("<td>
																	
																</tr><tr>
															<!-- End of File Checks -->
																	<td colspan=\"2\">&nbsp;</td>
																</tr><tr>
																	<td colspan=\"2\"></td>
																		
																</tr>
															</table>");
        if(is_array($errors)) {
            echo("Set up can not continue until the following errors are fixed:<br>");
            foreach($errors as $key=>$val) {
                echo("<font color=\"red\">Error $key: ");
                foreach($val as $k=>$v) {
                    echo("$k $v");
                }
                echo("</font><br>");
            }
        } else {
            echo ("
															<br>
															<b>Database Information:</b>
															<table  class=\"olotable\" cellpadding=\"5\" cellspacing=\"0\" border=\"0\" >
																<tr>
																	<td valign=\"top\" width=\"60%\" align=\"left\">
																		<table >
																			<tr>
																				<td width=\"140\">Database User:</td>
																				<td ><input type=\"text\" size=\"20\" name=\"db_user\" value=\"username\" class=\"olotd5\"></td>
																			</tr><tr>
																				<td width=\"140\">Database Password:</td>
																				<td><input type=\"password\" size=\"20\" name=\"db_password\" class=\"olotd5\"></td>
																			</tr><tr>
																				<td width=\"140\">Database Host:</td>
																				<td><input type=\"text\" size=\"20\" name=\"db_host\" value=\"localhost\" class=\"olotd5\"></td>
																			</tr><tr>
																				<td width=\"140\">Database Name:</td>
																				<td>
																					<input type=\"text\" size=\"30\" name=\"db_name\" value=\"myitcrm\" class=\"olotd5\">
																				</td>
																			</tr><tr>
																					<td width=\"140\">Table Prefix</td>
																					<td>
																						<input type=\"text\" size=\"30\" name=\"db_prefix\" value=\"MYIT_\" class=\"olotd5\">
																					</td>
																				</tr>

																			</table>
																	</td>
																	<td valign=\"top\">

																		<table width=\"100%\"  cellpadding=\"5\" cellspacing=\"0\" border=\"0\">
																			<tr>
																				<td colspan=\"2\">Please ensure that you have created this database prior to installtion. You can change table prefix to suit your needs.
																				The pre set examples will work fine for most installs.<br><br>
																				Next you need to add a user and password for the database to run as. We do not suggest using the root Mysql User for this.
																				</td>
																			</tr>
																		</table>

																	</td>
																</tr>
															</table>
															<br>																							
															<table>
																<tr>
																	<td>");
            if(is_array($errors)) {
                echo("Set up can not continue until the following errors are fixed:<br>");
                foreach($errors as $key=>$val) {
                    echo("<font color=\"red\">Error $key: ");
                    foreach($val as $k=>$v) {
                        echo("$k $v");
                    }
                    echo("</font><br>");
                }
            } else {
                echo("<input type=\"submit\" name=\"submit\" value=\"Upgrade\">");
            }
            echo("</td>
																</tr>
															</table>
															
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</form>	  	  
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
			<br><br>
			<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
				<tr>
					<td height=\"51\" align=\"center\" background=\"../../images/index41.gif\"></td>
				</tr><tr>
					<td height=\"48\" align=\"center\" background=\"../../images/index42.gif\"><span class=\"text3\"><a> This software is distrubuted under the GNU General Public License</span></t
				</tr><tr>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</center>

</body>
</html>");
        }
}

function resolveDocumentRoot() {
    $current_script = dirname($_SERVER['SCRIPT_NAME']);
    $current_path  = dirname($_SERVER['SCRIPT_FILENAME']);

   /* work out how many folders we are away from document_root
       by working out how many folders deep we are from the url.
       this isn't fool proof */
    $adjust = explode("/", $current_script);
    $adjust = count($adjust)-1;

   /* move up the path with ../ */
    $traverse = str_repeat("../", $adjust);
    $adjusted_path = sprintf("%s/%s", $current_path, $traverse);

   /* real path expands the ../'s to the correct folder names */
    return realpath($adjusted_path);
}

function get_server_name() {
    $default_server = $_SERVER['SERVER_NAME'];
    return $default_server;

}
#####################################
#		Check Lock					#
#####################################
function check_lock_file() {
    $lock_file = "../../cache/lock";
    if (file_exists($lock_file)) {
        return true;
    } else {
        return false;
    }
}



#####################################
#		Check If File Exists		#
#####################################
function file_exists_incpath ($file) {
    $paths = explode(PATH_SEPARATOR, get_include_path());

    foreach ($paths as $path) {
    // Formulate the absolute path
        $fullpath = $path . DIRECTORY_SEPARATOR . $file;

        // Check it
        if (file_exists($fullpath)) {
            return true;
        }
    }

    return false;
}


#####################################
#		Check If File writes		#
#####################################
function check_write ($file) {
    if(is_writable($file)) {
        return true;
    } else {
        return false;
    }
}


#####################################
#		Generic error checking		#
#####################################
function error_check($error) {
    echo("<font color=\"red\"><b>Error: </b></font>$error</br>");
    exit;
}

#####################################
#		Generic error checking		#
#####################################
function validate($data) {
//print_r($data);

	/* check for Null all values are required */
    foreach($data as $key => $val) {
        if($val == "") {
            error_check("Missing field $key.<br>");
        }
    }

}
?>
