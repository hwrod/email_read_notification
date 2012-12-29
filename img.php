<?

/* Email Read Notification 
 *
 * Emails a notification when someone has viewed your email.
 *
 * Usage: Send your email in HTML format and include an image with URL pointing to this script.
 *
 * Set an id parameter to identify the email (such as the email subject or a numeric ID), like: 
 * <img src="http://example.com/img.php?id=Welcome%20Friend">
 * which will email you a notification that the recipient has opened your "Welcome Friend" email.
 */

$to = 'youraddress@example.com';
if ($_GET[id]) sendNotification($to);
displayImage();

function displayImage() {
	header("Content-Type: image/png");
	$im = @imagecreate(1, 1) or die("Cannot Initialize new GD image stream");
	$background_color = imagecolorallocatealpha($im, 255, 255, 255, 127);
	imagepng($im);
	imagedestroy($im);
}

function sendNotification($to) {
	$from = "Email Read Notification <notify@{$_SERVER["SERVER_NAME"]}>";
	$subject = "Email with ID '{$_GET[id]}' was opened";
	$message = "<html><body bgcolor=\"#FFFFFF\">Email with ID <b>{$_GET[id]}</b> was opened on <b>".date('l, F jS, Y \a\t h:i:s A')."</b></body></html>";

	$headers = "From: $from\r\n";
	$headers .= "Reply-To: $from\r\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1";
	mail( $to, $subject, $message, $headers );
}
?>
