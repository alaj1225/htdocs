    <?php
    $output = array();
    $a = @$_GET['a'] ? $_GET['a'] : '';
    $uid = @$_GET['uid'] ? $_GET['uid'] : 0;
    if (empty($a)) {
        $output = array('data'=>NULL, 'info'=>'�|�R��!', 'code'=>-201);
        exit(json_encode($output));
    }
    //�����f
    if ($a == 'get_users') {
        //�ˬd��?
        if ($uid == 0) {
            $output = array('data'=>NULL, 'info'=>'The uid is null!', 'code'=>-401);
            exit(json_encode($output));
        }
        //���] $mysql �O�ƾڮw
        $mysql = array(
            10001 => array(
                'uid'=>10001,
                'vip'=>5,
                'nickname' => 'Shine X',
                'email'=>'979137@qq.com',
                'qq'=>979137,
                'gold'=>1500,
                'powerplay'=> array('2xp'=>12,'gem'=>12,'bingo'=>5,'keys'=>5,'chest'=>8),
                'gems'=> array('red'=>13,'green'=>3,'blue'=>8,'yellow'=>17),
                'ctime'=>1376523234,
                'lastLogin'=>1377123144,
                'level'=>19,
                'exp'=>16758,
            ),
            10002 => array(
                'uid'=>10002,
                'vip'=>50,
                'nickname' => 'elva',
                'email'=>'elva@ezhi.net',
                'qq'=>NULL,
                'gold'=>14320,
                'powerplay'=> array('2xp'=>1,'gem'=>120,'bingo'=>51,'keys'=>5,'chest'=>8),
                'gems'=> array('red'=>13,'green'=>3,'blue'=>8,'yellow'=>17),
                'ctime'=>1376523234,
                'lastLogin'=>1377123144,
                'level'=>112,
                'exp'=>167588,
            ),
            10003 => array(
                'uid' => 10003,
                'vip' => 5,
                'nickname' => 'Lily',
                'email' => 'Lily@ezhi.net',
                'qq' => NULL,
                'gold' => 1541,
                'powerplay'=> array('2xp'=>2,'gem'=>112,'bingo'=>4,'keys'=>7,'chest'=>8),
                'gems' => array('red'=>13,'green'=>3,'blue'=>9,'yellow'=>7),
                'ctime' => 1376523234,
                'lastLogin'=> 1377123144,
                'level' => 10,
                'exp' => 1758,
            ),
             10004 => array(
                'uid' => 10003,
            ),
        );
        
        $uidArr = array(10001,10002,10003);
        if (in_array($uid, $uidArr, true)) {
            $output = array('data' => NULL, 'info'=>'The user does not exist!', 'code' => -402);
            exit(json_encode($output));
        }
        //�d�߼ƾڮw
        $userInfo = $mysql[$uid];
        
        //��X�ƾ�
        $output = array(
            'data' => array(
                'userInfo' => $userInfo,
                'isLogin' => true,//�O�_�����n��
                'unread' => 4,//��Ū�����ƶq
                'untask' => 3,//����������
            ), 
            'info' => 'Here is the message which, commonly used in popup window', //�������ܡA��?�ݱ`�|�Φ��@�����u���H���C
            'code' => 200, //���\�P���Ѫ��N�X�A�@�볣�O���ƩΪ̭t��
        );
        exit(json_encode($output));
    } elseif ($a == 'get_games_result') {
        //...
        die('�z���b�� get_games_result ���f!');
    } elseif ($a == 'upload_avatars') {
        //....
        die('�z���b�� upload_avatars ���f!');
    }