<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">

            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a> </li>

            <li><a><i class="fa fa-gears"></i> Setting <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('general-setting') }}">General Setting</a></li>
                    <li><a href="{{ route('payment-setting') }}">Payment Setting</a></li>
                    <li><a href="{{ route('sms-setting') }}">SMS Setting</a></li>
                    <li><a href="{{ route('email-setting') }}">Email Setting</a></li>
                    <li><a href="{{ route('opening-hour') }}">Opening Hour</a></li>
                </ul>
            </li>

            <li><a href="{{ route('theme-setting') }}"><i class="fa fa-cubes"></i> Theme</a></li>
            <li><a href="{{ route('language.list') }}"><i class="fa fa-language"></i> Language</a></li>

            <li><a><i class="fa fa-user"></i> Administrator <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('role.list') }}">User Role (ACL)</a></li>
                    <li><a href="{{ route('module.list') }}">Module [Temp]</a></li>
                    <li><a href="{{ route('operation.list') }}">Operation [Temp]</a></li>
                    <li><a href="{{ route('privilege.list') }}">Role Permission (ACL)</a></li>
                    <li><a href="{{ route('user.list') }}">Manage User</a></li>
                    <li><a href="/administrator/usercredential/index">User Credential</a></li>
                    <li><a href="/administrator/password/index">Reset Password</a></li>
                    <li><a href="/administrator/email/index">Reset Email</a></li>
                    <li><a href="/administrator/backup/index">Custom Field</a></li>
                    <li><a href="/administrator/activitylog/index">Activity Log</a></li>
                    <li><a href="/administrator/feedback/index">Feedback</a></li>
                    <li><a href="/administrator/backup/index">Backup</a></li>
                </ul>
            </li>
            
            <li><a><i class="fa fa-user-md"></i> Human Resource <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('department.list') }}">Department</a> </li>
                    <li><a href="{{ url('hrm/designation') }}">Designation</a> </li>
                    <li><a href="{{ route('employee.list')  }}">Employee</a> </li>
                </ul>
            </li>

            
            <li><a><i class="fa fa-users"></i> Teacher <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('teacher-department.list') }}">Department</a> </li>
                    <li><a href="{{ route('manage-teacher.list') }}">Manage Teacher</a></li>
                    <li><a href="{{ route('lecture.list') }}">Lecture</a></li>
                    <li><a href="{{ route('rating.student') }}">Student Rating</a></li>
                    <li><a href="{{ route('rating.guardian') }}">Guardian Rating</a></li>
                    <li><a href="{{ route('rating.manage') }}">Manage Rating</a></li>
                </ul>
            </li>
            
            <li><a><i class="fa fa-dollar"></i> Payroll <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('grade.list') }}">Salary Grade</a></li>
                    <li><a href="{{ route('grade-assign.list') }}">Garde Assign</a></li>
                    <li><a href="/payroll/history/index">Salary Payment</a></li>
                    <li><a href="/payroll/history/index">Payment History</a></li>
                </ul>
            </li>
            
            <li><a href="{{ route('manage-guardian.list') }}"><i class="fa fa-paw"></i> Guardian</a> </li>

            <li><a><i class="fa fa-group"></i>Manage Student <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('group.list') }}"> Student Group</a></li>
                    <li><a href="{{ route('type.list') }}">Student Type</a></li>
                    <li><a href="{{ route('house.list') }}">Student House</a></li>
                    <li><a href="{{ route('manage-student.list') }}">Student</a></li>
                    <li><a href="{{ route('manage-student.list') }}">Admit Student</a></li>
                    <li><a href="{{ route('advanced-student.list') }}">Advanced Admission</a></li>
                    <li><a href="{{ route('bulk.list') }}">Bulk Admission</a></li>
                    <li><a href="{{ route('admission.list') }}">Online Admission</a></li>
                    <li><a href="{{ route('activity.list') }}">Student Activity</a></li>
                    <li><a href="{{ route('update-student.list') }}">Update Student</a></li>
                </ul>
            </li>

            
            <li><a><i class="fa fa-institution"></i> Academic<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('year.list') }} "> Academic Year</a></li>
                    <li><a href="{{ route('class.list') }}">Class</a> </li>
                    <li><a href="{{ route('section.list') }}">Section</a> </li>
                    <li><a href="{{ route('subject.list') }}">Subject</a> </li>
                    <li><a href="{{ route('subject-assign.list') }}">Subject Assigned</a> </li>
                    <li><a href="{{ route('syllabuse.list') }}">Syllabus</a> </li>
                    <li><a href="{{ route('assignment.list') }}">Assignment</a> </li>
                    <li><a href="{{ route('submission.list') }}">Submission</a> </li>
                    <li><a href="{{ route('routine.list') }}">Routine</a> </li>
                    <li><a href="/academic/material/index">Promotion</a> </li>
                </ul>
            </li>

            <li><a><i class="fa fa-calculator"></i> School Accounting <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('incomehead.list') }}">Income Head</a></li>
                    <li><a href="{{ route('income.list') }}">Income</a> </li>
                    <li><a href="{{ route('exphead.list') }}">Expenditure Head</a></li>
                    <li><a href="{{ route('expenditure.list') }}">Expenditure</a> </li>
                </ul>
            </li>

            <li><a><i class="fa fa-calculator"></i>Student Accounting <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('discount.list') }}">Discount</a> </li>
                    <li><a href="{{ route('feetype.list') }}">Fee Type</a></li>
                    <li><a href="{{ route('feegroup.list') }}">Fee Group</a></li>
                    <li><a href="{{ route('group-detail.list') }}">Group Detail</a></li>
                    <li><a href="{{ route('fee-fine.list') }}">Fee Fine</a></li>
                    <li><a href="/accounting/invoice/add">Fee Collection</a></li>
                    <li><a href="/accounting/invoice/index">Invoice</a> </li>
                    <li><a href="/accounting/invoice/due">Due Invoice</a></li>
                    <li><a href="/accounting/feetype/index">Fee Reminder</a></li>
                    <li><a href="/accounting/invoice/multi">Print Multi Invoice</a></li>
                    <li><a href="/accounting/receipt/duereceipt">Due Receipt</a></li>
                    <li><a href="/accounting/receipt/paidreceipt">Paid Receipt</a></li>
                    <li><a href="/accounting/duefeeemail/index">Due Fee Email</a></li>
                    <li><a href="/accounting/duefeesms/index">Due Fee SMS</a></li>
                </ul>
            </li>


            <li><a><i class="fa fa-barcode"></i>Generate Card<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('idsetting') }}">ID Card Setting</a></li>
                    <li><a href="{{ route('teacher-idcard') }}">Teacher ID card</a></li>
                    <li><a href="{{ route('employee-idcard') }}">Employee ID Card</a></li>
                    <li><a href="/card/student/index">Student ID Card</a></li>
                    <li><a href="{{ route('admitsetting') }}">Admit Card Setting</a></li>
                    <li><a href="/card/admit/index">Student Admit Card</a></li>
                </ul>
            </li>
            
            <li><a><i class="fa fa-headphones"></i>Online Program<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('liveclass.list') }}">Live Class</a></li>
                    <li><a href="{{ route('meeting.list') }}">Live Meeting</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-download"></i>Download Center<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('material-category.list') }} ">Material Category</a></li>
                    <li><a href="{{ route('study-material.list') }}">Material</a></li>
                    <li><a href="{{ route('lecture.list') }}">Lecture</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-bars"></i> Lesson Plan<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('lesson.list') }}">Lesson</a></li>
                    <li><a href="{{ route('topic.list') }}">Topic</a> </li>
                    <li><a href="{{ route('timeline.list') }}">Lesson Timeline</a></li>
                    <li><a href="{{ route('status.list') }}">Lesson Status</a></li>
                    <li><a href="{{ url('lessonplan/index') }}">Lesson Plan</a></li>
                </ul>
            </li>

            
            <li><a><i class="fa fa-gift"></i> Scholarship <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('candidate.list') }}">Candidate</a> </li>
                    <li><a href="{{ route('donar.list') }}">Donar</a> </li>
                    <li><a href="{{ route('manage-scholarship.list') }}">Scholarship</a> </li>
                </ul>
            </li>
            
            <li><a><i class="fa fa-file-photo-o"></i> Student Behavior <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="/teacher/department/index">Assesments</a> </li>
                    <li><a href="/teacher/index">Assesment Assigns</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-file-photo-o"></i> Alumni <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('student-alumni.list') }}">Student Alumni</a> </li>
                    <li><a href="{{ route('event.list') }}">Alumni Event</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-bell-o"></i> Leave <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('leave-type.list') }}">Leave Type</a></li>
                    <li><a href="{{ route('application.list') }}">Leave Application </a></li>
                    <li><a href="{{ route('waiting.list') }}">Waiting Application</a></li>
                    <li><a href="{{ route('approve.list') }}">Approved Application</a></li>
                    <li><a href="{{ route('decline.list') }}">Declined Application</a></li>
                </ul>
            </li>


            <li><a><i class="fa fa-check-circle-o"></i> Attendance <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('attendance/student') }}">Student Attendance</a></li>
                    <li><a href="/attendance/teacher">Teacher Attendance</a></li>
                    <li><a href="/attendance/employee">Employee Attendance</a></li>
                    <li><a href="/attendance/absentemail/index">Absent Email</a></li>
                    <li><a href="/attendance/absentsms/index">Absent SMS</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-graduation-cap"></i> Exam <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('exam/grade') }}">Exam Grade</a></li>
                    <li><a href="{{ route('mark-type.list') }}">Mark Type</a></li>
                    <li><a href="{{ route('term.list') }}">Exam Term</a></li>
                    <li><a href="{{ route('hall.list') }}">Exam Hall</a></li>
                    <li><a href="{{ route('schedule.list') }}">Schedule</a></li>
                    <li><a href="{{ route('suggestion.list') }}">Suggestion</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-mouse-pointer"></i> Online Exam<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="/onlineexam/instruction/index">Instruction</a> </li>
                    <li><a href="/onlineexam/question/index">Question Bank</a></li>
                    <li><a href="/onlineexam/index">Online Exam</a></li>
                    <li><a href="/onlineexam/takeexam/result">Exam Result</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-file-text-o"></i> Exam Mark <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="/exam/mark/index">Exam Mark</a></li>
                    <li><a href="/exam/examresult/index">Exam Result</a></li>
                    <li><a href="/exam/meritlist/index">Merit List</a></li>
                    <li><a href="/exam/marksheet/index">Mark Sheet</a></li>
                    <li><a href="/exam/resultcard/index">Result Card</a></li>
                    <li><a href="/exam/resultcard/all">All Result Card</a></li>
                    <li><a href="/exam/mail/index">Mark send by Email</a></li>
                    <li><a href="/exam/text/index">Mark send by SMS</a></li>
                    <li><a href="/exam/resultemail/index">Result Email</a></li>
                    <li><a href="/exam/resultsms/index">Result SMS</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-certificate"></i> Certificate <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('certificate/type')}}">Certificate Type</a></li>
                    <li><a href="{{ route('generate.list')}}">Generate Certificate</a></li>
                </ul>
            </li>

            
            <li><a><i class="fa fa-money"></i> Asset Management <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('asset/vendor') }}">Vendor</a> </li>
                    <li><a href="{{ url('asset/store') }}">Store</a> </li>
                    <li><a href="{{ url('asset/category') }}">Category</a> </li>
                    <li><a href="{{ url('asset/item') }}">Item</a> </li>
                    <li><a href="{{ url('asset/purchase') }}">Purchase</a></li>
                    <li><a href="{{ url('asset/issue') }}">Issue</a> </li>
                    <li><a href="{{ url('asset/stock') }}">Stock</a> </li>
                </ul>
            </li>
            
            <li><a><i class="fa fa-suitcase"></i> Inventory <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('supplier.list') }}">Supplier</a> </li>
                    <li><a href="{{ route('warehouse.list') }}">Warehouse</a></li>
                    <li><a href="{{ route('category.list') }}">Category</a> </li>
                    <li><a href="{{ route('product.list') }}">Product</a> </li>
                    <li><a href="{{ route('purchase.list') }}">Purchase</a> </li>
                    <li><a href="{{ route('stock.list') }}">Stock</a> </li>
                    <li><a href="{{ route('sale.list') }}">Sale</a></li>
                    <li><a href="{{ route('issue.list') }}">Issue</a> </li>
                </ul>
            </li>
            
                        
            <li><a><i class="fa fa-dollar"></i> Daily Purchase <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="">Category</a></li>                         
                    <li><a href="">Items</a></li>                         
                    <li><a href="">Purchase</a></li>                         
                    <li><a href="">Invoice</a></li>
                </ul>
            </li>
            
            <li><a><i class="fa fa-commenting"></i> Complain <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('complain/type') }}">Complain Type</a></li>
                    <li><a href="{{ route('manage-complain.list') }}">Complain </a></li>
                </ul>
            </li>


            <li><a><i class="fa fa-book"></i> Library <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('book.list') }}">Book</a> </li>
                    <li><a href="{{ url('library/member') }}"> Member</a></li>
                    <li><a href="{{ url('library/issue') }}">Issue</a></li>
                    <li><a href="{{ route('ebook.list') }}">E-Book</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-bus"></i> Transport <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('vehicle.list') }}">Vehicle</a> </li>
                    <li><a href="{{ route('route.list') }}">Routes</a></li>
                    <li><a href="{{ url('transport/member') }}">Members</a></li>
                </ul>
            </li>


            <li><a><i class="fa fa-hotel"></i> Hostel <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('manage-hostel.list') }}">Manage Hostel</a></li>
                    <li><a href="{{ route('room-type.list') }}">Room Type</a></li>
                    <li><a href="{{ route('room.list') }}">Hostel Room</a></li>
                    <li><a href="{{ url('hostel/member') }}">Hostel Member</a></li>
                </ul>
            </li>

                        
            <li><a><i class="fa fa-user-md"></i> Managing Committee <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('committee/designation') }}">Designation</a> </li>
                    <li><a href="{{ route('manage-committee.list')  }}">Committee</a> </li>
                </ul>
            </li>
            
            <li><a><i class="fa fa-envelope-o"></i> Communication<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('inbox.list') }}">Message</a> </li>
                    <li><a href="/message/mail/index">Email</a> </li>
                    <li><a href="/message/text/index">SMS</a></li>
                </ul>
            </li>
                   
            
            <li><a><i class="fa fa-tags"></i> Template <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('sms-template.list') }}">SMS Template</a></li>
                    <li><a href="{{ route('email-template.list') }}">Email Template</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-tty"></i> Front Office <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('purpose') }}">Visitor Purpose</a></li>
                    <li><a href="{{ route('visitor') }}">Visitor Info</a></li>
                    <li><a href="{{ route('call-log') }}">Call Log</a></li>
                    <li><a href="{{ route('dispatch') }}">Postal Dispatch</a></li>
                    <li><a href="{{ route('postal-receive') }}">Postal Receive</a></li>
                    <li><a href="{{ route('enquiry-source') }}">Enquiry Source</a></li>
                    <li><a href="{{ route('enquiry') }}">Enquiry</a></li>
                    <li><a href="{{ route('enquiry-follow-up') }}">Enquiry Follow Up</a></li>
                </ul>
            </li>

            <li><a href="{{ route('media.gallery') }}"><i class="fa fa-image"></i> Media Gallery</a> </li>

            <li><a><i class="fa fa-globe"></i>Front CMS<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('event') }}">Event</a></li>
                    <li><a href="{{ route('slider') }}">Slider</a></li>
                    <li><a href="{{ route('gallery') }}">Gallery</a></li>
                    <li><a href="{{ route('gallery-image') }}">Gallery Image</a></li>
                    <li><a href="{{ route('news') }}">News</a></li>
                    <li><a href="{{ route('notice') }}">Notice</a></li>
                    <li><a href="{{ route('faq') }}">Faq</a></li>
                    <li><a href="{{ route('service') }}">Service</a></li>
                    <li><a href="{{ route('feature') }}">Feature</a></li>
                    <li><a href="{{ route('link') }}">Useful Link</a></li>
                    <li><a href="{{ route('page') }}">Page</a></li>
                    <li><a href="{{ route('home-page-section') }}">Home Section</a></li>
                    <li><a href="{{ route('menu-group') }}">Menu Group</a></li>
                    <li><a href="{{ route('menu-item') }}">Menu Item</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-info-circle"></i>Miscellaneous <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('award') }}">Award</a> </li>
                    <li><a href="{{ route('todo') }}">Todo</a> </li>
                </ul>
            </li>

            <li><a><i class="fa fa-bar-chart"></i> Report <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="/report/income">Income Report</a></li>
                    <li><a href="/report/expenditure">Expenditure Report</a></li>
                    <li><a href="/report/invoice">Invoice Report</a></li>
                    <li><a href="/report/duefee">Due Fee Report</a></li>
                    <li><a href="/report/feecollection">Fee Collection Report</a></li>
                    <li><a href="/report/balance">Accounting Balance Report</a></li>
                    <li><a href="/report/library">Library Report</a></li>
                    <li><a href="/report/sattendance">Student Attendance Report</a></li>
                    <li><a href="/report/syattendance">Student Yearly Attendance Report</a></li>
                    <li><a href="/report/tattendance">Teacher Attendance Report</a></li>
                    <li><a href="/report/tyattendance">Teacher Yearly Attendance Report</a></li>
                    <li><a href="/report/eattendance">Employee Attendance Report</a></li>
                    <li><a href="/report/eyattendance">Employee Yearly Attendance Report</a></li>
                    <li><a href="/report/student">Student Report</a></li>
                    <li><a href="/report/sinvoice">Student Invoice Report</a></li>
                    <li><a href="/report/sactivity">Student Activity Report</a></li>
                    <li><a href="/report/payroll">Payroll Report</a></li>
                    <li><a href="/report/transaction">Daily Transaction Report</a></li>
                    <li><a href="/report/statement">Daily Statemen Report</a></li>
                    <li><a href="/report/examresult">Exam Result Report</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-lock"></i>Profile <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="/profile">My Profile</a></li>
                    <li><a href="/profile/password">Reset Password</a></li>
                    <li><a href="/usercomplain/index">Complain</a> </li>
                    <li><a href="/userleave/index">Leave</a></li>
                    <li><a href="/auth/logout">Log Out</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);"><i class="fa fa-signal"></i><span class="version">V-1.0.0</span></a>
            </li>
        </ul>
    </div>
</div>
