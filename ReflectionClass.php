
$methodsString = NULL;
$test = new ReflectionClass("xxxxAction");
$methods = $test->getMethods(ReflectionMethod::IS_PUBLIC);
foreach ($methods as $key => $value) {
	$methodsString .= strtolower($value->name)."\r\n";
}
$filename = 'file.txt';
$fh = fopen($filename, "a");
fwrite($fh, $methodsString);
fclose($fh);
exit();
