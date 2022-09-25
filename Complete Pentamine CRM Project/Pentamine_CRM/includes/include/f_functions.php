<?php
function ftpLogin($ftpstream, $username, $password) {
	$login = @ftp_login($ftpstream, $username, $password);
	if($login) {
		return 1;
	} else {
		return 0;
	}
}

function ftpDelete($ftpstream, $filename) {
	if (ftp_delete($ftpstream, $filename)) {
		return 1;;
	} else {
		return 0;
	}
}

function ftpClose($ftpstream) {
	ftp_close($ftpstream);
}
