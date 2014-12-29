<?php

function createUser()
{

	$ldap_host = $this->ldap_host;
	$ldap_port = $this->ldap_port;
	$root_dn = $this->root_dn;
	$root_pass = $this->root_pass;
	$ldap_conn = ldap_connect($ldap_host, $ldap_port) or die("Can't connect to LDAP server");//建立与 LDAP 服务器的连接
	$result = ldap_bind($ldap_conn, $root_dn, $root_pass) or die("Can't bind to LDAP server.");//与服务器绑定

$username = "aaa";
$info=array();
$password = "111111";
$info["objectClass"] =array();
$info["objectClass"][] = "top";
$info["objectClass"][] = "inetOrgPerson";
$info["objectClass"][] = "posixAccount";
$info["uid"]=$username;
$info["homeDirectory"] = "/var/vhome/".$username;
$info["givenName"] = $username;
$info["sn"] = $username;
$info["displayName"] = $username;
$info["cn"] = $username;
$info["mail"] = $username."@wacai.com";
$info["userPassword"] = "{md5}" . $password;
$info["uidnumber"]="1093";
$info["gidNumber"]=500;
$info["loginShell"]="/usr/bin/zsh";


	$r = ldap_add($ldap_conn,"cn=aaa,ou=People,dc=wacai,dc=com",$info);
	ldap_close($result);
}
