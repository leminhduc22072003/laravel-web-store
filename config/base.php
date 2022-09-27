<?php

/* --- System group user */
if (!defined('GROUP_ADMIN')) {define('GROUP_ADMIN', 1);}
if (!defined('GROUP_WRITER')) {define('GROUP_WRITER', 2);}

/* --- System active */
if (!defined('ACTIVE_TRUE')) {define('ACTIVE_TRUE', 1);}
if (!defined('ACTIVE_FALSE')) {define('ACTIVE_FALSE', 0);}
if (!defined('EMAIL_TEMPLATE_FORGOT_PASSWORD')) {define('EMAIL_TEMPLATE_FORGOT_PASSWORD', 1);}



if (!defined('SESSION_EXPIRED')) {define('SESSION_EXPIRED', 180);} // Expired in 30 minutes

return [
    'type_of_school' => [
        1 => 'Mầm non',
        2 => 'Tiểu học',
        3 => 'THCS',
        4 => 'THPT',
        5 => 'Tiểu học/ THCS',
        6 => 'THCS/ THPT',
        7 => 'Giáo dục thường xuyên',
    ],

    'type_of_teacher' => [
        1 => 'Giáo viên',
        2 => 'Giáo viên nhà trẻ',
        3 => 'Giáo viên mẫu giáo',
        4 => 'Giáo viên tiểu học',
        5 => 'Giáo viên thcs',
    ],

    'level_of_teacher' => [
        1 => 'Trung cấp',
        2 => 'Cao đẳng',
        3 => 'Đại học',
        4 => 'Thạc sĩ',
        5 => 'Tiến sĩ',
    ],

    'gender' => [
        1 => 'Nam',
        2 => 'Nữ',
    ],
    'level_of_user' => [
        1 => 'Admin',
        2 => 'Người viết',
        3 => 'Khách',
    ],
    'active' => [
        1 => 'Có',
        2 => 'Không',
    ],

    'level_of_student'  => [
        1 => 'Nhóm 3 - 12 tháng',
        2 => 'Nhóm 13 - 24 tháng',
        3 => 'Nhóm 25 - 36 tháng',
        4 => 'Lớp ghép nhà trẻ',
        5 => 'Mẫu giáo 3 - 4 tuổi',
        6 => 'Mẫu giáo 4 - 5 tuổi',
        7 => 'Mẫu giáo 5 - 6 tuổi',
        8 => 'Lớp ghép Mẫu giáo',
        10 => 'Lớp 1',
        11 => 'Lớp 2',
        12 => 'Lớp 3',
        13 => 'Lớp 4',
        14 => 'Lớp 5',
        15 => 'Lớp 6',
        16 => 'Lớp 7',
        17 => 'Lớp 8',
        18 => 'Lớp 9',
        19 => 'Lớp 10',
        20 => 'Lớp 11',
        21 => 'Lớp 12',
        22 => 'Nghề 8',
        23 => 'Nghề 11',
        24 => 'Học viên cc tin học A, B, C',
        25 => 'Học viên cc ngoại ngữ A, B, C',
        26 => 'Học sinh xmc',
        27 => 'Học sinh gdttskbc',
    ],

    'type_of_student' => [
        1 => 'Xuất xắc',
        2 => 'Giỏi',
        3 => 'Khá',
        4 => 'Trung Bình',
        5 => 'Yếu/ kém',
    ],
];

