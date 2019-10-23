<?php

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = 500;

// getting information about members from old database
$username = "ipu_lightbox";
$password = "CieTh8sei5";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
  or die("Unable to connect to ipu_old MySQL");
echo "Connected to ipu_old MySQL<br>";

//select a database to work with
$selected = mysql_select_db("ipu_old",$dbhandle)
  or die("Could not select examples");

//execute the SQL query and return records
$pharResults = mysql_query("".
    "select jos_users.name as fullname, ".
        "jos_users.username as username, ".
        "jos_users.email as email, ".
        "jos_users.password as password, ".
        "jos_users.mobile as mobile, ".
        "jos_users.block as block, ".
        "jos_usergroups.title ".
    "from jos_users ".
    "join jos_user_usergroup_map ON jos_user_usergroup_map.user_id = jos_users.id ".
    "join jos_usergroups ON jos_user_usergroup_map.group_id = jos_usergroups.id ".
    "LIMIT ".($pageSize + 50)." OFFSET ".(($page - 1) * $pageSize).
"");

$users = array();

//fetch tha data from the database
while ($row = mysql_fetch_array($pharResults)) {
    $user = $row;
    
    if(!$user[$row['username']]) {
        $user['roles'] = array();
        $users[$row['username']] = $user;
    }
    
    array_push($users[$row['username']]['roles'], $row['title']);
}

if(count($users) <= 0) {
    die('finished on '.$page.' page');
}       

echo 'Total Users Found: '.count($users).'<br/>';

// var_dump($users);

//close the connection
mysql_close($dbhandle);

//Create user object for CSV
$userObj = new stdClass;

$file = fopen("file3.csv", "r");


//Loop through file and store csv information
while(!feof($file)) {
    $usersCSV[] = fgetcsv($file, 2048);
}

//Loop through csv information and push it onto DB array
foreach($users as $username => $pharUser) {
    for($i = 0; $i < count($usersCSV); $i++) {
        $bbb = new stdClass;
        $s = $usersCSV[$i];
        $bbb->password = $s[3];
        $bbb->name = $s[1];
        $bbb->last = $s[2];
        if(strtolower($username) == strtolower($s[0])) {
            $userObj->{strtolower($s[0])} = $bbb;
            break;
        }
    }
}

//CLose open file
fclose($file);

require_once('wp-load.php');

$generatedPasswords = array();
$createdCounter = 0;
$existingCounter = 0;
$notMembers = 0;

$passwords = '';


// lets go through each user and see if user created
foreach($users as $username => $pharUser) {
    // check if wp user does not exist, then create
    $user_id = username_exists( $username );
    if ( !$user_id && email_exists($pharUser['email']) === false ) {
        $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
        
        //if user object has password, use that
        if(isset($userObj->{strtolower($username)})) {
            $bbb = $userObj->{strtolower($username)};
            $random_password = $bbb->password;
        } else {
            $passwords .= $username.','.$random_password.'\n';
        }
        
        $user_id = wp_create_user( $username, $random_password, $pharUser['email'] );
        //echo $username.'-'.$random_password.'<br/>';
        
        $createdCounter++;
    } else {
        $existingCounter++;
    }
    
    $user_id = get_userdatabylogin($username);
    $user_id = $user_id->ID;
    
    // lets clear all the roles for the user
    $user = new WP_User($user_id);
    
    // identify user level
    $level = -1;
    $levelFound = -1;
    
    for($i = 0; $i < count($pharUser['roles']); $i++) {
        $roles = $pharUser['roles'];
        $role = $roles[$i];
        $role = strtolower($role);
        
        if(strpos($role, 'cep') !== false || strpos($role, 'cpg') !== false && $levelFound < 0) {
            $level = "subscriber";
            $levelFound = 0;
        }else if(strpos($role, 'cpp') !== false && $levelFound < 1) {
            $level = "s2member_level1";
            $levelFound = 1;
        } else if(strpos($role, 'ipu') !== false && $levelFound < 2) {
            $level = "s2member_level2";
            $levelFound = 2;
        } else if(strpos($role, 'admin') !== false && $levelFound < 3) {
            $level = "s2member_level4";
            $levelFound = 3;
        }  else if(strpos($role, 'author') !== false && $levelFound < 4) {
            $level = "author";
            $levelFound = 4;
        } else if(strpos($role, 'editor') !== false && $levelFound < 5) {
            $level = "editor";
            $levelFound = 5;
        } else if(strpos($role, 'administrator') !== false && $levelFound < 6) {
            $level = "administrator";
            $levelFound = 6;
        } 
    }
    
    if($level != -1) {
        $user->set_role($level);
        //echo 'level set for user: '.$username.' as '.$level.'<br/>';
    } else {
        //$user->set_role("");
        //echo 'not found'.'<br/>';
        $notMembers++;
    }
    
    // updating name of the user
    if(isset($userObj->{strtolower($username)})) {
        $bbb = $userObj->{strtolower($username)};
        wp_update_user( array ( 'ID' => $user_id, 'first_name' => $bbb->name, 'last_name' => $bbb->last ) );
    } else {
        wp_update_user( array ( 'ID' => $user_id, 'first_name' => $pharUser['fullname'] ) ); 
    }
    //wp_update_user($user);
}
    
echo 'Created: '.$createdCounter.'<br/>';
echo 'Exists: '.$existingCounter.'<br/>';
echo 'No Members: '.$notMembers.'<br/>';

file_put_contents('import-members/_file_'.$page.'.csv', $passwords);

//header('Location: member_import.php?page='.($page+1));