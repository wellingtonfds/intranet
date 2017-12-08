<?php

namespace App\Managers;


use Illuminate\Http\Request;

trait AuthenticatesLdapUsers{

    protected function attemptLoginLdap(Request $request){

        return false;
    }

    protected static function checkDominio($user,$pass) {
        $dominios = array("lyonengenharia", "lyonfacilities", "admgeral");
        foreach ($dominios as $row) {
            if(self::CheckLdap($user, $pass, $row)){
                return $user."@".$row.".com.br";
            }
        }
        return NULL;
    }

    private function checkLdap($user,$pass, $domain) {
        $ldap['user'] = $user;
        $ldap['pass'] = $pass;
        $ldap['host'] = 'ldap.lyonengenharia.com.br';
        $ldap['port'] = 389;
        $ldap['dn'] = 'uid=' . $ldap['user'] . ',ou=people,dc=' . $domain . ',dc=com,dc=br';
        $ldap['base'] = '';
        $ldap['conn'] = ldap_connect($ldap['host'], $ldap['port']);
        ldap_set_option($ldap['conn'], LDAP_OPT_PROTOCOL_VERSION, 3);
        if (@ldap_bind($ldap['conn'], $ldap['dn'], $ldap['pass'])) {
            return true;
        }
        return false;

    }

}