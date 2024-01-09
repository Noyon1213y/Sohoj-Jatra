<?php  
// Place db host name
$db_host = "localhost"; 

// Place the username for the MySQL database here 
$db_username = "root";
  
// Place the password for the MySQL database here 
$db_pass = "";  

// Place the name for the MySQL database here 
$db_name = "sohojjatra"; 
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    
    //get search term
    $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    $query = $db->query("SELECT * FROM bus_add_info_tb WHERE bond_no LIKE '$searchTerm%' order by id DESC limit 3");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['bond_no'];
    }  

    //return json data
    echo json_encode($data);
?>