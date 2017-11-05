<?php

    $dbConf = array(
            'host'=>'127.0.0.1',  
            'user'=>'root',  
            'password'=>'5680weikun',//因为测试，我就不设置密码，实际开发中，必须建立新的用户并设置密码  
            'dbName'=>'my_schema',  
            'charSet'=>'utf8',  
            'port'=>'3306'  
            );
    //print_r($dbConf);  
    //打开  
    $conn = new mysqli($dbConf['host'],
        $dbConf['user'],
        $dbConf['password'],
        $dbConf['dbName'],
        $dbConf['port']
        );  
    //print_r($conn);
    if(!$conn){  
        die('数据库打开失败');  
    }  
    echo "lala";
    //获取参数
    $class_id = $_GET['class_id'];
    echo "lala";
    // echo $class_id;
    // exit();
    //执行增删改查  
    /*************数据查询***************************/  
    $sql = "SELECT * from `txl_user` where class_id = ".$class_id;  
    $rs=$conn->query($sql);//获取结果集  
    //var_dump($rs);

    $data = array();

    //通过fetch_assoc、fetch_array、fetch_row从结果集中获取数据  
    while ($tmp=$rs->fetch_assoc()) {  
        //var_dump($tmp);
        array_push($data, $tmp);
    }  
    /*************数据删除***************************/  
    //$sql='DELETE FROM `t1` WHERE `id1`=3';  
    //var_dump($data);
    $conn->close();  
