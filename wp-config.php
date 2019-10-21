<?php
# Database Configuration
#define( 'WPCACHEHOME', '/nas/content/live/iputest/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('WP_HOME','http://ipu.local');
define('WP_SITEURL','http://ipu.local');
define( 'DB_NAME', 'ipu' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', 'ddipass' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');

define( 'DISALLOW_FILE_EDIT', TRUE );
$table_prefix = 'wp_';

#define( 'WP_HOME', 'http://ipu.ie' );
#define( 'WP_SITEURL', 'http://ipu.ie' );
define('AUTH_KEY', 'C[J}]P:v7{100~Pk64?`,(M6nh_B;{W;F4lqN|o4X!-$2Smo{7@>]E*:X9{`$lKw');
define('SECURE_AUTH_KEY', 'TG_C-f<1Cr[-m1@7,nj+E0e,9uqNF`l4.*-.Nl%))=ISJ+g_U$gIud2])^K5;KLq');
define('LOGGED_IN_KEY', 'tkk#}L{Xd (qojt1C2a|.5t3j~,dpR6?h);D4 dr(7uO*9y L3iy.Clr%B(+gV%M');
define('NONCE_KEY', '}z`:C!:{:f?y0~MZD^B[~n/lttSA:.6R%VSZ6*a]<d&Cl6*JG3&sjWe{4>N |rcL');
define('AUTH_SALT',        ';rL11tKESK=.i[ys<XpCui3+2XUXA(6Tc1;h<~)L4p&dj[/&pFhoNrv7Ie_08g:u');
define('SECURE_AUTH_SALT', '-w%o>Q[JJu:O|3+`7E(vL~/NFuKOoEid<6NP@WI#JV->7j|*<!qdF.k|BPP&KK^Q');
define('LOGGED_IN_SALT',   '+$m2kW2JNpEGfBQ|c4n/29>K@/ZJ=r1(V|A7)H!+]K27Vwq+VD.C[g+w{+eDM-Kd');
define('NONCE_SALT',       '~ODtFC6(_PDdn2~5+F!J8pn&uUO]60vd4)-^0l?~bFAY]_i2&>i2>UCeq+Fje5&+');

# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

//define( 'PWP_NAME', 'iputest' );
define( 'PWP_NAME', 'iputest' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '1877f46e7b68c668e0c8573086d16bb80ee41cb6' );

define( 'WPE_FOOTER_HTML', "" );

define( 'WPE_CLUSTER_ID', '101327' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', false );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', TRUE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'ipu.ie', 1 => 'www.ipu.ie', 2 => 'iputest.wpengine.com', );

$wpe_varnish_servers=array ( 0 => 'pod-101327', );

$wpe_special_ips=array ( 0 => '35.197.246.117', );

$wpe_ec_servers=array ( );

$wpe_largefs=array ( );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( 'default' =>  array ( 0 => 'unix:///tmp/memcached.sock', ), );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings


define('WP_DEBUG', FALSE);
define('WP_DEBUG_LOG', true);

define( 'WPE_GOVERNOR', false );

define( 'WP_MEMORY_LIMIT', '512M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );

# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');



ini_set('display_errors', 0);
















