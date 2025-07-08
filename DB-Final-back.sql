SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
---------------------------
--
-- Table structure for table `users`
--
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `temp_password` varchar(150) DEFAULT NULL,
  `reset_key` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `email_verified_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1= Active, 0 = InActive',
  `last_logged_in` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified_by` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- ============================ SETTING =================================================

-- Table structure for table `settings`

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,  
  `purchase_code` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `school_code` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `school_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `currency` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `currency_symbol` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `footer` text CHARACTER SET utf8 DEFAULT NULL,
  `dashboard_logo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `admin_logo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `print_logo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `front_logo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `favicon_icon` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `school_fax` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `language` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `theme_slug` varchar(50) CHARACTER SET utf8 DEFAULT 'radical-red',  
  `academic_year_id` int(11) DEFAULT NULL,
  `session_start_month` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `week_start_day` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `enable_preloader` tinyint(1) NOT NULL DEFAULT 0,
  `enable_whats_app` tinyint(1) NOT NULL DEFAULT 0,
  `enable_custom_field` tinyint(1) NOT NULL DEFAULT 0,
  `enable_rtl` tinyint(1) NOT NULL DEFAULT 0,
  `enable_frontend` tinyint(1) NOT NULL DEFAULT 1,
  `enable_online_admission` tinyint(1) NOT NULL DEFAULT 1,
  `eo_admission_payment` tinyint(1) NOT NULL DEFAULT 1,
  `online_admission_note` text CHARACTER SET utf8 DEFAULT NULL,
  `final_result_type` tinyint(1) DEFAULT 0,
  `default_time_zone` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `date_format` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `zoom_api_key` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `zoom_secret` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `google_analytics` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `google_map` text CHARACTER SET utf8 DEFAULT NULL, 
  `facebook_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `twitter_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `linkedin_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `youtube_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `instagram_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pinterest_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(11) NOT NULL,
  `mail_protocol` varchar(50) NOT NULL,
  `smtp_host` varchar(100) NOT NULL,
  `smtp_port` varchar(20) NOT NULL,
  `smtp_timeout` tinyint(1) NOT NULL DEFAULT 0,
  `smtp_user` varchar(100) NOT NULL,
  `smtp_pass` varchar(100) NOT NULL,
  `smtp_crypto` varchar(50) NOT NULL,
  `mail_type` varchar(50) NOT NULL,
  `char_set` varchar(50) NOT NULL,
  `priority` tinyint(1) NOT NULL DEFAULT 1,
  `from_name` varchar(100) NOT NULL,
  `from_email` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` int(11) NOT NULL,
  `gateway` varchar(100) DEFAULT NULL,
  `field_key` varchar(100) DEFAULT NULL,
  `field_value` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `sms_settings` (
  `id` int(11) NOT NULL,
  `gateway` varchar(100) DEFAULT NULL,
  `field_key` varchar(100) DEFAULT NULL,
  `field_value` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `opening_hours` (
  `id` int(11) NOT NULL,
  `monday` varchar(100) DEFAULT NULL,
  `tuesday` varchar(100) DEFAULT NULL,
  `wednesday` varchar(100) DEFAULT NULL,
  `thursday` varchar(100) DEFAULT NULL,
  `friday` varchar(100) DEFAULT NULL,
  `saturday` varchar(100) DEFAULT NULL,
  `sunday` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL, unique
  `theme_slug` varchar(120) NOT NULL, unique
  `color_code` varchar(10) NOT NULL, 
  `is_active` tinyint(1) NOT NULL COMMENT '1 = Active, 0 = Inactive',
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `themes` (`id`, `name`, `theme_slug`, `color_code`, `is_active`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(13, 'SlateGray ', 'slate-gray', '#2A3F54',  0, 1, '2017-08-18 12:59:25', '2017-08-18 13:03:43', 0, 0),
(2, 'Black ', 'black', '#000000', 0, 1, '2017-08-18 12:59:25', '2017-08-18 13:03:43', 0, 0),
(14, 'LightSeaGreen ', 'light-sea-green', '#20B2AA',  0, 1, '2017-08-18 12:59:25', '2017-08-18 13:03:43', 0, 0),
(4, 'MediumPurple ', 'medium-purple', '#9370DB', 0, 1, '2017-08-18 12:59:25', '2017-08-18 13:03:43', 0, 0),
(15, 'Navy Blue', 'navy-blue', '#001f67', 0, 1, '2017-08-18 12:59:25', '2017-08-18 13:03:43', 0, 0),
(6, 'RebeccaPurple ', 'rebecca-purple', '#663399', 0, 1, '2017-08-18 12:59:25', '2017-08-18 13:03:43', 0, 0),
(16, 'Red', 'red', '#e80000', 0, 1, '2017-08-18 12:59:25', '2017-08-18 13:03:43', 0, 0),
(8, 'DodgerBlue', 'dodger-blue', '#1E90FF', 0, 1, '2017-08-18 12:59:25', '2017-08-18 13:03:43', 0, 0),
(9, 'Maroon', 'maroon', '#800000', 0, 1, '2017-08-18 12:59:25', '2017-08-18 13:03:43', 0, 0),
(10, 'DarkOrange', 'dark-orange', '#FF8C00', 0, 1, '2017-08-18 12:59:25', '2017-08-18 13:03:43', 0, 0),
(11, 'DeepPink', 'deep-pink', '#FF1493', 0, 1, '2017-08-18 12:59:25', '2017-08-18 13:03:43', 0, 0),
(5, 'LimeGreen', 'lime-green', '#32CD32', 0, 1, '2017-08-18 12:59:25', '2017-08-18 13:03:43', 0, 0),
(1, 'Jazzberry Jam', 'jazzberry-jam', '#9F134E', 0, 1, '2017-08-18 12:59:25', '2017-08-18 13:03:43', 0, 0),
(3, 'Umber', 'umber', '#745D0B', 1, 1, '2017-08-18 12:59:25', '2017-08-18 13:03:43', 0, 0),
(12, 'Trinidad', 'trinidad', '#CC4F26', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(7, 'Radical Red', 'radical-red', '#FB2E50',  0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);


-- ===================== ADMINISTRATOR -=============================================

--
-- Dumping data for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `note` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 1,
  `is_super_admin` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `roles` (`id`, `slug`, `name`, `note`, `is_default`, `is_super_admin`, `status`, `created_at`, `modified_at`, `created_by`, `modified_by`) VALUES
(1, 'super-admin', 'Super Admin', 'Super Admin User', 1, 1, 1, '2017-08-13 12:15:17', '2022-03-07 23:22:23', 0, 1),
(2, 'admin', 'Admin', 'Admin User', 1, 0, 1, '2017-08-13 13:01:36', '0000-00-00 00:00:00', 0, 0),
(3, 'guardian', 'Guardian', 'Guardian/Parent User', 1, 0, 1, '2017-08-13 13:02:05', '2018-02-09 01:59:22', 0, 1),
(4, 'student', 'Student', 'Student User', 1, 0, 1, '2017-08-13 13:02:24', '2018-02-09 01:59:34', 0, 1),
(5, 'teacher', 'Teacher', 'Teacher User', 1, 0, 1, '2017-08-13 13:02:51', '2018-02-09 01:59:46', 0, 1),
(6, 'accountant', 'Accountant', 'Accountant User', 1, 0, 1, '2017-08-13 13:04:00', '2018-02-09 02:00:07', 0, 1),
(7, 'librarian', 'Librarian', 'Librarian User', 1, 0, 1, '2017-08-13 13:04:18', '2018-02-09 02:00:22', 0, 1),
(8, 'receptioniast', 'Receptioniast', 'Receptionist/ Front Desk User', 1, 0, 1, '2017-08-13 13:04:36', '2018-02-09 02:02:30', 0, 1);




--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `english_en` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `bengali_bn` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `spanish_es` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `arabic_ar` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `hindi_hi` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `urdu_ur` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `japanese_ja` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `portuguese_pt` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `french_fr` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `korean_ko` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `german_de` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `italian_it` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `hungarian_hu` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `dutch_nl` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `latin_la` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `indonesian_id` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `turkish_tr` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `greek_el` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `persian_fa` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `malay_ms` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `polish_pl` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `ukrainian_uk` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `romanian_ro` longtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `sms_templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `type` varchar(20), enam :  email, sms
  `title` varchar(255) NOT NULL,
  `template` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `module_slug` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `modules` (`id`, `module_name`, `module_slug`, `status`, `created_at`, `modified_at`, `created_by`, `modified_by`) VALUES
(1, 'Setting', 'setting', 1, '2017-11-13 22:55:19', '2017-11-13 22:57:10', 1, 1),
(2, 'Theme', 'theme', 1, '2017-12-12 13:34:52', '0000-00-00 00:00:00', 1, 0),
(3, 'Language', 'language', 1, '2017-12-12 13:36:11', '0000-00-00 00:00:00', 1, 0),
(4, 'Administrator', 'administrator', 1, '2017-12-12 13:36:35', '0000-00-00 00:00:00', 1, 0),


CREATE TABLE `operations` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `operation_name` varchar(50) NOT NULL,
  `operation_slug` varchar(50) NOT NULL,
  `is_view_vissible` tinyint(1) DEFAULT 0,
  `is_add_vissible` tinyint(1) DEFAULT 0,
  `is_edit_vissible` tinyint(1) DEFAULT 0,
  `is_delete_vissible` tinyint(1) DEFAULT 0,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `operations` (`id`, `module_id`, `operation_name`, `operation_slug`, `is_view_vissible`, `is_add_vissible`, `is_edit_vissible`, `is_delete_vissible`, `status`, `created_at`, `modified_at`, `created_by`, `modified_by`) VALUES
(1, 1, 'General Setting', 'setting', 1, 1, 1, NULL, 1, '2017-12-12 16:06:25', '2019-09-01 14:22:34', 1, 1),
(2, 1, 'Payment Setting', 'payment', 1, 1, 1, NULL, 1, '2017-12-12 16:06:55', '2019-09-01 14:23:16', 1, 1),
(3, 1, 'SMS Setting', 'sms', 1, 1, 1, NULL, 1, '2017-12-12 16:07:07', '2019-09-01 14:23:01', 1, 1),


CREATE TABLE `privileges` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `operation_id` int(11) NOT NULL,
  `is_add` tinyint(1) NOT NULL,
  `is_edit` tinyint(1) NOT NULL,
  `is_view` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `ip_address` varchar(50) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `activity` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure for table `guardian_feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `is_publish` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




-- ============================ Front Office ======================================

--
-- Table structure for table `visitor_purposes`
--

CREATE TABLE `visitor_purposes` (
  `id` int(11) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,  
  `purpose_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `no_of_people` int(11) NOT NULL DEFAULT 1,
  `check_in` datetime DEFAULT NULL,
  `check_out` datetime DEFAULT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `phone_call_logs`
--

CREATE TABLE `phone_call_logs` (
  `id` int(11) NOT NULL,
  `call_type` varchar(120) NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `call_duration` varchar(50) DEFAULT NULL,
  `call_date` date DEFAULT NULL,
  `follow_up_date` date DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `postal_dispatches`
--

CREATE TABLE `postal_dispatches` (
  `id` int(11) NOT NULL,
  `to_title` varchar(120) NOT NULL,
  `reference` varchar(120) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `from_title` varchar(120) NOT NULL,
  `dispatch_date` date DEFAULT NULL,
  `attachment` varchar(120) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `postal_receives`
--

CREATE TABLE `postal_receives` (
  `id` int(11) NOT NULL,
  `from_title` varchar(120) NOT NULL,
  `reference` varchar(120) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  `to_title` varchar(120) NOT NULL,
  `attachment` varchar(120) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



--
-- Table structure for table `source`
--

CREATE TABLE `enquiry_sources` (
  `id` int(11) NOT NULL,
  `source` varchar(100) NOT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date` date NOT NULL, 
  `follow_up_date` date DEFAULT NULL,
  `source` varchar(50) NOT NULL,
  `reference` varchar(20) DEFAULT NULL,
  `assigned_to` varchar(100) NOT NULL,
  `class` int(11) NOT NULL,
  `no_of_child` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `follow_up_enquiries`
--

CREATE TABLE `enquiry_follow_ups` (
  `id` int(11) NOT NULL,
  `enquiry_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `next_date` date NOT NULL,
  `response` text NOT NULL,
  `note` text DEFAULT NULL,
  `followup_by` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



=================== COMPLAIN  =============================================

--
-- Table structure for table `complain_types`
--

CREATE TABLE `complain_types` (
  `id` int(11) NOT NULL,
  `type` varchar(120) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure for table `complains`
--

CREATE TABLE `complains` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `complain_type_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `action_note` text DEFAULT NULL,
  `complain_date` datetime DEFAULT NULL,
  `action_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



===================  ACCOUNTING  =============================================

--
-- Table structure for table `expenditure_heads`
--

CREATE TABLE `expenditure_heads` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `expenditures`
--

CREATE TABLE `expenditures` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `expenditure_head_id` int(11) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `expenditure_type` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `expenditure_via` varchar(20) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `income_heads`
--

CREATE TABLE `income_heads` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `income_head_id` int(11) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `income_type` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `income_via` varchar(20) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



--
-- Table structure for table `discounts`
--
CREATE TABLE `fee_discounts` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11),
  `title` varchar(100) NOT NULL,
  `discount_type` varchar(50) DEFAULT NULL, [percentage. flat]
  `amount` double(10,2) NOT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- fee heads
CREATE TABLE `fee_types` (
  `id` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `order_id` int(11) NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `fee_groups` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL, 
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `fee_group_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_group_id` int(11) NOT NULL,
  `fee_type_id` int(11) NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `fee_fines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_type_id` int(11) NOT NULL,
  `fine_type` varchar(20) NOT NULL, [ fixed, percentage]
  `amount` varchar(20) NOT NULL, 
  `frequency` varchar(20) NOT NULL, [ weekly, monthly,yearly etc]
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `fee_reminders` (
  `id` int(11) NOT NULL,
  `frequency` varchar(20) NOT NULL,
  `day` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `is_notify_student` tinyint(1) NOT NULL,
  `is_notify_guardian` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `fee_invoices` (
  `id` int(11) NOT NULL,
  `custom_invoice_id` varchar(50) CHARACTER SET utf8 NOT NULL,  
  `academic_year_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL, 
  `month` varchar(20) DEFAULT NULL,
  `gross_amount` double(10,2) NOT NULL, 
  `is_apply_discount` tinyint(1) DEFAULT 0,
  `discount` decimal(10,2) NOT NULL,
   `net_amount` double(10,2) NOT NULL,
  `paid_status` varchar(20) NOT NULL DEFAULT 'Unpaid', Paid, Pairtial
  `temp_amount` double(10,2) NOT NULL,
  `date` date NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `cheque_no` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `bank_receipt` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `txn_id` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `ref` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `payment_date` date NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `card_number` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `card_type` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



-- ============================ HRM ====================================

--
-- Table structure for table `em_departments`
--

CREATE TABLE `emp_departments` (
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure for table `designations`
--

CREATE TABLE `emp_designations` (
  `id` int(11) NOT NULL,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `national_id` varchar(100) CHARACTER SET utf8 NOT NULL,
  `designation_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL DEFAULT 0,  
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `present_address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `permanent_address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `gender` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `blood_group` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `religion` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `joining_date` date NOT NULL,
  `resign_date` date DEFAULT NULL,
  `photo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `resume` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `facebook_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `linkedin_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `twitter_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `instagram_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pinterest_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `youtube_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `other_info` text DEFAULT NULL,
  `is_view_on_web` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ============================ Committee ====================================
--
-- Table structure for table `designations`
--

CREATE TABLE `committee_designations` (
  `id` int(11) NOT NULL,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `employees`
--

CREATE TABLE `committees` (
  `id` int(11) NOT NULL,
  `national_id` varchar(100) CHARACTER SET utf8 NOT NULL,
  `designation_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `qualification` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `present_address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `permanent_address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `gender` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `blood_group` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `religion` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `joining_date` DEFAULT NULL,
  `photo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `facebook_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `linkedin_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `twitter_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `instagram_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pinterest_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `youtube_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `other_info` text DEFAULT NULL,
  `is_view_on_web` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



-- ========================= TEACHER ==========================

--
-- Indexes for table `teacher_departments`
--

CREATE TABLE `teacher_departments` (
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Indexes for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,  
  `national_id` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `present_address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `permanent_address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `gender` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `blood_group` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `religion` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `joining_date` date NOT NULL,
  `resign_date` text DEFAULT NULL,
  `photo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `resume` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `facebook_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `linkedin_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `twitter_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `instagram_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `youtube_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pinterest_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `is_view_on_web` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `other_info` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure for table `ratings`
--

CREATE TABLE `teacher_ratings` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `rating_status` varchar(50) NOT NULL DEFAULT 'pending' COMMENT 'pending, approved',
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





-- =================================ACADEMIC ========================================


CREATE TABLE `academic_years` (
  `id` int(11) NOT NULL,
  `session_year` varchar(100) CHARACTER SET utf8 NOT NULL,
  `start_year` varchar(30) CHARACTER SET utf8 NOT NULL,
  `end_year` varchar(30) CHARACTER SET utf8 NOT NULL,
  `note` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `is_running` tinyint(1) NOT NULL DEDAULT 0,
  `status` tinyint(1) NOT NULL  DEDAULT 1,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL, 
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `numeric_name` int(11) NOT NULL, 
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,  
  `name` varchar(100)  NOT NULL,
  `capacity` int(11) NULL,
  `is_default` boolean DEFAULT FALSE,  
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL, 
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `code` varchar(50),
  `type` varchar(50) CHARACTER SET utf8 NOT NULL, -- enam grouped, theory, practical, manadatory, optional, 
  `cut_point` int(11) NULL,  -- only for optional
  `is_group` boolean, 
  `group_id` int(11) NOT NULL, [ same id for 1st and 2nd part/papper]
  `group_code` int(11) NOT NUL,
  `author` varchar(100) DEFAULT NULL,   
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



--
-- Table structure for table `subjects`
--
--section_id after add
CREATE TABLE `subject_assign_to_classes` (
  `id` int(11) NOT NULL, 
  `class_id` int(11) NOT NULL,  
  `section_id` int(11) NOT NULL,  
  `subject_id` int(11) NOT NULL, 
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--section_id after add
CREATE TABLE `syllabuses` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `assigment_date` datetime DEFAULT NULL,
  `submission_date` datetime DEFAULT NULL,
  `is_sms_notification` tinyint(1) DEFAULT 0,
  `is_email_notification` tinyint(1) DEFAULT 0,
  `description` text CHARACTER SET utf8 DEFAULT NULL,
  `attachment` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `mark` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `assignment_submissions` (
  `id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,  
  `student_id` int(11) NOT NULL,
  `attachment` varchar(100) DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `evaluation_date` datetime DEFAULT NULL,
  `evaluation_status` varchar(20) NOT NULL DEFAULT 'submitted',
  `comment` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `obtained_mark` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `routines` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `day` varchar(20) CHARACTER SET utf8 NOT NULL,
  `start_time` varchar(20) CHARACTER SET utf8 NOT NULL,
  `end_time` varchar(20) CHARACTER SET utf8 NOT NULL,
  `room_no` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



-- ==================== ATTENTANCE ==================================

CREATE TABLE `student_attendances` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `month` varchar(10) CHARACTER SET utf8 NOT NULL,
  `year` varchar(10) CHARACTER SET utf8 NOT NULL,
  `day_1` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_2` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_3` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_4` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_5` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_6` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_7` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_8` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_9` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_10` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_11` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_12` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_13` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_14` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_15` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_16` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_17` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_18` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_19` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_20` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_21` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_22` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_23` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_24` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_25` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_26` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_27` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_28` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_29` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_30` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_31` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `teacher_attendances` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `month` varchar(10) CHARACTER SET utf8 NOT NULL,
  `year` varchar(10) CHARACTER SET utf8 NOT NULL,
  `day_1` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_2` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_3` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_4` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_5` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_6` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_7` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_8` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_9` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_10` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_11` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_12` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_13` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_14` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_15` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_16` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_17` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_18` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_19` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_20` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_21` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_22` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_23` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_24` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_25` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_26` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_27` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_28` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_29` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_30` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_31` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `employee_attendances` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `month` varchar(10) CHARACTER SET utf8 NOT NULL,
  `year` varchar(10) CHARACTER SET utf8 NOT NULL,
  `day_1` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_2` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_3` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_4` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_5` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_6` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_7` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_8` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_9` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_10` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_11` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_12` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_13` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_14` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_15` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_16` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_17` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_18` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_19` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_20` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_21` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_22` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_23` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_24` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_25` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_26` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_27` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_28` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_29` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_30` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `day_31` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



--============================ STUDENTS ==============================
--
-- Table structure for table `guardians`
--

CREATE TABLE `guardians` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `national_id` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `profession` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `present_address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `permanent_address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `religion` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `photo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `other_info` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `student_groups`
--

CREATE TABLE `student_groups` (
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `student_types`
--

CREATE TABLE `student_types` (
  `id` int(11) NOT NULL,
  `type` varchar(120) NOT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `belong_table_to` varchar(100) NOT NULL,
  `field_type` varchar(100) NOT NULL,
  `bs_column` int(10) DEFAULT NULL,
  `is_validation` int(11) DEFAULT '0',
  `field_values` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `custom_field_values`
--

CREATE TABLE `custom_field_values` (
  `id` int(11) NOT NULL,
  `belong_to_table_id` int(11) NOT NULL,
  `custom_field_id` int(11) NOT NULL,
  `field_value` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `student_houses`
--
CREATE TABLE `student_houses` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `note` varchar(400) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL DEFAULT 0,
  `house_id` int(11) NOT NULL DEFAULT 0,
  `admission_no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `admission_date` date NOT NULL,    
  `first_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `middle_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `present_address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `permanent_address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `gender` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `blood_group` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `religion` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `caste` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `photo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `library_member_id` tinyint(1) NOT NULL DEFAULT 0,
  `hostel_member_id` tinyint(1) NOT NULL DEFAULT 0,
  `transport_member_id` tinyint(1) NOT NULL DEFAULT 0,
  `discount_id` int(11) NOT NULL DEFAULT 0,
  `national_id` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `health_condition` text CHARACTER SET utf8 DEFAULT NULL,
  `previous_school` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `previous_class` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `transfer_certificate` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `second_language` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `other_info` text DEFAULT NULL,
  `guardian_is` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `guardian_id` int(11) NOT NULL,
  `relation_with` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `father_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `father_phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `father_education` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `father_profession` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `father_photo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `mother_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `mother_phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `mother_education` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `mother_profession` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `mother_photo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `status_type` varchar(50) CHARACTER SET utf8 DEFAULT 'regular' COMMENT 'regular, drop, transfer,passed	',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `roll_no` int(11) NOT NULL,
  `enroll_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL, [promoted, fail, requested]
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure for table `admissions`
--
CREATE TABLE `admissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `national_id` varchar(100) DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `middle_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `blood_group` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `caste` varchar(100) DEFAULT NULL,
  `health_condition` varchar(255) DEFAULT NULL,
  `photo` varchar(120) DEFAULT NULL,
  `present_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `previous_school` varchar(255) DEFAULT NULL,
  `previous_class` varchar(100) DEFAULT NULL,
  `second_language` varchar(120) DEFAULT NULL,
  `transfer_certificate` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `guardian_is` varchar(100) DEFAULT NULL,
  `guardian_id` int(11) DEFAULT NULL,
  `gud_relation` varchar(100) DEFAULT NULL,
  `gud_name` varchar(100) DEFAULT NULL,
  `gud_phone` varchar(50) DEFAULT NULL,
  `gud_email` varchar(50) DEFAULT NULL,
  `gud_national_id` varchar(50) DEFAULT NULL,
  `gud_present_address` varchar(255) DEFAULT NULL,
  `gud_permanent_address` varchar(255) DEFAULT NULL,
  `gud_profession` varchar(100) DEFAULT NULL,
  `gud_religion` varchar(100) DEFAULT NULL,
  `gud_other_info` text DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `father_phone` varchar(50) DEFAULT NULL,
  `father_education` varchar(100) DEFAULT NULL,
  `father_profession` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mother_phone` varchar(50) DEFAULT NULL,
  `mother_education` varchar(100) DEFAULT NULL,
  `mother_profession` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = New, 2 = Waiting, 3 = Decline, 4 = Approved',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- ====================== ASSESMENT ======================

CREATE TABLE `assesments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `is_negative` tinyint(1) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `assesment_assigns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `assesment_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `assesment_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_comment` text DEFAULT NULL,
  `guardian_comment` text DEFAULT NULL,
  `teacher_comment` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `student_activities` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `activity` text CHARACTER SET utf8 DEFAULT NULL,
  `activity_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- ====================== STUDENT ALUMNI ======================

CREATE TABLE `alumni_students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `present_phone` varchar(50) NOT NULL,
  `present_email` varchar(50) DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `present_address` text DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `alumni_events` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,  
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `notification` text DEFAULT NULL,
  `notify_by_sms` tinyint(1) NOT NULL DEFAULT 0,
  `notify_by_email` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



-- ============================ Front CMS ======================================

CREATE TABLE `events` (
  `id` int(11) NOT NULL, 
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `event_place` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `feature_image` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8 DEFAULT NULL, 
  `meta_title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,  
  `meta_keyword` text CHARACTER SET utf8 DEFAULT NULL,  
  `meta_description` text CHARACTER SET utf8 DEFAULT NULL,  
  `show_on_web` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `note`  text CHARACTER SET utf8 DEFAULT NULL,
  `image` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `show_on_web` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `feature_image` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8 DEFAULT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,  
  `meta_keyword` text CHARACTER SET utf8 DEFAULT NULL,  
  `meta_description` text CHARACTER SET utf8 DEFAULT NULL, 
  `show_on_web` tinyint(1) NOT NULL,  
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `image_path` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `file_size` varchar(100) DEFAULT NULL,
  `vid_url` text DEFAULT NULL,
  `vid_title` varchar(250) DEFAULT NULL
  `status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `news` text CHARACTER SET utf8 NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,  
  `meta_keyword` text CHARACTER SET utf8 DEFAULT NULL,  
  `meta_description` text CHARACTER SET utf8 DEFAULT NULL, 
  `show_on_web` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--after image colum add 
CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` date DEFAULT NULL,
  `notice` text CHARACTER SET utf8 DEFAULT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,  
  `image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,  
  `meta_keyword` text CHARACTER SET utf8 DEFAULT NULL,  
  `meta_description` text CHARACTER SET utf8 DEFAULT NULL, 
  `show_on_web` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `description` text DEFAULT NULL,
  `show_on_web` tinyint(1) NOT NULL, 
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `description` text DEFAULT NULL,
  `image_icon` text DEFAULT NULL, -- bootstrap icon
  `show_on_web` tinyint(1) NOT NULL DEFAULT 1, 
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `description` text DEFAULT NULL,
  `image_icon` text DEFAULT NULL, -- bootstrap icon
  `show_on_web` tinyint(1) NOT NULL DEFAULT 1, 
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL, 
  `link_url` text DEFAULT NULL, -- bootstrap icon
  `show_on_web` tinyint(1) NOT NULL DEFAULT 1, 
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `pages` (
  `id` int(11) NOT NULL,  
  `slug` varchar(100) CHARACTER SET utf8 NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8 DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_position` varchar(50) DEFAULT NULL, [top_center, top_left_top_right / bottom]
  `meta_title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,  
  `meta_keyword` text CHARACTER SET utf8 DEFAULT NULL,  
  `meta_description` text CHARACTER SET utf8 DEFAULT NULL, 
  `show_on_web` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `home_page_sections` (
  `id` int(11) NOT NULL,   
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8 DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_position` varchar(50) DEFAULT NULL, [top_center, top_left_top_right / bottom] 
  `bootstrap_width` varchar(50) DEFAULT NULL, [6/12 column] 
  `show_on_web` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- look up table with fixed data
CREATE TABLE `menu_groups` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL [header/footer]  
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `label` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL, 
  `is_open_new_tab` int(10) NOT NULL DEFAULT '0',
  `is_ext_url` tinyint(1) NOT NULL DEFAULT 1,
  `ext_url_link` text NOT NULL, 
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `media_galleries` (
  `id` int(11) NOT NULL,
  `content_type` varchar(50) CHARACTER SET utf8 NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `image_name` varchar(300) DEFAULT NULL,
  `thumb` varchar(100) DEFAULT NULL, 
  `thumb_name` varchar(300) DEFAULT NULL,  
  `file_type` varchar(100) DEFAULT NULL,
  `file_size` varchar(100) DEFAULT NULL,
  `video_url` varchar(250) DEFAULT NULL
  `video_title` varchar(250) DEFAULT NULL
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- =================== CERTIFICARE ======================

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `theme` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `header_left` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `header_center` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `header_right` varchar(100) CHARACTER SET utf8 DEFAULT NULL,  
  `header_height` varchar(100) CHARACTER SET utf8 DEFAULT NULL,  
  `main_text` text CHARACTER SET utf8 DEFAULT NULL,
  `main_text_height` varchar(10) CHARACTER SET utf8 DEFAULT NULL,  
  `main_text_width` varchar(10) CHARACTER SET utf8 DEFAULT NULL,  
  `footer_left` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `footer_middle` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `footer_right` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `footer_height` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `background` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- Admit Card Design er por final  kora hobe
CREATE TABLE `admit_card_settings` (
  `id` int(11) NOT NULL,
  `border_color` varchar(20) DEFAULT NULL,
  `top_bg` varchar(20) DEFAULT NULL,
  `bottom_bg` varchar(20) DEFAULT NULL,
  `admit_bg` varchar(20) DEFAULT NULL,
  `school_logo` varchar(120) DEFAULT NULL,
  `school_name` varchar(120) DEFAULT NULL,
  `school_name_font_size` varchar(20) DEFAULT NULL,
  `school_name_color` varchar(20) DEFAULT NULL,
  `school_address` varchar(255) DEFAULT NULL,
  `school_address_color` varchar(20) DEFAULT NULL,
  `admit_font_size` varchar(20) DEFAULT NULL,
  `admit_color` varchar(20) DEFAULT NULL,
  `title_font_size` varchar(20) DEFAULT NULL,
  `title_color` varchar(20) DEFAULT NULL,
  `content_font_size` varchar(20) DEFAULT NULL,
  `content_color` varchar(20) DEFAULT NULL,
  `exam_font_size` varchar(20) DEFAULT NULL,
  `exam_color` varchar(20) DEFAULT NULL,
  `subject_font_size` varchar(20) DEFAULT NULL,
  `subject_color` varchar(20) DEFAULT NULL,
  `bottom_text` varchar(100) DEFAULT NULL,
  `bottom_text_color` varchar(20) DEFAULT NULL,
  `bottom_text_align` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `id_card_settings` (
  `id` int(11) NOT NULL,
  `border_color` varchar(20) DEFAULT NULL,
  `top_bg` varchar(20) DEFAULT NULL,
  `bottom_bg` varchar(20) DEFAULT NULL,
  `school_logo` varchar(120) DEFAULT NULL,
  `school_name` varchar(120) DEFAULT NULL,
  `school_name_color` varchar(20) DEFAULT NULL,
  `school_address` varchar(255) DEFAULT NULL,
  `school_address_color` varchar(20) DEFAULT NULL,
  `id_no_font_size` varchar(20) DEFAULT NULL,
  `id_no_color` varchar(20) DEFAULT NULL,
  `id_no_bg` varchar(20) DEFAULT NULL,
  `title_font_size` varchar(20) DEFAULT NULL,
  `title_color` varchar(20) DEFAULT NULL,
  `content_font_size` varchar(20) DEFAULT NULL,
  `content_color` varchar(20) DEFAULT NULL,
  `bottom_text` varchar(100) DEFAULT NULL,
  `bottom_text_color` varchar(20) DEFAULT NULL,
  `bottom_text_align` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- ===================== HOSTEL ==================================

CREATE TABLE `hostels` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type` varchar(20) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,[girl, boys, combine]
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `hostel_room_types` (
  `id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `hostel_rooms` (
  `id` int(11) NOT NULL,
  `hostel_id` int(11) NOT NULL,
  `room_type_id` int(11) DEFAULT NULL,
  `room_no` varchar(20) CHARACTER SET utf8 NOT NULL,
  `total_bed` int(11) CHARACTER SET utf8 NOT NULL,
  `cost_per_bed` decimal(10,2) NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `hostel_members` (
  `id` int(11) NOT NULL,
  `card_number` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hostel_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- ======================INVENTORY+++++++++++++++++++++++++++++++++++

CREATE TABLE `inventory_suppliers` (
  `id` int(11) NOT NULL,
  `company` varchar(120) NOT NULL,
  `contact` varchar(120) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `phone` varchar(120) NOT NULL,
  `address` varchar(120) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `inventory_warehouses` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `keeper` varchar(120) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `phone` varchar(120) DEFAULT NULL,
  `address` varchar(120) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `inventory_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `inventory_products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(120) NOT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `inventory_purchases` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `employee_id` varchar(120) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_type` varchar(20) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `purchase_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `inventory_stocks` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `inventory_issues` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `inventory_sales` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `income_head_id` int(11) NOT NULL,
  `invoice_type` varchar(120) DEFAULT NULL COMMENT 'sale',
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `net_amount` double(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- ================== TRANSPORT ==================================


CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `number` varchar(100) CHARACTER SET utf8 NOT NULL,
  `model` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `driver` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `license` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `contact` varchar(30) CHARACTER SET utf8 NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `is_allocated` tinyint(1) NOT NULL DEFAULT 1,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `vehicle_ids` varchar(150) CHARACTER SET utf8 NOT NULL,
  `title` varchar(150) CHARACTER SET utf8 NOT NULL,
  `route_start` varchar(255) CHARACTER SET utf8 NOT NULL,
  `route_end` varchar(255) CHARACTER SET utf8 NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `route_stops` (
  `id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `stop_name` varchar(255) NOT NULL,
  `stop_km` varchar(50) NOT NULL,
  `stop_fare` double(10,2) NOT NULL,
  `pickup_time` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `transport_members` (
  `id` int(11) NOT NULL,
  `card_number` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `route_stop_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


---==================== LIBRARY =======================

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `custom_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `isbn_no` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `edition` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `author` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `language` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `cover` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `rack_no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `library_members` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_number` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `book_issues` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `library_member_id` int(11) NOT NULL COMMENT 'Library member id',
  `book_id` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date NOT NULL,
  `is_returned` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `ebooks` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `edition` varchar(50) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `cover_image` varchar(120) DEFAULT NULL,
  `file_name` varchar(120) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- ================== Assets ==================================

CREATE TABLE `asset_stores` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `keeper` varchar(120) DEFAULT NULL,
  `phone` varchar(120) DEFAULT NULL,
  `address` varchar(120) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `asset_vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `phone` varchar(120) NOT NULL,
  `contact_person` varchar(120) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `asset_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `asset_items` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `code` varchar(120) NOT NULL,
  `name` varchar(120) NOT NULL,
  `type` varchar(120) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `asset_purchases` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `employee_id` varchar(120) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_type` varchar(20) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `purchase_date` date NOT NULL,
  `expire_date` date DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `asset_stocks` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `total_qty` varchar(120) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `asset_issues` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--========================== DOWNLOAD CENTER ====================

CREATE TABLE `teacher_lectures` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,  
  `type` varchar(50) NOT NULL, [youtube, vimeo, ppt, doc, pdf]
  `title` varchar(255) NOT NULL,
  `video_id` varchar(50) DEFAULT NULL,
  `pdf_doc_file` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `attachment` varchar(120) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `material_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `study_materials` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL, 
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(50) NOT NULL,[video/ image/ pdf/ doc etc]
  `attachment` varchar(120) DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_size` varchar(50) DEFAULT NULL,
  `video_id` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



-- ============================ PAYROLL =========================

CREATE TABLE `payroll_grades` (
  `id` int(11) NOT NULL,
  `grade_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `grade_type` varchar(50) CHARACTER SET utf8 NOT NULL enam [monthly, hourly],
  `basic_salary` double(10,2) NOT NULL,
  `house_rent` double(10,2) NOT NULL,
  `transport` double(10,2) NOT NULL,
  `medical` double(10,2) NOT NULL,
  `ot_hourly_rate` double(10,2) NOT NULL,
  `provident_fund` double(10,2) NOT NULL,
  `hourly_rate` double(10,2) NOT NULL,
  `total_allowance` double(10,2) NOT NULL,
  `total_deduction` double(10,2) NOT NULL,
  `gross_salary` double(10,2) NOT NULL,
  `net_salary` double(10,2) NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `payroll_grade_assigns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_grade_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,  
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `salary_payments`
--

CREATE TABLE `payroll_payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `salary_assign_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `expenditure_id` int(11) NOT NULL,
  `receiver_type` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `salary_month` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `salary_date` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `basic_salary` double(10,2) NOT NULL,
  `house_rent` double(10,2) NOT NULL,
  `transport` double(10,2) NOT NULL,
  `medical` double(10,2) NOT NULL,
  `bonus` double(10,2) NOT NULL,
  `ot_hourly_rate` double(10,2) NOT NULL,
  `ot_total_hour` double(10,2) NOT NULL,
  `ot_amount` double(10,2) NOT NULL,
  `provident_fund` double(10,2) NOT NULL,
  `penalty` double(10,2) NOT NULL,
  `hourly_rate` double(10,2) DEFAULT 0.00,
  `total_hour` double(10,2) DEFAULT NULL,
  `gross_salary` double(10,2) NOT NULL,
  `total_allowance` double(10,2) NOT NULL,
  `total_deduction` double(10,2) NOT NULL,
  `net_salary` double(10,2) NOT NULL,
  `payment_method` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `cheque_no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bank_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `payment_to` varchar(20) CHARACTER SET utf8 NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- ===================== MISC ====================


CREATE TABLE `misc_awards` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL, 
  `title` varchar(150) NOT NULL,
  `gift` varchar(150) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `misc_todos` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL, 
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `work_status` varchar(50) NOT NULL, [complete, incomplete]
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- ======================== LEAVE ====================

CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `type` varchar(120) NOT NULL,
  `total_leave` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `leave_applications` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `leave_day` int(11) NOT NULL,
  `leave_reason` text DEFAULT NULL,
  `leave_note` text DEFAULT NULL,
  `leave_date` datetime NOT NULL,
  `leave_status` tinyint(1) NOT NULL COMMENT '[1 = new ,2 = waiting, 3 = approved, 4 = decline]',
  `attachment` varchar(120) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--- ============= LIVE PROGRAM ====================

CREATE TABLE `live_classes` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL, [gmeet/gitsi/zoom]
  `meeting_id` varchar(100) DEFAULT NULL,
  `meeting_password` varchar(120) DEFAULT NULL,api_key
  `meeting_api_key` varchar(120) DEFAULT NULL,
  `meeting_url` varchar(255) DEFAULT NULL,
  `class_date` date NOT NULL,
  `start_time` varchar(50) NOT NULL,
  `end_time` varchar(50) NOT NULL,
  `is_sms_notification` tinyint(1) DEFAULT 0,
  `is_email_notification` tinyint(1) DEFAULT 0,
  `description` text DEFAULT NULL,
  `class_status` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `live_meetings` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL, 
  `role_id` varchar(50) NOT NULL, [admin/teacher/account]
  `type` varchar(50) NOT NULL, [gmeet/gitsi/zoom]
  `meeting_id` varchar(100) DEFAULT NULL,
  `meeting_password` varchar(120) DEFAULT NULL,
  `meeting_api_key` varchar(120) DEFAULT NULL,
  `meeting_url` varchar(255) DEFAULT NULL,
  `meeting_date` date NOT NULL,
  `start_time` varchar(50) NOT NULL,
  `end_time` varchar(50) NOT NULL,
  `is_sms_notification` tinyint(1) DEFAULT 0,
  `is_email_notification` tinyint(1) DEFAULT 0,
  `description` text DEFAULT NULL,
  `class_status` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--- ================= COMMUNICATION ----------------------
CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 NOT NULL,
  `body` text CHARACTER SET utf8 DEFAULT NULL,
  `attachment` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `message_relationships` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_trash` tinyint(1) NOT NULL DEFAULT 0,
  `is_draft` smallint(1) NOT NULL DEFAULT 0,
  `is_favorite` tinyint(1) NOT NULL DEFAULT 0,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `message_replies` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `body` text CHARACTER SET utf8 DEFAULT NULL,
  `attachment` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `message_emails` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `receivers` text CHARACTER SET utf8 DEFAULT NULL,
  `academic_year_id` int(11) NOT NULL,
  `email_type` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 1 COMMENT '1. general, 2. Attendance, 3. Due Fee, 4. Result ',
  `absent_date` date DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8 NOT NULL,
  `body` text CHARACTER SET utf8 DEFAULT NULL,
  `attachment` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `message_texts` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `receivers` text DEFAULT NULL,
  `academic_year_id` int(11) NOT NULL,
  `sms_gateway` varchar(20) CHARACTER SET utf8 NOT NULL,
  `sms_type` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 1 COMMENT '1. general, 2. Attendance, 3. Due Fee, 4. Result ',
  `absent_date` date DEFAULT NULL,
  `body` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


---- ====================== SCHOLARSHIP -----------------------------------------

CREATE TABLE `ss_balance` (
  `id` int(11) NOT NULL,
  `balance` double(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `ss_candidates`
--

CREATE TABLE `ss_candidates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `candidate_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '[1 = applied ,2 = approved, 2 = declined]',
  `description` text DEFAULT NULL,
  `applied_at` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `ss_donars`
--

CREATE TABLE `ss_donars` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,  
  `name` varchar(100) NOT NULL,
  `contact_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `amount` double(10,2) NOT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `applied_at` date NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `ss_scholarships`
--

CREATE TABLE `ss_payments` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- =========== LESSON PLAN ===================================

--after section_id column add
CREATE TABLE `lp_lessons` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `lp_lesson_details`
--

CREATE TABLE `lp_lesson_details` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `start_date` varchar(50) DEFAULT NULL,
  `end_date` varchar(50) DEFAULT NULL,
  `complete_status` varchar(50) DEFAULT 'incomplete',
  `complete_date` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `lp_topics`
--
--after section_id column add
CREATE TABLE `lp_topics` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `lesson_detail_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `lp_topic_details`
--

CREATE TABLE `lp_topic_details` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `start_date` varchar(50) DEFAULT NULL,
  `end_date` varchar(50) DEFAULT NULL,
  `complete_status` varchar(50) DEFAULT 'incomplete',
  `complete_date` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--- ====================== ONLINE EXAM  =========================================

CREATE TABLE `oex_questions` (
  `id` int(11) NOT NULL, 
  `question_type` varchar(50) NOT NULL,
  `question_level` varchar(50) DEFAULT NULL,
  `question` varchar(255) NOT NULL,
  `image` varchar(150) DEFAULT NULL,
  `mark` double(10,2) NOT NULL DEFAULT 0.00,
  `total_option` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `oex_question_answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option` varchar(255) DEFAULT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 1,
  `answer` varchar(555) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `oex_instructions` (
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `instruction` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `oex_online_exams` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,  
  `instruction_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `start_date` varchar(50) DEFAULT NULL,
  `end_date` varchar(50) DEFAULT NULL,
  `mark_type` varchar(50) DEFAULT NULL,
  `pass_mark` double(10,2) NOT NULL,
  `exam_limit` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `is_publish` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `oex_assigned_questions` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `oex_taken_exams` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,  
  `total_question` int(11) NOT NULL DEFAULT 0,
  `total_answer` int(11) NOT NULL DEFAULT 0,
  `total_correct_answer` int(11) NOT NULL DEFAULT 0, 
  `total_mark` int(11) NOT NULL DEFAULT 0,
  `total_obtain_mark` int(11) NOT  NULL DEFAULT 0,  
  `result_status` varchar(50) NOT NULL DEFAULT 'passed' COMMENT 'passed, failed',
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- ======================== EXAM =================================
CREATE TABLE `exam_grades` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `point` decimal(10,2) NOT NULL,
  `mark_from` int(11) NOT NULL,
  `mark_to` int(11) NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `exam_mark_types` (
  `id` int(11) NOT NULL, 
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `exam_terms` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `exam_type` varchar(100) CHARACTER SET utf8 NOT NULL, [mark, grade, both]
  `mark_type` varchar(150) CHARACTER SET utf8 NOT NULL, [multi data comma separated or json]
  `start_date` date NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `exam_halls` (
  `id` int(11) NOT NULL,
  `hall_no` int(11) NOT NULL,
  `no_of_seat` int(11) NOT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- =======after section_id column add
CREATE TABLE `exam_suggestions` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,  
  `description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `attachment` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- =======after section_id, sub_order column add
CREATE TABLE `exam_schedules` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `exam_date` date DEFAULT NULL,
  `start_time` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `end_time` varchar(20) CHARACTER SET utf8 COLLATE utf8_estonian_ci DEFAULT NULL,
  `hall_id` int(11) NOT NULL,
  `mark_type` text DEFAULT NULL, [json data with mark]
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `exam_marks` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `obtain_mark`  text NULL, [json data]
  `exam_total_mark` int(11) NOT NULL,
  `obtain_total_mark` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL, 
  `remark` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `is_present` tinyint(1) NOT NULL,
  `is_pass` tinyint(1) NOT NULL [1 paas, 2 fail],
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `exam_results` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `total_subject` int(11) NOT NULL,
  `total_mark` int(11) NOT NULL,
  `total_obtain_mark` int(11) NOT NULL,
  `avg_grade_point` float(5,2) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `result_status`  tinyint(1) NOT NULL [1 paas, 2 fail],
  `remark` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `rank_in_class` varchar(20) CHARACTER SET utf8 NOT NULL,
  `rank_in_section` varchar(20) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

