<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// If need have to Use LIB file
//use Illuminate\Support\Str;
//use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Route as RH;

if (!function_exists('myfunc')) {

    function myfunc() {
        return 'Hello';
    }

}

if (!function_exists('get_salary_grade_assign')) {

    function get_salary_grade_assign($grade_id = null) {
        $grades = DB::table('payroll_grade_assigns')->get();
        return $grades;
    }
}


if (!function_exists('get_topic_detail')) {

    function get_topic_detail($topic_id = null) {
        $topics = DB::table('lp_topic_details')->where('topic_id', $topic_id)->get();
        return $topics;
    }

}
// LIST = 1, ADD = 2, EDIT = 3, VIEW = 4, DELETE = 5
// Super Admin = 1, Admin = 2, Guardian = 3, Student = 4, Teacher = 5 ...

if (!function_exists('check_permission')) {

    function check_permission($action) {

        $role_id = session('role_id');
        if (!$role_id) {
            abort(redirect('dashboard')->with('error', 'Access denied. You have no permission.'));
        }

        $method_name = RH::getCurrentRoute()->getActionMethod(); // add/edit/save etc
        $prefix_module = RH::getCurrentRoute()->getPrefix();  // /academic

        $str = Route::getCurrentRoute()->getActionName(); // App\Http\Controllers\Academic\ClassesController@index
        $str_arr = explode("\\", $str);
        $cont = end($str_arr); // ClassesController@index
        $cont_arr = explode("@", $cont);
        $controller = strtolower(substr(reset($cont_arr), 0, 7)); // classes

        $param = ltrim($prefix_module, '/') . '|' . $controller . '|' . $role_id;
        $result = config('permission.' . $param);

        if (!empty($result)) {
            $array = explode('|', $result);
            if (!$array[($action - 1)]) {
                abort(redirect('dashboard')->with('error', 'Access denied. You have no permission.'));
            }
        } else {
            abort(redirect('dashboard')->with('error', 'Access denied. You have no permission.'));
        }

        return TRUE;
    }

}


if (!function_exists('get_operation_by_module')) {

    function get_operation_by_module($module_id) {
        
        $operations = DB::table('operations')->where('module_id', $module_id)->get();
        return $operations;       
    }
}


if (!function_exists('get_privilege_by_operation')) {

    function get_privilege_by_operation($role_id, $operation_id) {        
        
        $privilege = DB::table('privileges')
                ->where('role_id', $role_id)
                ->where('operation_id', $operation_id)
                ->first();
        return $privilege;      
        
    }
}

if (!function_exists('get_teacher_rating')) {

    function get_teacher_rating($techer_id) {
                
        $rating = DB::table('teacher_ratings AS R')
                ->join('students AS S', 'S.id','=', 'R.student_id')
                ->where('R.teacher_id', $techer_id)                
                ->where('R.student_id', Session::get('student_id')) 
                ->where('R.class_id', Session::get('class_id'))
                ->where('R.section_id', Session::get('section_id'))
                ->where('R.academic_year_id', Session::get('academic_year_id'))
                ->first();        
      
        return $rating;
    }
}

if (!function_exists('get_routines_by_day')) {

    function get_routines_by_day($day, $class_id = null, $section_id = null) {
        
        $routines = DB::table('routines AS R')
                    ->join('subjects AS S', 'S.id','=', 'R.subject_id')
                    ->join('teachers AS T', 'T.id','=', 'R.teacher_id')
                    ->join('classes AS C', 'C.id','=', 'R.class_id')
                    ->join('sections AS SC', 'C.id','=', 'SC.class_id')
                    ->select('R.*', 'S.name AS subject', 'T.name AS teacher', 'C.name AS class_name')
                    ->where('R.day', $day)
                  //if  ->where('R.teacher_id', Session::get('teacher_id'))
                   //else
                    ->where('R.class_id', $class_id)
                    ->where('R.section_id', $section_id) 
                    ->orderBy('R.id', 'Asc')
                    ->get();
        return $routines;
    }

}

if (!function_exists('get_slug')) {

    function get_slug($slug) {
        if (!$slug) {
            return;
        }

        $char = array("!", "â€™", "'", ":", ",", "_", "`", "~", "@", "#", "$", "%", "^", "&", "*", "(", ")", "+", "=", "{", "}", "[", "]", "/", ";", '"', '<', '>', '?', "'\'",);
        $slug = str_replace($char, "", $slug);
        return strtolower(str_replace(' ', "-", $slug));
    }

}


if (!function_exists('get_card_bottom_text_align')) {

    function get_card_bottom_text_align() {

        $text_align = array();
        $text_align['center'] = 'center';
        $text_align['left'] = 'left';
        $text_align['right'] = 'right';

        return $text_align;
    }

}

if (!function_exists('get_mail_protocol')) {

    function get_mail_protocol() {

        $protocol = array();
        $protocol['mail'] = 'mail';
        $protocol['sendmail'] = 'sendmail';
        $protocol['smtp'] = 'smtp';

        return $protocol;
    }

}

if (!function_exists('get_week_days')) {

    function get_week_days() {
        return array(  
            'sunday' => 'sunday',
            'monday' => 'monday',
            'tuesday' => 'tuesday',
            'wednesday' => 'wednesday',
            'thursday' => 'thursday',
            'friday' => 'friday',
            'saturday' => 'saturday'
        );
    }

}

if (!function_exists('get_smtp_crypto')) {

    function get_smtp_crypto() {

        $smtp_crypto = array();
        $smtp_crypto['tls'] = 'tls';
        $smtp_crypto['ssl'] = 'ssl';

        return $smtp_crypto;
    }

}

if (!function_exists('get_video_types')) {

    function get_video_types() {
        return array(
            'youtube' => 'Youtube',
            'vimeo' => 'Vimeo',
            'ppt' => 'Power Point'
        );
    }

}


if (!function_exists('get_char_set')) {

    function get_char_set() {

        $char_set = array();
        $char_set['utf-8'] = 'utf-8';
        $char_set['iso-8859-1'] = 'iso-8859-1';

        return $char_set;
    }

}

if (!function_exists('get_paid_status')) {

    function get_paid_status($status) {
        $data = array(
            'paid' => 'Paid',
            'unpaid' => 'Unpaid',
            'partial' => 'Partial'
        );
        return $data[$status];
    }

}

if (!function_exists('get_mail_types')) {

    function get_mail_types() {

        $mail_types = array();
        $mail_types['html'] = 'HTML';
        $mail_types['text'] = 'Text';

        return $mail_types;
    }

}

if (!function_exists('get_subject_type')) {

    function get_subject_type() {

        $data = array();
        $data['theory'] = 'Theory';
        $data['practical'] = 'Practical';
        $data['manadatory'] = 'Manadatory';
        $data['optional'] = 'Optional';

        return $data;
    }

}

if (!function_exists('get_genders')) {

    function get_genders() {
        return array(
            'male' => 'Male',
            'female' => 'Female'
        );
    }

}

if (!function_exists('get_blood_group')) {

    function get_blood_group() {

        return array(
            'A Positive' => 'A Positive',
            'A Negative' => 'A Negative',
            'B Positive' => 'B Positive',
            'B Negative' => 'B Negative',
            'O Positive' => 'O Positive',
            'O Negative' => 'O Negative',
            'AB Positive' => 'AB Positive',
            'AB Negative' => 'AB Negative'
        );
    }

}

if (!function_exists('get_live_class_status')) {

    function get_live_class_status() {
        return array(
            'waiting' => 'Waiting',
            'cancelled' => 'Cancelled',
            'completed' => 'Completed',
        );
    }

}

if (!function_exists('get_live_class_types')) {

    function get_live_class_types() {
        return array(
            'zoom' => 'Zoom Meet',
            'jitsi' => 'Jitsi Meet',
            'google' => 'Google Meet'
        );
    }

}

if (!function_exists('get_days')) {

    function get_days() {
        return array(
            'sat' => 'Sat',
            'sun' => 'Sun',
            'mon' => 'Mon',
            'tue' => 'Tue',
            'wed' => 'Wed',
            'thu' => 'Thu',
            'fri' => 'Fri'
        );
    }

}

if (!function_exists('get_unit_types')) {

    function get_unit_types() {
        return array(
            'unit' => 'Unit',
            'kg' => 'Kg',
            'piece' => 'Piece',
            'other' => 'Other'
        );
    }

}

if (!function_exists('get_date_formats')) {

    function get_date_formats() {

        $date = array();
        $date['Y-m-d'] = '2001-03-15';
        $date['d-m-Y'] = '15-03-2018';
        $date['d/m/Y'] = '15/03/2018';
        $date['m/d/Y'] = '03/15/2018';
        $date['m.d.Y'] = '03.10.2018';
        $date['j, n, Y'] = '14, 7, 2018';
        $date['F j, Y'] = 'July 15, 2018';
        $date['M j, Y'] = 'Jul 13, 2018';
        $date['j M, Y'] = '13 Jul, 2018';

        return $date;
    }

}

if (!function_exists('get_formatted_certificate_text')) {

    function get_formatted_certificate_text($body, $role_id, $user_id) {

        $tags = get_template_tags($role_id);
        $user = get_user_by_role($role_id, $user_id);
              
        $arr = array('[', ']');
        foreach ($tags as $tag) {
            $field = str_replace($arr, '', $tag);
            
            if($field == 'created_at'){                
                $body = str_replace($tag, '<span>'.date('M-d-Y', strtotime($user->created_at)).'</span>', $body);                
            }else{
                $body = str_replace($tag, '<span>'.$user->{$field}.'</span>', $body);
            }            
        }

        return $body;
    }
}

if (!function_exists('get_template_tags')) {

    function get_template_tags($role_id) {
        $tags = array();
        $tags[] = '[name]';
        $tags[] = '[email]';
        $tags[] = '[phone]';
        //SUPER_ADMIN        
        if($role_id == 1){
            
            $tags[] = '[designation]';
            $tags[] = '[gender]';
            $tags[] = '[blood_group]';
            $tags[] = '[religion]';
            $tags[] = '[dob]';            
        }elseif ($role_id == STUDENT) {

            $tags[] = '[class_name]';
            $tags[] = '[section]';
            $tags[] = '[roll_no]';
            $tags[] = '[dob]';
            $tags[] = '[gender]';
            $tags[] = '[religion]';
            $tags[] = '[blood_group]';
            $tags[] = '[registration_no]';
            $tags[] = '[group]';
            $tags[] = '[created_at]';
            $tags[] = '[guardian]';
            
        } else if ($role_id == GUARDIAN) {
            $tags[] = '[profession]';
        } else if ($role_id == TEACHER) {
            $tags[] = '[department]';
            $tags[] = '[gender]';
            $tags[] = '[blood_group]';
            $tags[] = '[religion]';
            $tags[] = '[dob]';
            $tags[] = '[joining_date]';
        } else {
            $tags[] = '[designation]';
            $tags[] = '[gender]';
            $tags[] = '[blood_group]';
            $tags[] = '[religion]';
            $tags[] = '[dob]';
            $tags[] = '[joining_date]';
        }

        $tags[] = '[present_address]';
        $tags[] = '[permanent_address]';

        return $tags;
    }

}

if (!function_exists('get_student_attendance')) {

    function get_student_attendance($student_id, $academic_year_id, $class_id, $section_id, $year, $month, $day) {
       
        $field = 'day_' . abs($day);
        
        $attendance = DB::table('student_attendances AS SA')
                    ->select('SA.' . $field)
                    ->where('SA.student_id', $student_id)
                    ->where('SA.academic_year_id', $academic_year_id)
                    ->where('SA.class_id', $class_id)
                    ->when($section_id, function($query, $section_id){
                        if($section_id){
                            return $query->where('SA.section_id', $section_id);
                        } 
                    })
                    ->where('SA.year', $year)
                    ->where('SA.month', $month)
                    ->first()->$field;
        return $attendance;
    }
}

if (!function_exists('get_user_by_role')) {

    function get_user_by_role($role_id = null, $user_id = null, $academic_year_id = null) {

        if ($role_id == SUPER_ADMIN) {
            
            $users = DB::table('system_admin AS SA')
                    ->join('users AS U', 'U.id', '=', 'A.user_id')
                    ->select('SA.*', 'U.username','U.role_id')
                    ->where('SA.user_id', $user_id)
                    ->get();
            return $users;

        } elseif ($role_id == STUDENT) {

            $users = DB::table('enrollments AS E')
                    ->join('students AS S', 'S.id', '=', 'E.student_id')
                    ->join('guardians AS G', 'G.id', '=', 'S.guardian_id')
                    ->join('users AS U', 'U.id', '=', 'S.user_id')
                    ->join('roles AS R', 'R.id', '=', 'U.role_id')
                    ->join('classes AS C', 'C.id', '=', 'E.class_id')
                    ->join('sections AS SE', 'SE.id', '=', 'E.section_id')
                    ->join('discounts AS D', 'D.id', '=', 'S.discount_id')
                    ->join('student_types AS ST', 'ST.id', '=', 'S.type_id')
                    ->select('S.*', 'ST.type', 'G.name AS guardian', 'E.roll_no', 'E.section_id', 'E.class_id', 'U.role_id', 'U.usernam', 'R.name AS role', 'C.name AS class_name', 'SE.name AS section', 'D.title AS discount', 'D.amount')
                    ->where('S.user_id', $user_id)
                    ->when($academic_year_id, function($query, $academic_year_id){
                        if($academic_year_id){
                            return $query->where('E.academic_year_id', $academic_year_id);
                        } 
                    })
                    ->get();
            return $users;
            
        } elseif ($role_id == TEACHER) {
            
            $users = DB::table('teachers AS T')
                    ->join('users AS U', 'U.id', '=', 'T.user_id')
                    ->join('roles AS R', 'R.id', '=', 'U.role_id')
                    ->join('departments AS D', 'D.id', '=', 'T.department_id')
                    ->join('salary_grades AS SG', 'SG.id', '=', 'T.salary_grade_id')
                    ->select('T.*', 'D.title AS department', 'U.role_id', 'U.username', 'R.name AS role', 'SG.grade_name')
                    ->where('T.user_id', $user_id)
                    ->get();
            return $users;
            
        } elseif ($role_id == GUARDIAN) {
            
            $users = DB::table('guardians AS G')
                    ->join('users AS U', 'U.id', '=', 'G.user_id')
                    ->join('roles AS R', 'R.id', '=', 'U.role_id')
                    ->select('G.*', 'U.role_id', 'U.username', 'R.name AS role')
                    ->where('G.user_id', $user_id)
                    ->get();
            return $users;
                
        } else {
            
            $users = DB::table('employees AS E')
                    ->join('users AS U', 'U.id', '=', 'E.user_id')
                    ->join('roles AS R', 'R.id', '=', 'U.role_id')
                    ->join('designations AS D', 'D.id', '=', 'E.designation_id')
                    ->join('salary_grades AS SG', 'SG.id', '=', 'E.salary_grade_id')
                    ->select('E.*', 'U.role_id', 'U.username', 'R.name AS role', 'D.name AS designation', 'SG.grade_name')
                    ->where('E.user_id', $user_id)
                    ->get();
            return $users;
        }
    }
}

//=======
if (!function_exists('get_languages')) {

    function get_languages() {

        $langauges = Schema::getColumnListing('languages');

        $data = array();
        if ($langauges) {
            foreach ($langauges as $key => $value) {
                if (in_array($value, array('id', 'label', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'))) {
                    continue;
                }
                $arr = explode('_', $value);
                $data[$arr[1]] = $arr[0];
            }
        }
        return $data;
    }

}

if (!function_exists('get_themes')) {

    function get_themes() {

        $results = DB::table('themes AS T')
                ->where('T.status', '=', 1)
                ->get();

        return $results;
    }

}


if (!function_exists('get_academic_years')) {

    function get_academic_years() {

        $results = DB::table('academic_years AS AY')
                ->where('AY.status', '=', 1)
                ->get();

        return $results;
    }

}


if (!function_exists('check_language')) {

    function check_language($lang, $flag = false) {
        $langs = array();
        $langs['english'] = 'english_en';
        $langs['bengali'] = 'bengali_bn';
        $langs['spanish'] = 'spanish_es';
        $langs['arabic'] = 'arabic_ar';
        $langs['hindi'] = 'hindi_hi';
        $langs['urdu'] = 'urdu_ur';
        $langs['japanese'] = 'japanese_ja';
        $langs['portuguese'] = 'portuguese_pt';
        $langs['french'] = 'french_fr';
        $langs['korean'] = 'korean_ko';
        $langs['german'] = 'german_de';
        $langs['italian'] = 'italian_it';
        $langs['hungarian'] = 'hungarian_hu';
        $langs['dutch'] = 'dutch_nl';
        $langs['latin'] = 'latin_la';
        $langs['indonesian'] = 'indonesian_id';
        $langs['turkish'] = 'turkish_tr';
        $langs['greek'] = 'greek_el';
        $langs['persian'] = 'persian_fa';
        $langs['malay'] = 'malay_ms';
        $langs['polish'] = 'polish_pl';
        $langs['ukrainian'] = 'ukrainian_uk';
        $langs['romanian'] = 'romanian_ro';

        if ($flag && isset($langs[$lang])) {
            return $langs[$lang];
        } else {
            if (isset($langs[$lang]) && !empty($langs[$lang])) {
                return true;
            } else {
                return FALSE;
            }
        }
    }

}



if (!function_exists('get_timezones')) {

    function get_timezones() {
        $timezones = array(
            'Pacific/Midway' => "(GMT-11:00) Midway Island",
            'US/Samoa' => "(GMT-11:00) Samoa",
            'US/Hawaii' => "(GMT-10:00) Hawaii",
            'US/Alaska' => "(GMT-09:00) Alaska",
            'US/Pacific' => "(GMT-08:00) Pacific Time (US &amp; Canada)",
            'America/Tijuana' => "(GMT-08:00) Tijuana",
            'US/Arizona' => "(GMT-07:00) Arizona",
            'US/Mountain' => "(GMT-07:00) Mountain Time (US &amp; Canada)",
            'America/Chihuahua' => "(GMT-07:00) Chihuahua",
            'America/Mazatlan' => "(GMT-07:00) Mazatlan",
            'America/Mexico_City' => "(GMT-06:00) Mexico City",
            'America/Monterrey' => "(GMT-06:00) Monterrey",
            'Canada/Saskatchewan' => "(GMT-06:00) Saskatchewan",
            'US/Central' => "(GMT-06:00) Central Time (US &amp; Canada)",
            'US/Eastern' => "(GMT-05:00) Eastern Time (US &amp; Canada)",
            'US/East-Indiana' => "(GMT-05:00) Indiana (East)",
            'America/Bogota' => "(GMT-05:00) Bogota",
            'America/Lima' => "(GMT-05:00) Lima",
            'America/Caracas' => "(GMT-04:30) Caracas",
            'Canada/Atlantic' => "(GMT-04:00) Atlantic Time (Canada)",
            'America/La_Paz' => "(GMT-04:00) La Paz",
            'America/Santiago' => "(GMT-04:00) Santiago",
            'Canada/Newfoundland' => "(GMT-03:30) Newfoundland",
            'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
            'Greenland' => "(GMT-03:00) Greenland",
            'Atlantic/Stanley' => "(GMT-02:00) Stanley",
            'Atlantic/Azores' => "(GMT-01:00) Azores",
            'Atlantic/Cape_Verde' => "(GMT-01:00) Cape Verde Is.",
            'Africa/Casablanca' => "(GMT) Casablanca",
            'Europe/Dublin' => "(GMT) Dublin",
            'Europe/Lisbon' => "(GMT) Lisbon",
            'Europe/London' => "(GMT) London",
            'Africa/Monrovia' => "(GMT) Monrovia",
            'Europe/Amsterdam' => "(GMT+01:00) Amsterdam",
            'Europe/Belgrade' => "(GMT+01:00) Belgrade",
            'Europe/Berlin' => "(GMT+01:00) Berlin",
            'Europe/Bratislava' => "(GMT+01:00) Bratislava",
            'Europe/Brussels' => "(GMT+01:00) Brussels",
            'Europe/Budapest' => "(GMT+01:00) Budapest",
            'Europe/Copenhagen' => "(GMT+01:00) Copenhagen",
            'Europe/Ljubljana' => "(GMT+01:00) Ljubljana",
            'Europe/Madrid' => "(GMT+01:00) Madrid",
            'Europe/Paris' => "(GMT+01:00) Paris",
            'Europe/Prague' => "(GMT+01:00) Prague",
            'Europe/Rome' => "(GMT+01:00) Rome",
            'Europe/Sarajevo' => "(GMT+01:00) Sarajevo",
            'Europe/Skopje' => "(GMT+01:00) Skopje",
            'Europe/Stockholm' => "(GMT+01:00) Stockholm",
            'Europe/Vienna' => "(GMT+01:00) Vienna",
            'Europe/Warsaw' => "(GMT+01:00) Warsaw",
            'Europe/Zagreb' => "(GMT+01:00) Zagreb",
            'Europe/Athens' => "(GMT+02:00) Athens",
            'Europe/Bucharest' => "(GMT+02:00) Bucharest",
            'Africa/Cairo' => "(GMT+02:00) Cairo",
            'Africa/Harare' => "(GMT+02:00) Harare",
            'Europe/Helsinki' => "(GMT+02:00) Helsinki",
            'Europe/Istanbul' => "(GMT+02:00) Istanbul",
            'Asia/Jerusalem' => "(GMT+02:00) Jerusalem",
            'Europe/Kiev' => "(GMT+02:00) Kyiv",
            'Europe/Minsk' => "(GMT+02:00) Minsk",
            'Europe/Riga' => "(GMT+02:00) Riga",
            'Europe/Sofia' => "(GMT+02:00) Sofia",
            'Europe/Tallinn' => "(GMT+02:00) Tallinn",
            'Europe/Vilnius' => "(GMT+02:00) Vilnius",
            'Asia/Baghdad' => "(GMT+03:00) Baghdad",
            'Asia/Kuwait' => "(GMT+03:00) Kuwait",
            'Africa/Nairobi' => "(GMT+03:00) Nairobi",
            'Asia/Riyadh' => "(GMT+03:00) Riyadh",
            'Asia/Tehran' => "(GMT+03:30) Tehran",
            'Europe/Moscow' => "(GMT+04:00) Moscow",
            'Asia/Baku' => "(GMT+04:00) Baku",
            'Europe/Volgograd' => "(GMT+04:00) Volgograd",
            'Asia/Muscat' => "(GMT+04:00) Muscat",
            'Asia/Tbilisi' => "(GMT+04:00) Tbilisi",
            'Asia/Yerevan' => "(GMT+04:00) Yerevan",
            'Asia/Kabul' => "(GMT+04:30) Kabul",
            'Asia/Karachi' => "(GMT+05:00) Karachi",
            'Asia/Tashkent' => "(GMT+05:00) Tashkent",
            'Asia/Kolkata' => "(GMT+05:30) Kolkata",
            'Asia/Kathmandu' => "(GMT+05:45) Kathmandu",
            'Asia/Yekaterinburg' => "(GMT+06:00) Ekaterinburg",
            'Asia/Almaty' => "(GMT+06:00) Almaty",
            'Asia/Dhaka' => "(GMT+06:00) Dhaka",
            'Asia/Novosibirsk' => "(GMT+07:00) Novosibirsk",
            'Asia/Bangkok' => "(GMT+07:00) Bangkok",
            'Asia/Jakarta' => "(GMT+07:00) Jakarta",
            'Asia/Krasnoyarsk' => "(GMT+08:00) Krasnoyarsk",
            'Asia/Chongqing' => "(GMT+08:00) Chongqing",
            'Asia/Hong_Kong' => "(GMT+08:00) Hong Kong",
            'Asia/Kuala_Lumpur' => "(GMT+08:00) Kuala Lumpur",
            'Australia/Perth' => "(GMT+08:00) Perth",
            'Asia/Singapore' => "(GMT+08:00) Singapore",
            'Asia/Taipei' => "(GMT+08:00) Taipei",
            'Asia/Ulaanbaatar' => "(GMT+08:00) Ulaan Bataar",
            'Asia/Urumqi' => "(GMT+08:00) Urumqi",
            'Asia/Irkutsk' => "(GMT+09:00) Irkutsk",
            'Asia/Seoul' => "(GMT+09:00) Seoul",
            'Asia/Tokyo' => "(GMT+09:00) Tokyo",
            'Australia/Adelaide' => "(GMT+09:30) Adelaide",
            'Australia/Darwin' => "(GMT+09:30) Darwin",
            'Asia/Yakutsk' => "(GMT+10:00) Yakutsk",
            'Australia/Brisbane' => "(GMT+10:00) Brisbane",
            'Australia/Canberra' => "(GMT+10:00) Canberra",
            'Pacific/Guam' => "(GMT+10:00) Guam",
            'Australia/Hobart' => "(GMT+10:00) Hobart",
            'Australia/Melbourne' => "(GMT+10:00) Melbourne",
            'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
            'Australia/Sydney' => "(GMT+10:00) Sydney",
            'Asia/Vladivostok' => "(GMT+11:00) Vladivostok",
            'Asia/Magadan' => "(GMT+12:00) Magadan",
            'Pacific/Auckland' => "(GMT+12:00) Auckland",
            'Pacific/Fiji' => "(GMT+12:00) Fiji",
        );

        return $timezones;
    }

}

if (!function_exists('get_payment_methods')) {

    function get_payment_methods() {
        return array(
            'paypal' => 'Paypal',
            'stripe' => 'Stripe',
            'ccavenue' => 'Ccavenue',
            'payumoney' => 'Payumoney',
            'paytm' => 'Paytm',
            'paystack' => 'Paystack',
            'dbbl' => 'DBBL'
        );
    }

}

if (!function_exists('get_payment_methods2')) {

    function get_payment_methods2() {

        //$db = \Config\Database::connect();

        $methods = array('cash' => 'cash', 'cheque' => 'cheque', 'receipt' => 'bank_receipt');

        $data = $db->table('payment_settings AS PS ')
                        ->select('PS.* ')
                        ->get()->getRow();

        if ($data->paypal_status) {
            $methods['paypal'] = 'paypal';
        }
        /*
          if ($data->stripe_status) {
          $methods['stripe'] = lang('Label.stripe');
          }
          if ($data->ccavenue_status) {
          $methods['ccavenue'] = lang('Label.ccavenue');
          } */
        if ($data->payumoney_status) {
            $methods['payumoney'] = 'payumoney';
        }
        if ($data->paytm_status) {
            $methods['paytm'] = 'paytm';
        }
        if ($data->stack_status) {
            $methods['paystack'] = 'pay_stack';
        }

        if ($data->dbbl_status) {
            $methods['dbbl'] = 'dbbl';
        }

        return $methods;
    }

}

if (!function_exists('get_formatted_certificate_text')) {

    function get_formatted_certificate_text($body, $role_id, $user_id) {

        $tags = get_template_tags($role_id);
        $user = get_user_by_role($role_id, $user_id);
              
        $arr = array('[', ']');
        foreach ($tags as $tag) {
            $field = str_replace($arr, '', $tag);
            
            if($field == 'created_at'){                
                $body = str_replace($tag, '<span>'.date('M-d-Y', strtotime($user->created_at)).'</span>', $body);                
            }else{
                $body = str_replace($tag, '<span>'.$user->{$field}.'</span>', $body);
            }            
        }

        return $body;
    }
}

if (!function_exists('get_template_tags')) {

    function get_template_tags($role_id) {
        $tags = array();
        $tags[] = '[name]';
        $tags[] = '[email]';
        $tags[] = '[phone]';

        if($role_id == SUPER_ADMIN){
            
            $tags[] = '[designation]';
            $tags[] = '[gender]';
            $tags[] = '[blood_group]';
            $tags[] = '[religion]';
            $tags[] = '[dob]';            
        }elseif ($role_id == STUDENT) {

            $tags[] = '[class_name]';
            $tags[] = '[section]';
            $tags[] = '[roll_no]';
            $tags[] = '[dob]';
            $tags[] = '[gender]';
            $tags[] = '[religion]';
            $tags[] = '[blood_group]';
            $tags[] = '[registration_no]';
            $tags[] = '[group]';
            $tags[] = '[created_at]';
            $tags[] = '[guardian]';
            
        } else if ($role_id == GUARDIAN) {
            $tags[] = '[profession]';
        } else if ($role_id == TEACHER) {
            $tags[] = '[department]';
            $tags[] = '[gender]';
            $tags[] = '[blood_group]';
            $tags[] = '[religion]';
            $tags[] = '[dob]';
            $tags[] = '[joining_date]';
        } else {
            $tags[] = '[designation]';
            $tags[] = '[gender]';
            $tags[] = '[blood_group]';
            $tags[] = '[religion]';
            $tags[] = '[dob]';
            $tags[] = '[joining_date]';
        }

        $tags[] = '[present_address]';
        $tags[] = '[permanent_address]';

        return $tags;
    }

}

if (!function_exists('get_user_by_role')) {

    function get_user_by_role($role_id, $user_id, $academic_year_id = null) {

        $ci = & get_instance();

        if ($role_id == SUPER_ADMIN) {
            
            $ci->db->select('SA.*, U.username, U.role_id');
            $ci->db->from('system_admin AS SA');
            $ci->db->join('users AS U', 'U.id = SA.user_id', 'left');
            $ci->db->where('SA.user_id', $user_id);
            return $ci->db->get()->row();

        }elseif ($role_id == STUDENT) {

            $ci->db->select('S.*, ST.type, G.name AS guardian, E.roll_no, E.section_id, E.class_id, U.role_id, U.username, R.name AS role, C.name AS class_name, SE.name AS section, D.title AS discount, D.amount');
            $ci->db->from('enrollments AS E');
            $ci->db->join('students AS S', 'S.id = E.student_id', 'left');
            $ci->db->join('guardians AS G', 'G.id = S.guardian_id', 'left');
            $ci->db->join('users AS U', 'U.id = S.user_id', 'left');
            $ci->db->join('roles AS R', 'R.id = U.role_id', 'left');
            $ci->db->join('classes AS C', 'C.id = E.class_id', 'left');
            $ci->db->join('sections AS SE', 'SE.id = E.section_id', 'left');
            $ci->db->join('discounts AS D', 'D.id = S.discount_id', 'left');
            $ci->db->join('student_types AS ST', 'ST.id = S.type_id', 'left');
            if($academic_year_id){
                $ci->db->where('E.academic_year_id', $academic_year_id);
            }
            $ci->db->where('S.user_id', $user_id);
            
            return $ci->db->get()->row();
            
        } elseif ($role_id == TEACHER) {
            
            $ci->db->select('T.*, D.title AS department, U.role_id, U.username, R.name AS role, SG.grade_name');
            $ci->db->from('teachers AS T');
            $ci->db->join('users AS U', 'U.id = T.user_id', 'left');
            $ci->db->join('roles AS R', 'R.id = U.role_id', 'left');
            $ci->db->join('departments AS D', 'D.id = T.department_id', 'left');
            $ci->db->join('salary_grades AS SG', 'SG.id = T.salary_grade_id', 'left');
            $ci->db->where('T.user_id', $user_id);
            return $ci->db->get()->row();
            
        } elseif ($role_id == GUARDIAN) {
            
            $ci->db->select('G.*, U.role_id, U.username, R.name AS role');
            $ci->db->from('guardians AS G');
            $ci->db->join('users AS U', 'U.id = G.user_id', 'left');
            $ci->db->join('roles AS R', 'R.id = U.role_id', 'left');
            $ci->db->where('G.user_id', $user_id);
            return $ci->db->get()->row();
                
        } else {
            
            $ci->db->select('E.*, U.role_id, U.username, R.name AS role, D.name AS designation, SG.grade_name');
            $ci->db->from('employees AS E');
            $ci->db->join('users AS U', 'U.id = E.user_id', 'left');
             $ci->db->join('roles AS R', 'R.id = U.role_id', 'left');
            $ci->db->join('designations AS D', 'D.id = E.designation_id', 'left');
            $ci->db->join('salary_grades AS SG', 'SG.id = E.salary_grade_id', 'left');
            $ci->db->where('E.user_id', $user_id);
            return $ci->db->get()->row();
        }

        $ci->db->last_query();
    }

}

if (!function_exists('has_permission')) {

    function has_permission($action, $module_slug = null, $operation_slug = null) {

        /*
          //$role_id = $ci->session->userdata('role_id');

          if ($module_slug == '') {
          $module_slug = $operation_slug;
          }

          $module_slug = 'my_' . $module_slug;

          $data = $ci->config->item($operation_slug, $module_slug);

          $result = @$data[$role_id];

          if (!empty($result)) {
          $array = explode('|', $result);
          return $array[$action];
          } else {
          return FALSE;
          }

         */
    }

}